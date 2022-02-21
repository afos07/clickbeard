
<div class="container">
    <div class="app-home">
        <div class="row">
            <div class="col-12">
                <img src="<? echo URL_BASE; ?>public/img/welcome.png" class="img-media" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?
                $hora = date('H:i:s');
                $abrirEstabelecimento = strtotime('08:00:00');
                $fecharEstabelecimento = strtotime('18:00:00');
                $horaAgendamento = strtotime(date('H:i:s', strtotime($hora)));
                if($horaAgendamento < $abrirEstabelecimento || $horaAgendamento > $fecharEstabelecimento){
                    ?>
                    <span class="badge badge-warning">Nosso espaço físico está fechado | 08:00h às 18:00h</span>
                    <?
                }else{
                    ?>
                    <span class="badge badge-success">Nosso espaço físico está aberto</span>
                    <?
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h2>Olá, seja bem-vindo ao sistema de agendamento da <span class="strong">ClickBeard</span>.</h2>
                <h4>
                    Agora você pode agendar um de nossos serviços de maneira simples e rápida.
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-app text-uppercase strong" data-toggle="modal" data-target="#modalNovoAgendamento">
                    <i class="fa fa-address-book ic-left"></i>Agendar um atendimento
                </button>
            </div>
            <div class="col-12 text-center">
                <small class="text-muted">
                    <i class="fa fa-info ic-left"></i>Você precisa estar logado para concluir o processo de agendamento!
                </small>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNovoAgendamento">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Novo agendamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 lnh text-center text-muted">
                <?
                if(isset($_SESSION['estaLogado'])){
                    // logado
                    ?>
                    <span>
                        <strong>
                            Oi <? echo $_SESSION['nomeUsuario']; ?> vamos realizar seu agendamento.
                        </strong>
                    </span>
                    <?
                }else{
                    ?>
                    <span>
                        <strong>
                            Oi. Acabei observando que você não está logado ainda. Você precisa estar logado para concluir um agendamento!
                        </strong>
                    </span>
                    <?
                }
                ?>
            </div>
        </div>

        <?
        if(isset($_SESSION['estaLogado'])){
            ?>
            <div class="row mt-3 lnh align-items-end">
                <div class="col-8">
                    <label for="" class="control-label mb-0">Para quando você deseja o atendimento?</label>
                    <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<? echo date('Y-m-d') ?>">
                </div>

                <div class="col-4">
                    <label for="" class="control-label mb-0">E qual horário?</label>
                    <input type="time" class="form-control" id="hora_agendamento" name="hora_agendamento">
                </div>
            </div>

            <div class="row mt-3 lnh align-items-end">
                <div class="col-12">
                    <label for="" class="control-label mb-0">Especialidade:</label>
                    <select name="especialidade_agendamento" id="especialidade_agendamento" required class="custom-select">
                        <option value="">Selecione uma especialidade</option>
                        <?
                        foreach($data[0]['especialidades'] as $esp){
                            ?>
                            <option value="<? echo $esp; ?>"><? echo $esp; ?></option>
                            <?
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mt-3 lnh align-items-end">
                <div class="col-12">
                    <label for="" class="control-label mb-0">Barbeiro:</label>
                    <select name="barbeiro_agendamento" id="barbeiro_agendamento" required class="custom-select">
                        <option value="">Selecione um barbeiro</option>
                    </select>
                </div>
            </div>
            <?
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" <? echo empty($_SESSION['estaLogado']) ? 'disabled' : '' ?> id="btnAgendar">Realizar agendamento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
    window.onload = ()=>{
        const selecionaEspecialidade = ()=>{
            // ao selecionar a especialidade, será criado uma requisicao para buscar os barbeiros disponíveis
            
            $('#especialidade_agendamento').change(function(){
                
                let esp = $(this).val();
                let data = '';
                $.ajax({
                    url:`${URL_BASE}ajax/listaBarbeiros`,
                    type:'POST',
                    dataType:'json',
                    data:{esp:esp, listarBar:''},
                    success:function(retorno){
                        if(retorno.length > 0){
                            // vamos percorrer o obj e passar para o select
                            
                            data += `<option value="">Selecione o barbeiro</option>`;
                            for(i = 0; i < retorno.length; i++){
                                data += `
                                    <option value="${retorno[i].id_barbeiro}">${retorno[i].nome_barbeiro}</option>
                                `;
                            }
                            $('#barbeiro_agendamento').html(data);
                            $('#btnAgendar').removeAttr('disabled');
                        }else{
                            toastr.info('Nenhum barbeiro disponível para a especialidade', 'Atenção: ');
                            let data = `<option value="">Selecione o barbeiro</option>`;
                            $('#barbeiro_agendamento').html(data);
                            $('#btnAgendar').attr('disabled', 'disabled');
                        }
                    },
                    error:function(){
                        $('#barbeiro_agendamento').html(data);
                        $('#btnAgendar').attr('disabled', 'disabled');
                        toastr.error(msgErrorNetwork, 'Erro de conexão');
                    }
                })

                agendaAtendimento();
            })
        }

        selecionaEspecialidade();

        const agendaAtendimento = ()=>{
            $('#btnAgendar').click(function(){
                let dataAgendamento = $('#data_agendamento').val();
                let horaAgendamento = $('#hora_agendamento').val();
                let especialidadeAgendamento = $('#especialidade_agendamento').val();
                let barbeiroAgendamento = $('#barbeiro_agendamento').val();
                if(dataAgendamento.length < 10){
                    toastr.error('Nos informe a data que voce deseja o atendimento.', 'Erro');
                }else if(horaAgendamento.length < 5){
                    toastr.error('Nos informe a hora que voce deseja o atendimento.', 'Erro');
                }else if(especialidadeAgendamento.length < 1){
                    toastr.error('Selecione uma espcialidade que voce deseja o atendimento.', 'Erro');
                }else if(barbeiroAgendamento.length < 1){
                    toastr.error('Selecione uma barbeiro.', 'Erro');
                }else{
                    console.log(barbeiroAgendamento);
                    $.ajax({
                    url:`${URL_BASE}ajax/agendarAtendimento`,
                    type:'POST',
                    dataType:'json',
                    data:{dataAgendamento:dataAgendamento, horaAgendamento:horaAgendamento, especialidadeAgendamento:especialidadeAgendamento, barbeiroAgendamento:barbeiroAgendamento},
                    success:function(retorno){
                        if(retorno.status == 'successo'){
                            toastr.success(retorno.mensagem, 'Tudo certo!');
                            $('#modalNovoAgendamento').modal('hide');
                            setTimeout(function(){
                                window.location.href = URL_BASE+'painelUsuario';
                            }, 1000)
                        }else{
                            toastr.warning(retorno.mensagem, 'Erro de conexão');
                        }
                    },
                    error:function(){
                        toastr.error(msgErrorNetwork, 'Erro de conexão');
                    }
                })
                }
            })
        }   
    }
</script>