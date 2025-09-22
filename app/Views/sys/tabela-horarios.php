<link rel="stylesheet" href="<?php echo base_url("assets/css/tabela-horarios.css"); ?>">

<?php echo view('components/tabela-horarios/modal-atribuir-disciplina'); ?>
<?php echo view('components/tabela-horarios/modal-selecionar-ambiente'); ?>
<?php echo view('components/tabela-horarios/modal-analisar-horario'); ?>

<!-- Filtro -->
<div class="row g-3">
    <!-- Coluna esquerda - Filtros e Aulas Pendentes -->
    <div class="col-md-3 d-flex flex-column" style="position: relative; height: 74vh;">
        <!-- loader -->
        <div class="loader-demo-box">
            <div class="circle-loader"></div>
            <div id="loader-text">Carregando...</div>
        </div>

        <!-- Seção de Filtros -->
        <div class="card left-column-section mb-3" style="flex: 0 0 30%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="curso">Curso:</label>
                            <select class="js-basic-single filtro" style="width:100%;" id="filtroCurso">
                                <option value=""></option>
                                <?php foreach ($cursos as $curso): ?>
                                    <option value="<?php echo esc($curso['id']) ?>" data-regime="<?php echo esc($curso['regime']) ?>"><?php echo esc($curso['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="curso">Turma:</label>
                            <select class="js-basic-single filtro" style="width:100%;" id="filtroTurma">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seção de Aulas Pendentes -->
        <div class="card left-column-section position-relative" style="flex: 1; min-height: 0;">

            <div class="card-body d-flex flex-column position-relative" style="height: 100%;">

                <div class="row">
                    <div class="col-md-7 text-sm-start">
                        <small>Aulas Pendentes: <span class="badge badge-pill badge-info" id="aulasCounter">-</span></small>
                    </div>
                    <div class="col-md-5 text-sm-end">
                        <button id="btn_limpar_horarios" type="button" class="btn btn-warning"><i class="mdi mdi-calendar-remove"></i> Limpar</button>
                    </div>
                </div>

                <!--<div class="row">
                    <div class="col-12 text-center">
                        <button id="btn_atribuir_automaticamente" type="button" class="btn btn-info" disabled>
                            <i class="mdi mdi-auto-fix"></i> Auto atribuir
                        </button>
                    </div>
                </div>-->

                <hr class="my-2" />

                <div class="position-absolute start-0 end-0" style="top: 130px; bottom: 15px;">
                    <div class="h-100 overflow-y-auto custom-scrollbar" id="aulasContainer" style="overflow-x: hidden;">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Tabela de Horários (Manhã, Tarde, Noite) - Lado direito (9 colunas) -->
    <div class="col-lg-9">
        <div class="card" style="height: 74vh;">
            <div class="card-body overflow-y-auto overflow-x-hidden">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="tabela-horarios" class="table table-bordered text-center mb-4"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let URLbase = '<?= base_url(); ?>';
</script>

<script src="<?php echo base_url("assets/js/tabela-horarios/controles-de-interface.js"); ?>"></script>

<script>

    let horarios = [];  //Vetor global pra guardar dados dos horários da turma
    let cursos = [];    //Vetor global pra guardar dados dos cursos
    let aulas = [];     //Vetor global pra guardar dados das aulas pendentes

    //Referencia para os nomes dos dias da semana
    let nome_dia = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];

    // Define variáveis globais para armazenar os dados do modal
    const modalAtribuirDisciplinaElement = document.getElementById('modalAtribuirDisciplina');
    const modalSelecionarAmbienteElement = document.getElementById('modalSelecionarAmbiente');
    const modalAnalisarHorarioElement = document.getElementById('modalAnalisarHorario');

    // Inicializa os modais usando a API do Bootstrap 5
    const modalAtribuirDisciplina = new bootstrap.Modal(modalAtribuirDisciplinaElement);
    const modalSelecionarAmbiente = new bootstrap.Modal(modalSelecionarAmbienteElement);
    const modalAnalisarHorario = new bootstrap.Modal(modalAnalisarHorarioElement);

    const $modalAmbiente  = $('#modalAula');
    const $selectAmbiente = $('#selectAmbiente');
    let conflitosDetectados = null;
    const textoConflito = ' ⚠️';

    //Algumas globais pra controle dos modals
    let horarioSelecionado = null;

    //Função para retornar o objeto de uma aula pelo id
    function getAulaById(id) 
    {
        let theIdObj = null;

        $.each(aulas, function(idx, obj) 
        {
            if (obj.id == id) 
            {
                theIdObj = obj;
                return false; //simula o BREAK no .each do JQuery
            }
        });

        return theIdObj;
    }

    // config para não quebrar o select 
    const configSelectAmbiente = 
    {
        width: '100%',
        placeholder: 'Selecione o(s) ambiente(s)…',
        allowClear: true,
        closeOnSelect: false,
        language: { noResults: () => 'Sem resultados' },
        templateResult: function (data) 
        {
            if (!data.id) 
                return data.text;

            const $optionAmbiente = $(data.element);
            // se houver conflito, altera a cor e mostra o texto com conflito
            // se não, mostra apenas o texto padrão
            return $optionAmbiente.hasClass('option-conflito')
                ? $('<span class="text-secondary"></span>').text($optionAmbiente.text())
                : data.text;
        }
    };

    //função para destruir o select2 possibilitando que as opções marcadas com conflito sejam limpas antes da próxima abertura de modal
    function destroySelect2() 
    {
        if ($selectAmbiente.hasClass('select2-hidden-accessible')) 
        {
            $selectAmbiente.select2('close');
            $selectAmbiente.select2('destroy');
        }
    }

    function inicializarSelect2() 
    {
        if ($selectAmbiente.hasClass('select2-hidden-accessible')) 
            return; // se já iniciado, retorna

        const $selectNaModal = $selectAmbiente.closest('.modal');
        const fallbackSelect = $selectNaModal.length ? $selectNaModal : $(document.body); //evita erro caso o select não esteja dentro da modal ainda

        $selectAmbiente.select2({
            ...configSelectAmbiente,
            dropdownParent: fallbackSelect
        });
    }

    function limparOptionsSelect() 
    {
        //percorre todas as opcões do select e remove o texto de conflito, se houver
        $selectAmbiente.find('option').each(function () 
        {
            const $optionAmbiente = $(this);
            const textoPadrao = $optionAmbiente.attr('data-original-text') ?? $optionAmbiente.text().replace(textoConflito, '');
            $optionAmbiente.text(textoPadrao).removeClass('option-conflito').prop('disabled', false);
        });

        $selectAmbiente.val(null);
    }    

    function getAmbienteNome(id) 
    {
        let ambienteNome = "";

        $("#selectAmbiente option").each(function() 
        {
            if ($(this).val() == id) 
            {
                ambienteNome = $(this).text();
            }
        });

        return ambienteNome;
    }

    function getAmbienteId(nome) 
    {
        let ambienteId = -1;

        $("#selectAmbiente option").each(function() 
        {
            if ($(this).text().startsWith(nome))
            {
                ambienteId = $(this).val();
            }
        });

        return ambienteId;
    }

    // Carrega as disciplinas pendentes no modal
    function carregarDisciplinasPendentes(id)
    {
        id = id.split('_')[1]; // Extrai o ID do horário
        let dadosDoHorario = getHorarioById(id);

        $("#dia_da_aula").html(nome_dia[dadosDoHorario.dia_semana]);
        $("#hora_da_aula").html(dadosDoHorario.hora_inicio + ":" + dadosDoHorario.minuto_inicio);
        $("#modal_Turma").html($('#filtroTurma option:selected').text());

        $("#tabelaDisciplinasModal tbody").empty();

        // Verifica se há uma disciplina atribuída no horário selecionado
        if (horarioSelecionado && horarioSelecionado.data('disciplina')) 
        {
            const row = `
                <tr>
                    <td>${horarioSelecionado.data('disciplina')}</td>
                    <td>${horarioSelecionado.data('professor')}</td>
                    <td>1 aula</td>
                    <td><button class="btn btn-danger btn-sm btn-remover">Remover</button></td>
                </tr>
            `;

            $("#tabelaDisciplinasModal tbody").append(row);

            // Evento para botão remover
            $("#tabelaDisciplinasModal .btn-remover").click(function() 
            {
                mostrarModalConfirmacaoRemocao(horarioSelecionado[0]);
                modalAtribuirDisciplina.hide();
            });
        }

        $('.card[draggable="true"]').each(function() 
        {
            let theCard = $(this);

            let disciplinaRow = '' +
                '<tr>' +
                    '<td>' + $(this).data("disciplina") + '</td>' +
                    '<td>' + $(this).data("professor") + '</td>' +
                    '<td>' + $(this).data("aulas-pendentes") + ' aula(s)</td>' +
                    '<td>' +
                        '<button type="button" class="btn btn-primary btn-sm botao_atribuir" id="botao_atribuir_' + $(this).data("aula-id") + '" >Atribuir</button>' +
                    '</td>' +
                '</tr>';

            $("#tabelaDisciplinasModal tbody").append(disciplinaRow);

            // Adiciona evento de clique diretamente
            $("#botao_atribuir_" + $(this).data("aula-id")).on('click', function() 
            {
                atribuirDisciplina($(this).attr('id').split('_')[2], id);
            });
        });
    }

    //Função para pesquisar o id de um horário pelo dia e horários
    function getIdByDiaHoraMinuto(vetor, dia, hora_inicio, minuto_inicio, hora_fim, minuto_fim) 
    {
        let id = 0;

        $.each(vetor, function(idx, obj) 
        {
            if (obj.dia_semana == dia && obj.hora_inicio == hora_inicio && obj.minuto_inicio == minuto_inicio && obj.hora_fim == hora_fim && obj.minuto_fim == minuto_fim) 
            {
                id = obj.id;
                return false; //simula o BREAK no .each do JQuery
            }
        });

        return id;
    }

    //Função para retornar os dados de um horário pelo id
    function getHorarioById(id) 
    {
        let theIdObj = null;

        $.each(horarios, function(idx, obj) 
        {
            if (obj.id == id) 
            {
                theIdObj = obj;
                return false; //simula o BREAK no .each do JQuery
            }
        });

        return theIdObj;
    }

</script>

<script src="<?php echo base_url("assets/js/tabela-horarios/funcoes-de-mini-botoes.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/tabela-horarios/requisicoes-ajax.js"); ?>"></script>
