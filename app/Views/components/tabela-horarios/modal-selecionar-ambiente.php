<div class="modal fade" id="modalSelecionarAmbiente" role="dialog" tabindex="-1" aria-labelledby="modalSelecionarAmbienteLabel" aria-hidden="false" style="z-index: 10000;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalSelecionarAmbienteLabel">Definir Ambiente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card border-1 shadow-sm bg-gradient">
                            <div class="card-body">
                                <h6 class="text-primary">
                                    <i class="mdi mdi-book-outline me-1"></i> <span id="modalAmbienteNomeDisciplina"></span>
                                </h6>
                                <div class="d-flex align-items-center mb-0 py-0">
                                    <i class="mdi mdi-account-tie fs-6 text-muted me-1"></i>
                                    <small class="text-secondary"><span id="modalAmbienteProfessor"></span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-1 shadow-sm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="selectAmbiente">
                                        <h6 class="text-primary">Selecione o(s) ambiente(s):</h6>
                                    </label>
                                    <select class="form-select" id="selectAmbiente" multiple="multiple" name="selectAmbiente[]" style="width:100%;">
                                        <?php foreach ($ambientes as $ambiente): ?>
                                            <option 
                                                value="<?php echo esc($ambiente['id']) ?>"
                                                data-original-text="<?php echo esc($ambiente['nome']) ?>"
                                            >
                                                <?php echo esc($ambiente['nome']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmarAmbiente">Confirmar</button>
            </div>

        </div>
    </div>
</div>