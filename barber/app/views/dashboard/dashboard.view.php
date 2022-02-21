<div class="container-fluid mt-3">
    <div class="box-app">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 titulo-page"><i class="fa fa-dashboard ic-left"></i>Resumo</h4>
            </div>
        </div>
    </div>

    <div class="row my-2 align-items-center">
        <div class="col-3">
            <div class="box-app">
                <div class="row">
                    <div class="col-12 text-center">
                        <strong>Status do estabelecimento:</strong>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <?
                        $abrirEstabelecimento = strtotime('08:00:00');
                        $fecharEstabelecimento = strtotime('18:00:00');
                        $horaAtual = strtotime('now');
                        if($horaAtual < $abrirEstabelecimento || $horaAtual > $fecharEstabelecimento){
                            ?>
                            <span class="badge badge-danger">Fechado</span>
                            <?
                        }else{
                            ?>
                            <span class="badge badge-success">Aberto</span>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="box-app">
                <div class="row">
                    <div class="col-12 text-center">
                        <strong>Total de agendamentos do dia:</strong>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <h1 class="strong"><? echo count($data[0]['registros']); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-12">
            <div class="box-app">
                <div class="row">
                    <div class="col-12 text-left">
                        <strong><i class="fa fa-calendar ic-left"></i>Agendamentos recebidos:</strong>
                    </div>
                </div>
                <form action="<? echo URL_BASE; ?>dashboard/alterarData" method="post">
                    <div class="row mt-3 align-items-end">
                        <div class="col-8 col-md-2">
                            <label for="" class="control-label mb-0">Data referência:</label>
                            <input type="date" class="form-control" value="<? echo $_SESSION['dataRef']; ?>" name="dataref" required>
                        </div>

                        <div class="col-4 col-md-2">
                            <button class="btn btn-app" type="submit" name="alterarData">Alterar data de referência:</button>
                        </div>
                    </div>
                </form>

                <div class="row mt-3">
                    <?
                    if(count($data[0]['registros']) < 1){
                        ?>
                        <div class="col-12 text-center">
                            <img src="<? echo URL_BASE; ?>public/img/empty.png" class="img-info">
                            <h5>Sem agendamentos para a data <b><? echo date('d/m', strtotime($_SESSION['dataRef'])); ?></b>.</h4>
                        </div>
                        <?
                    }else{
                        ?>
                        <div class="col-12">
                            <table class="table table-reponsive-lg table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-left align-middle">#</th>
                                        <th class="text-left align-middle">Especialidade</th>
                                        <th class="text-left align-middle">Barbeiro</th>
                                        <th class="text-left align-middle">Cliente</th>
                                        <th class="text-left align-middle">Data e hora</th>
                                        <th class="text-left align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach($data[0]['registros'] as $agendamentos): ?>
                                    <tr>
                                        <td class="text-left align-middle">
                                            <? echo $agendamentos['id_agendamento']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <? echo $agendamentos['especialidade_agendamento']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <? echo $agendamentos['nome_barbeiro']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <? echo $agendamentos['nome_cliente'].' | '.$agendamentos['email_cliente']; ?>
                                        </td>
                                        <td class="text-left align-middle">
                                            <? 
                                                echo date('d/m/Y', strtotime($agendamentos['data_agendamento']))." às ".date('H:i', strtotime($agendamentos['data_agendamento'])).'h'; 
                                            ?>
                                            
                                        </td>
                                        <td class="text-left align-middle">
                                            <?
                                            if($agendamentos['status_agendamento'] == 'agendado'){
                                                ?>
                                                <span class="badge badge-success">Agendado</span>
                                                <?
                                            }else{
                                                ?>
                                                <span class="badge badge-warning">Cancelado</span>
                                                <?
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>