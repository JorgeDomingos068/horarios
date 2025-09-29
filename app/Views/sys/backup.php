<div class="page-header">
  <h3 class="page-title">GERENCIAR BACKUPS</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('/sys/home') ?>">Início</a></li>
      <li class="breadcrumb-item active" aria-current="page">Backup</li>
    </ol>
  </nav>
</div>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Ações</h4>
        <div class="row">
          <div class="col-12 mb-4">
            <a class="btn btn-primary btn-icon-text" href="<?= base_url('sys/backup/gerar') ?>"><i class="mdi mdi-backup-restore"></i> Gerar Backup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table table-sm" id="listagem-backup">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Arquivo</th>
                    <th>Data</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($backups)): ?>
                    <?php foreach($backups as $i => $backup): ?>
                      <tr>
                        <td><?= esc(++$i) ?></td>
                        <td><?= esc($backup['arquivo']) ?></td>
                        <td><?= esc($backup['data']) ?></td>
                        <td>
                          <div class="d-flex">

                            <span data-bs-toggle="tooltip" data-placement="top" title="Baixar Backup">
                              <button
                                type="button"
                                class="justify-content-center align-items-center d-flex btn btn-inverse-primary button-trans-primary btn-icon me-1"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-definir-versao-vigente"
                                data-vigente-id="1"
                                data-vigente-nome="1">
                                <i class="fa fa-arrow-circle-o-down"></i>
                              </button>
                            </span>

                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4">Nenhum backup encontrado.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-12 mt-4 d-flex justify-content-end">Legenda</div>
      <div class="col-12 mt-4 d-flex justify-content-end gap-3">
        <p class="card-description text-end"><i class="fa fa-arrow-circle-o-down text-primary me-2"></i>Fazer Download &nbsp; &nbsp; </p>
      </div>
    </div>
  </div>
</div>

<script>
  const dataTableLangUrl = "<?php echo base_url('assets/js/traducao-dataTable/pt_br.json'); ?>";

  $(document).ready(function() {
    <?php if (!empty($backups)): ?>
      $("#listagem-backup").DataTable({
        aLengthMenu: [
          [-1, 5, 15, 30],
          ["Todos", 5, 15, 30],
        ],
        language: {
          search: "Pesquisar:", 
          url: dataTableLangUrl, 
        }, 
        ordering: true, 
        order: [
          [0, 'asc']
        ], 
        columns: [null, null, null, {
          orderable: false
        }]
      });
    <?php endif; ?>
  });
</script>