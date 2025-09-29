<?php echo view('components/home/modal-listar-conflitos'); ?>

<div class="row">
    <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="row card-body" id="cards-conflitos">
                <div class="alert alert-primary bg-dark text-light">Verificando conflitos...</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">3 (três)</h3>
                            <p class="text-danger ms-2 mb-0 font-weight-medium">
                                Aulas
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Aulas sem horários</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">4 (quatro)</h3>
                            <p class="text-danger ms-2 mb-0 font-weight-medium">
                                Disciplinas
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Sem aulas associadas</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">3 (três)</h3>
                            <p class="text-success ms-2 mb-0 font-weight-medium">
                                Confirmados
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Pedidos de substituição de professor</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">1 (um)</h3>
                            <p class="text-danger ms-2 mb-0 font-weight-medium">
                                Mensagens
                            </p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-danger">
                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Mensagens não respondidas</h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">OCUPAÇÕES DAS SALAS</h4>
                <div class="position-relative">
                    <div class="daoughnutchart-wrapper">
                        <canvas id="disponibilidade-salas" data-disp="3" data-reserv="5" data-indisp="6" class="transaction-chart"></canvas>
                    </div>
                    <div class="custom-value">55 <span>Total</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DISPONIBILIDADE DE PROFESSORES</h4>
                <div class="position-relative">
                    <div class="daoughnutchart-wrapper">
                        <canvas id="disponibilidade-professores" data-disp="3" data-indisp="6" class="transaction-chart"></canvas>
                    </div>
                    <div class="custom-value">250 <span>Total</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">QUADRO DE AULAS</h4>
 <!--               <p class="card-description">Aulas agendadas para a data de hoje</p> -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Ordem #</th>
                                        <th>Nível</th>
                                        <th>Turno</th>
                                        <th>Turma</th>
                                        <th>Disciplina</th>
                                        <th>Professor</th>
                                        <th>Sala</th>
                                        <th>Início</th>
                                        <th>Fim</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Médio</td>
                                        <td>Manhã</td>
                                        <td>Terceiro - 01</td>
                                        <td>Matemática</td>
                                        <td>Miguel</td>
                                        <td>Sala 05</td>
                                        <td>07:30</td>
                                        <td>08:25</td>
                                        <td>
                                            <label class="badge badge-success">Em andamento</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Visualizar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Médio</td>
                                        <td>Manhã</td>
                                        <td>Terceiro - 02</td>
                                        <td>Biologia</td>
                                        <td>Russimeire</td>
                                        <td>Sala 06</td>
                                        <td>08:25</td>
                                        <td>09:15</td>
                                        <td>
                                            <label class="badge badge-danger">Pendente</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Visualizar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Integrado</td>
                                        <td>Manhã</td>
                                        <td>Segundo - 01</td>
                                        <td>Biologia</td>
                                        <td>Russimeire</td>
                                        <td>Sala 07</td>
                                        <td>09:15</td>
                                        <td>10:00</td>
                                        <td>
                                            <label class="badge badge-info">Prevista</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Visualizar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Integrado</td>
                                        <td>Manhã</td>
                                        <td>Segundo - 02</td>
                                        <td>Química</td>
                                        <td>Mônica</td>
                                        <td>Sala 06</td>
                                        <td>10:15</td>
                                        <td>11:00</td>
                                        <td>
                                            <label class="badge badge-info">Prevista</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Visualizar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Graduação</td>
                                        <td>Noite</td>
                                        <td>ADS - 01</td>
                                        <td>Inglês</td>
                                        <td>Doralice</td>
                                        <td>Sala 03</td>
                                        <td>19:00</td>
                                        <td>19:45</td>
                                        <td>
                                            <label class="badge badge-info">Prevista</label>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary">Visualizar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById('cards-conflitos');
  container.innerHTML = `
    <div class="col-12"><div class="alert alert-secondary">Carregando conflitos…</div></div>
  `;

  const ENDPOINT_POR_ID = "<?= base_url('sys/tabela-horarios/choque-ambiente') ?>"; 

  //essa pool faz com que as consultas simultâneas ocorram de 8 em 8, evitando lentidão
  async function pool(items, worker, size = 8) {
    const out = new Array(items.length);
    let i = 0;
    await Promise.all(new Array(Math.min(size, items.length)).fill(0).map(async () => {
      while (i < items.length) {
        const idx = i++;
        try { out[idx] = await worker(items[idx]); }
        catch { out[idx] = null; }
      }
    }));
    return out.filter(Boolean);
  }
  
  //definindo como os dados vão ser buscados/listados 
  async function fetchDetalhePorId(id, tipo) {
    try {
      const response = await fetch(`${ENDPOINT_POR_ID}/${id}/${tipo}`);
      const data = await response.json();

      return {
        horario: data.horario ?? id,
        ambiente: data.ambiente ?? data.ambiente ?? '---',
        professor: data.professor ?? data.professor ?? '---',
        curso: data.curso ?? data.curso ?? '---',
        turma: data.turma ?? data.turma ?? '---',
        dia: data.dia ?? data.dia ?? '---',
        link_editar: data.link_editar ?? ("<?= base_url('sys/tabela-horarios') ?>")
      };
    } catch (e) {
      console.error(e);
    }
  }

  //mostrando o detalhamento de conflitos da modal
  function renderConflitos(itens, modalEl) {
    const tbody = modalEl.querySelector('#tbl-conflitos-body');
    tbody.innerHTML = '';
    if (!itens.length) {
      tbody.innerHTML = '<tr><td colspan="9" class="text-center text-muted">Nenhum item encontrado.</td></tr>';
      return;
    }
    
    tbody.innerHTML = itens.map((conflito, i) => `
      <tr class="text-center">
        <td>${i + 1}</td>
        <td>${conflito.horario ?? ''}</td>
        <td>${conflito.ambiente ?? ''}</td>
        <td>${conflito.professor ?? ''}</td>
        <td>${conflito.curso ?? ''}</td>
        <td>${conflito.turma ?? ''}</td>
        <td>${conflito.dia ?? ''}</td>
        <td>${conflito.link_editar ? `<a class="btn btn-sm btn-outline-primary" target="_blank" href="${conflito.link_editar}">Abrir</a>` : ''}</td>
      </tr>
    `).join('');
  }

  //carregando conflitos e buscando dados para serem listados
  async function carregarConflitosDoTipo(tipoChave, modalEl) {
    const ids = (window.conflitoIdsByTipo?.[tipoChave]) || [];
    const loading = modalEl.querySelector('#conflitos-loading');
    const resumo  = modalEl.querySelector('#conflitos-resumo');
    const tbody   = modalEl.querySelector('#tbl-conflitos-body');

    loading.style.display = 'block';
    resumo.textContent = '';
    tbody.innerHTML = '';

    if (!ids.length) {
      loading.style.display = 'none';
      tbody.innerHTML = '<tr><td colspan="9" class="text-center text-muted">Nenhum item.</td></tr>';
      return;
    }
    
    const tiposDeConflito = {
      'CONFLITO-AMBIENTE':  'ambiente',
      'CONFLITO-PROFESSOR': 'professor',
      'CONFLITO-TURNOS':    'turnos',
      'RESTRIÇÃO-DOCENTE':  'restricao',
      'CONFLITO-INTERVALO': 'intervalo'
    };

     const tipo = tiposDeConflito[tipoChave];
    const itens = await pool(ids, (id) => fetchDetalhePorId(id, tipo), 8);

    renderConflitos(itens, modalEl);

    loading.style.display = 'none';
    resumo.textContent = `${itens.length} registro(s).`;
  }

  fetch("<?= base_url('sys/tabela-horarios/verificar-todos-conflitos') ?>")
  //fetch("http://localhost/horarios/public/sys/tabela-horarios/verificar-todos-conflitos")
    .then(r => r.json())
    .then(data => {
      container.innerHTML = '';

      console.log(data)
      // Guarda os IDs por tipo 
      const conflitoIdsByTipo = {};
      ['CONFLITO-AMBIENTE','CONFLITO-INTERVALO','CONFLITO-PROFESSOR','CONFLITO-TURNOS','RESTRIÇÃO-DOCENTE']
        .forEach(key => {
          const arr = Array.isArray(data[key]) ? data[key] : [];
          conflitoIdsByTipo[key] = arr
            .map(x => parseInt(x.id_conflito, 10))
            .filter(Number.isFinite);
        });

      // Torna acessível no handler da modal
      window.conflitoIdsByTipo = conflitoIdsByTipo;

      const tipos = {
        'COUNT-AMBIENTE': {
          cor: 'danger',
          icone: 'mdi-map-marker-off',
          texto: 'Conflitos de Ambiente',
          chaveLista: 'CONFLITO-AMBIENTE' 
        },
        'COUNT-PROFESSOR': {
          cor: 'warning',
          icone: 'mdi-account-alert',
          texto: 'Conflitos de Professor',
          chaveLista: 'CONFLITO-PROFESSOR'
        },
        'COUNT-TURNOS': {
          cor: 'danger',
          icone: 'mdi-clock-alert-outline',
          texto: 'Conflitos de Turnos',
          chaveLista: 'CONFLITO-TURNOS'
        },
        'COUNT-RESTRIÇÃO': {
          cor: 'warning',
          icone: 'mdi-account-cancel-outline',
          texto: 'Restrição de Professor',
          chaveLista: 'RESTRIÇÃO-DOCENTE'
        },
        'COUNT-INTERVALO': {
          cor: 'info',
          icone: 'mdi-timer-off-outline',
          texto: 'Conflitos de Intervalo',
          chaveLista: 'CONFLITO-INTERVALO'
        }
      };

      Object.entries(tipos).forEach(([chaveContador, cfg]) => {
        const quantidade = Number(data[chaveContador] ?? 0);
        if (!quantidade) return;

        container.innerHTML += `
          <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card border border-${cfg.cor}">
              <div class="card-body">
                <div class="row">
                  <div class="col-9">
                    <div class="d-flex align-items-center align-self-start">
                      <button class="mb-2 btn btn-outline-${cfg.cor} fs-6 fw-bold text-light icon icon-box-${cfg.cor}"
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-listar-conflitos"
                        data-tipo-chave="${cfg.chaveLista}"
                        data-tipo-conflito="${cfg.texto}">
                        ${quantidade}
                      </button>
                      <p class="text-${cfg.cor} ms-2 mb-2 font-weight-medium">Aulas</p>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="icon icon-box-${cfg.cor}">
                      <span class="mdi ${cfg.icone} icon-item"></span>
                    </div>
                  </div>
                </div>
                <h6 class="text-muted font-weight-normal">${cfg.texto}</h6>
              </div>
            </div>
          </div>
        `;
      });

      if (!container.innerHTML.trim()) {
        container.innerHTML = `
          
            <div class="alert alert-primary bg-dark text-light">Nenhum conflito encontrado.</div>
          `;
      }
    })
    .catch(err => {
      container.innerHTML = '<div class="alert alert-danger">Erro ao carregar conflitos.</div>';
      console.error(err);
    });

  $('#modal-listar-conflitos').off('show.bs.modal').on('show.bs.modal', function (e) {
    const btn       = $(e.relatedTarget);
    const tipoLabel = btn.data('tipo-conflito');   
    const tipoChave = btn.data('tipo-chave');      

    this.querySelector('#listar_conflito_tipo').textContent = tipoLabel || 'Conflitos';
    carregarConflitosDoTipo(tipoChave, this);
  });

});
</script>




