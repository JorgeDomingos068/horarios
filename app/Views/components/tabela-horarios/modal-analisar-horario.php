<div class="modal fade" id="modalAnalisarHorario" tabindex="-1" aria-labelledby="modalAnalisarHorarioLabel" aria-hidden="true" style="z-index: 10001;">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-white" id="modalAnalisarHorarioLabel">
                    <i class="mdi mdi-alert-circle-outline me-2 text-warning"></i> Análise de Horário
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="row" id="rowRestricao">
                    <h5 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Restrição do Docente!</h5>
                    <div class="card bg-dark border-danger mb-3">
                        <div class="card-body p-2">
                            <h5 class="text-danger mb-1">Este docente tem registro de restrição para o horário atribuído.</h5>
                        </div>
                    </div>
                </div>

                <div class="row" id="rowTresTurnos">
                    <h5 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Restrição do Docente!</h5>
                    <div class="card bg-dark border-danger mb-3">
                        <div class="card-body p-2">
                            <h5 class="text-danger mb-1">Este docente está alocado em três turnos em um mesmo dia.</h5>
                        </div>
                    </div>
                </div>

                <div class="row" id="rowIntervalo">
                    <h5 class="text-info"><i class="fa fa-exclamation-triangle"></i> Intervalo entre turnos!</h5>
                    <div class="card bg-dark border-info mb-3">
                        <div class="card-body p-2">
                            <h6 class="text-info mb-1" id="modalRemocaoIntervaloTipo">...</h6>
                            <h6 class="text-info mb-1" id="modalRemocaoIntervaloTempo">...</h6>
                            <h6 class="text-muted mb-1" id="modalRemocaoIntervaloCurso">...</h6>
                            <h6 class="text-muted mb-1" id="modalRemocaoIntervaloTurma">...</h6>
                            <p class="text-muted mb-1" id="modalRemocaoIntervaloDisciplina">...</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="rowConflito">
                    <h5 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Conflito identificado!</h5>
                    <div class="card bg-dark border-danger mb-3">
                        <div class="card-body p-2">
                            <h6 class="text-warning mb-1" id="modalRemocaoConflitoCurso">...</h6>
                            <h6 class="text-warning mb-1" id="modalRemocaoConflitoTurma">...</h6>
                            <p class="text-warning mb-1" id="modalRemocaoConflitoDisciplina">...</p>
                            <p class="text-warning mb-1" id="modalRemocaoConflitoProfessor">...</p>
                            <p class="text-warning mb-1" id="modalRemocaoConflitoAmbiente">...</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="rowAlterarAmbiente">
                    <div class="card bg-dark border-primary mb-3">
                        <div class="card-body p-1">
                            <label for="selectAmbiente">
                                <h6 class="text-primary">Selecione o(s) ambiente(s) para alterar:</h6>
                            </label>
                            <select class="form-select" id="alteraAmbiente" multiple="multiple" name="alteraAmbiente[]" style="width:100%;">
                                <?php foreach ($ambientes as $ambiente): ?>
                                    <option value="<?php echo esc($ambiente['id']) ?>"><?php echo esc($ambiente['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="text-end p-1">
                                <button type="button" class="btn btn-primary" id="confirmarAlterarAmbiente">Alterar Ambiente</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card bg-dark border-warning mb-3">
                        <div class="card-body p-1">
                            <p class="text-warning mb-1"><strong>Deseja remover esta disciplina do horário?</strong></p>
                            <h6 class="text-muted mb-0" id="modalRemocaoDisciplina"></h6>
                            <small class="text-muted" id="modalRemocaoProfessor"></small><br />
                            <small class="text-muted" id="modalRemocaoAmbiente"></small>
                        </div>
                        <div class="text-end p-1">
                            <button type="button" class="btn btn-danger" id="confirmarRemocao">Remover</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>