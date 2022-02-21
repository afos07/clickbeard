<div class="container margin-top-app">

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fa fa-address-book ic-left"></i>Meus agendamentos</h5>
            </div>

            <div class="card-body">
            <?
        // feedbacks
            if(!empty($data[0]['feedbacks'])){
                    foreach($data[0]['feedbacks'] as $feedback){
                        ?>
                        <div class="row">
                            <div class="col-12 lnh">
                                <?
                                if(isset($feedback['status'])){
                                    switch ($feedback['status']){
                                        case 'erro':
                                            ?>
                                            <div class="alert alert-erro alert-dismissible my-2">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <small>
                                                    <? echo $feedback['mensagem']; ?>
                                                </small>
                                            </div>
                                            <?
                                            break;
                                        case 'successo':
                                            ?>
                                            <div class="alert alert-successo alert-dismissible my-2">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <small>
                                                    <? echo $feedback['mensagem']; ?>
                                                </small>
                                            </div>
                                            <?
                                            break;
                                        default:
                                            echo $feedback['mensagem'];
                                            break;
                                
                                    }
                                }else{
                                    echo $feedback;
                                }
                                ?>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>
                <div class="row">
                    <?
                    if(count($data[0]['registros']) < 1){
                        ?>
                        <div class="col-12 text-center">
                            <img src="<? echo URL_BASE; ?>public/img/empty.png" class="img-info">
                            <h5>Você ainda não realizou nenhum agendamento</h4>
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
                                            <? 
                                                echo date('d/m/Y', strtotime($agendamentos['data_agendamento']))." às ".date('H:i', strtotime($agendamentos['data_agendamento'])).'h'; 
                                            ?>
                                            
                                        </td>
                                        <td class="text-left align-middle">
                                            <?
                                            if($agendamentos['status_agendamento'] == 'agendado'){
                                                ?>
                                                <span class="badge badge-success">Agendado</span>
                                                <p class="mb-0">
                                                    <a href="<? echo URL_BASE ?>painelUsuario/cancelarAgendamento/<? echo $agendamentos['id_agendamento']; ?>" class="text-warning strong onConfirm">Cancelar</a>
                                                </p>
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

</div>