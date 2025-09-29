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
      'COUNT-AMBIENTE' => count($amb),
      'CONFLITO-PROFESSOR' => $prof,
      'COUNT-PROFESSOR' => count($prof),
      'CONFLITO-TURNOS' => $turnos,
      'COUNT-TURNOS' => count($turnos),
      'RESTRIÇÃO-DOCENTE' => $restricao,
      'COUNT-RESTRIÇÃO' => count($restricao),
      'CONFLITO-INTERVALO' => $intervalo,
      'COUNT-INTERVALO' => count($intervalo),
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

      if (!empty($conflitos)) {
          return $this->response->setJSON(
              $conflitos
          );
      } else {
          return $this->response->setJSON([
              'mensagem' => 'Sem Conflitos!',
          ]);
      }
      return $this->response->setJSON(['status' => 'ok']);
  } 
  
   public function getConflitoDetalhes(int $id, string $tipo)
    {
        $aulaHorarioModel = new AulaHorarioModel();
        $detalhes = $aulaHorarioModel->montarDetalheDoAH($id, $tipo);

        if (!$detalhes) {
            return $this->response->setStatusCode(404, 'Conflito Não Encontrado!')->setJSON([
                'error' => 'Conflito Não Encontrado!',
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON($detalhes);
    }
}
