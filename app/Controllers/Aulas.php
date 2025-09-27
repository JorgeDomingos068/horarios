<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AulaProfessorModel;
use App\Models\AulasModel;
use App\Models\TurmasModel;
use App\Models\CursosModel;
use App\Models\DisciplinasModel;
use App\Models\ProfessorModel;
use App\Models\MatrizCurricularModel;
use App\Models\VersoesModel;
use App\Models\AulaHorarioModel;
use CodeIgniter\Exceptions\ReferenciaException;

class Aulas extends BaseController
{
	public function index()
	{
		$aulaModel = new AulasModel();
		$turmasModel = new TurmasModel();
		$cursosModel = new CursosModel();
		$disciplinasModel = new DisciplinasModel();
		$professorModel = new ProfessorModel();
		$matrizModel = new MatrizCurricularModel();

		$data['aulas'] = $aulaModel->findAll();
		$data['turmas'] = $turmasModel->orderBy('CHAR_LENGTH(sigla)')->orderBy('sigla')->findAll();
		$data['cursos'] = $cursosModel->orderBy('nome')->findAll();
		$data['disciplinas'] = $disciplinasModel->orderBy('nome')->findAll();
		$data['professores'] = $professorModel->orderBy('nome')->findAll();
		$data['matrizes'] = $matrizModel->findAll();

		$data['consulta'] = $aulaModel->getAulasComTurmaDisciplinaEProfessores();

		$this->content_data['content'] = view('sys/aulas', $data);
		return view('dashboard', $this->content_data);
	}

	public function salvar()
	{
		$dadosPost = $this->request->getPost();

		$aula = new AulasModel();
		$aula_prof = new AulaProfessorModel();
		$versaoModel = new VersoesModel();
		$versaoId = (new \App\Models\VersoesModel())->getVersaoByUser(auth()->id());

		foreach ($dadosPost['turmas'] as $k => $v) {

			$aulaExistente = $aula
		->where('disciplina_id', $dadosPost['disciplina'])
		->where('versao_id', $versaoId)
		->where('turma_id', $v)
		->first();

		if($aulaExistente) {
				$mensagem = "<b>Não é possível cadastrar uma aula com disciplina repetida!</b>";
				return $mensagem;
		}

			$insert = [
				"disciplina_id" => $dadosPost['disciplina'],
				"turma_id" => $v,
				"versao_id" => $versaoModel->getVersaoByUser(auth()->id()),
				"destaque" => isset($dadosPost['destaque']) ? 1 : 0
			];

			if ($id_aula = $aula->insert($insert)) {
				foreach ($dadosPost['professores'] as $k2 => $v2) {
					$prof_insert = ["professor_id" => $v2, "aula_id" => $id_aula];
					$aula_prof->insert($prof_insert);
				}
			}
		}

		echo "ok";
	}

	public function atualizar()
	{
		$dadosPost = $this->request->getPost();
		$id = strip_tags($dadosPost['id']);

		$aula = new AulasModel();
		$versaoModel = new VersoesModel();

		$aula_prof = new AulaProfessorModel();
		$aula_prof->where('aula_id', $id)->delete();

		foreach ($dadosPost['professores'] as $k => $v) {
			$prof_insert = ["professor_id" => $v, "aula_id" => $id];
			$aula_prof->insert($prof_insert);
		}

		$update = [
			"id" => $id,
			"disciplina_id" => $dadosPost['disciplina'],
			"turma_id" => $dadosPost['turma'],
			"versao_id" => $versaoModel->getVersaoByUser(auth()->id()),
			"destaque" => isset($dadosPost['destaque']) ? 1 : 0
		];

		if ($aula->save($update)) {
			echo "ok"; // Alterado para retornar "ok" em vez de redirect
		} else {
			echo "Erro ao atualizar a aula";
		}
	}

	public function deletar()
	{
		$dadosPost = $this->request->getPost();
		$id = (int)strip_tags($dadosPost['id']);

		$aulasModel = new AulasModel();
		try {
			$restricoes = $aulasModel->getRestricoes(['id' => $id]);

			if (!$restricoes['horarios']) {
				$aulaProfModel = new AulaProfessorModel();
				$aulaProfModel->where('aula_id', $id)->delete();

				if ($aulasModel->delete($id)) {
					session()->setFlashdata('sucesso', 'Aula excluída com sucesso!');
					return redirect()->to(base_url('/sys/aulas'));
				} else {
					return redirect()->to(base_url('/sys/aulas'))->with('erro', 'Erro inesperado ao excluir Aula!');
				}
			} else {
				$mensagem = "<b>A aula não pode ser excluída. Esta aula possui</b>";

				if ($restricoes['horarios']) {
					$mensagem = $mensagem . "<br><b>Horário(s) relacionado(s) a ela:</b><br><ul>";
					foreach($restricoes['horarios'] as $h) {
						$mensagem = $mensagem . "<li><b>Dia/Horário:</b> $h->dia_semana | $h->intervalo</li>";
					}
					$mensagem = $mensagem . "</ul>";
				}
				throw new ReferenciaException($mensagem);
			}
		} catch (ReferenciaException $e) {
			session()->setFlashdata('erro', $e->getMessage());
			return redirect()->to(base_url('/sys/aulas'));
		}
	}

	public function deletarMulti()
	{
		$selecionados = $this->request->getPost('selecionados');

		if (empty($selecionados)) {
			die('Nenhuma aula selecionada para exclusão.');
		}

		$aulasModel = new AulasModel();
		$aulaProfModel = new AulaProfessorModel();
		$erros = [];
		$sucessos = 0;

		foreach ($selecionados as $id) {
			$restricoes = $aulasModel->getRestricoes(['id' => $id]);

			if (!$restricoes['horarios']) {
				try {
					$aulaProfModel->where('aula_id', $id)->delete();
					if ($aulasModel->delete($id)) {
						$sucessos++;
					} else {
						$erros[] = "Erro ao excluir aula ID $id";
					}
				} catch (\Exception $e) {
					$erros[] = "Erro ao excluir aula ID $id: " . $e->getMessage();
				}
			} else {
				$erros[] = "Aula ID $id não pode ser excluída - possui horários relacionados";
			}
		}

		if (empty($erros)) {
			echo "ok"; // Todas excluídas com sucesso
		} else {
			if ($sucessos > 0) {
				// Algumas excluídas, outras não
				echo "Ações parciais: $sucessos aula(s) excluída(s), mas ocorreram erros:<br>" . implode("<br>", $erros);
			} else {
				// Nenhuma excluída
				echo "Nenhuma aula pôde ser excluída:<br>" . implode("<br>", $erros);
			}
		}
	}

	public function getAulasFromTurma($turma)
	{
		$aula = new AulasModel();

		$aulas = $aula->select('aulas.id, disciplinas.nome as disciplina, disciplinas.ch, professores.nome as professor')
			->join('disciplinas', 'disciplinas.id = aulas.disciplina_id')
			->join('aula_professor', 'aula_professor.aula_id = aulas.id')
			->join('professores', 'professores.id = aula_professor.professor_id')
			->where('aulas.turma_id', $turma)
			->where('aulas.versao_id', (new VersoesModel())->getVersaoByUser(auth()->id()))
			->findAll();

		return json_encode($aulas);
	}

	public function getTableByAjax()
	{
		$aulaModel = new AulasModel();
		$aulas = $aulaModel->getAulasComTurmaDisciplinaEProfessores();
		return trim(json_encode($aulas));
	}

	public function getAulaData($aulaId)
	{
		$aulaModel = new AulasModel();
		$aula = $aulaModel->find($aulaId);

		return $this->response->setJSON($aula);
	}
}
