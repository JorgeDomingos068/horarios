<?php namespace App\Controllers;

use DateTime;
use Ifsnop\Mysqldump\Mysqldump;

class BackupController extends BaseController {
  protected $helpers = ['filesystem'];
  
  public function __construct()
  {
    require_once FCPATH . '../vendor/autoload.php';
  }

  public function index()
  {
    $diretorio = WRITEPATH . 'backups/';
    $backups = directory_map($diretorio);
    rsort($backups);

    $backups = array_map(function($backup) {
      $data = substr($backup, 10, 10);
      $data = date("d/m/Y", strtotime($data));

      return [
        'arquivo' => $backup, 
        'data' => $data
      ];
    }, $backups);

    $data['backups'] = $backups;

    $this->content_data['content'] = view('sys/backup', $data);
    return view('dashboard', $this->content_data);
  }

  public function baixar()
  {
    $dadosGet = $this->request->getGet();
    $nomeArquivo = $dadosGet['arquivo'];

    $caminhoCompleto = WRITEPATH . 'backups/' . $nomeArquivo;
    return $this->response->download($caminhoCompleto, null)->setFileName($nomeArquivo);
  }
  
  public function backupManual() 
  {
    $db = \Config\Database::connect();
    $dbconn = 'mysql:host=' . $db->hostname . ';dbname=' . $db->database;
    $usuario = $db->username;
    $senha = $db->password;

    $backupCaminho = WRITEPATH . 'backups/';
    $backupArquivo = 'Planifica_'. date('Y-m-d_H-i-s') .'.sql';
    $caminhoCompleto = $backupCaminho . $backupArquivo;
    
    $dump = new Mysqldump($dbconn, $usuario, $senha);
    $dump->start($caminhoCompleto);

    // register_shutdown_function(function() use ($caminhoCompleto) {
    //   if (file_exists($caminhoCompleto)) {
    //     unlink($caminhoCompleto);
    //   }
    // });

    return $this->response->download($caminhoCompleto, null)->setFileName($backupArquivo);
  }

  public function backupAutomatico() 
  {
    $db = \Config\Database::connect();
    $dbconn = 'mysql:host=' . $db->hostname . ';dbname=' . $db->database;
    $usuario = $db->username;
    $senha = $db->password;

    $backupCaminho = WRITEPATH . 'backups/';
    $backupArquivo = 'Planifica_'. date('Y-m-d') .'.sql';
    $caminhoCompleto = $backupCaminho . $backupArquivo;
  }
}