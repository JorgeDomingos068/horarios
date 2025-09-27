<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\AulaHorarioModel;

class AulaHorarioController extends BaseController
{
  public function verificarConflitosRotina() {

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
      'RESTRIÇÃO-DOCENTE' => $restricao,
      'CONFLITO-TURNOS' => $turnos,
      'CONFLITO-INTERVALO' => $intervalo,
    ];

    // \Kint\Kint::$mode_default = \Kint\Kint::MODE_PLAIN;
    //     dd($conflitos); // imprime tudo e para
    
    return $this->response->setJSON($conflitos);
  }

  public function destacarConflitosAmbiente()
  {
      $data = $this->request->getPost();
      $idTempoDeAula = $data['tempo_de_aula_id'];

      $aulaHorarioModel = new AulaHorarioModel();
      $conflitos = $aulaHorarioModel->destacandoConflitoAmbiente($idTempoDeAula);

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
        // Chama a função montarDetalheDoAH que faz os JOINs e retorna os dados
        $detalhes = $aulaHorarioModel->montarDetalheDoAH($id, $tipo);

        if (!$detalhes) {
            return $this->response->setStatusCode(404, 'Conflito não encontrado')->setJSON([
                'error' => 'Conflito não encontrado',
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON($detalhes);
    }
}
