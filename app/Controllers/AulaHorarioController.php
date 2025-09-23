<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AulaHorarioModel;

class AulaHorarioController extends BaseController
{
	public function verificarConflitosRotina()
	{

		$versaoId = (new \App\Models\VersoesModel())->getVersaoByUser(auth()->id());

		$model = new \App\Models\AulaHorarioModel();

		$amb  = $model->countConflitosAmbiente($versaoId);
		$prof = $model->countConflitosProfessor($versaoId);
		$restricao = $model->countRestricaoDocente($versaoId);
		$turnos = $model->countTresTurnos($versaoId);
		$intervalo = $model->countTempoEntreTurnos($versaoId);

		$conflitos = [
			'CONFLITO-AMBIENTE' => $amb,
			'CONFLITO-PROFESSOR' => $prof,
			'RESTRIÇÃO-DOCENTE' => $restricao,
			'CONFLITO-TURNOS' => $turnos,
			'CONFLITO-INTERVALO' => $intervalo,
		];

		return $this->response->setJSON($conflitos);
	}

	public function destacarConflitosAmbiente()
	{
		$data = $this->request->getPost();
		$idTempoDeAula = $data['tempo_de_aula_id'];
		$idAula = $data['aula_id'];

		$aulaHorarioModel = new AulaHorarioModel();
		$conflitos = $aulaHorarioModel->destacandoConflitoAmbiente($idTempoDeAula, $idAula);

		if (!empty($conflitos))
		{
			return $this->response->setJSON(
				$conflitos
			);
		}
		else
		{
			return $this->response->setJSON([
				'mensagem' => 'Sem Conflitos!',
			]);
		}
		
		return $this->response->setJSON(['status' => 'ok']);
	}
}
