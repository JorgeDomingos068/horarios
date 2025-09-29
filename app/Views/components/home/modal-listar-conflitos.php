<!-- Modal de Lista de Conflitos -->
<div class="modal fade" id="modal-listar-conflitos" tabindex="-1" aria-labelledby="modalConflitosLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConflitosLabel">
          <span id="listar_conflito_tipo">Conflitos</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body">
        <!-- Loader/status -->
        <div id="conflitos-loading" class="alert alert-secondary mb-3">Carregando…</div>

        <!-- Tabela -->
        <div class="table-responsive">
          <table class="table table-dark table-striped table-sm align-middle" id="tbl-conflitos">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Horário</th>
                <th>Ambiente</th>
                <th>Professor</th>
                <th>Curso</th>
                <th>Turma</th>
                <th>Dia</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="tbl-conflitos-body">
              <!-- Linhas preenchidas via JS -->
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <small class="text-muted me-auto" id="conflitos-resumo"></small>
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
