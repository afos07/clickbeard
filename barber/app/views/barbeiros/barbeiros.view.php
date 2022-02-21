<div class="container-fluid mt-3">
    <div class="box-app">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 titulo-page"><i class="fa fa-users ic-left"></i>Barbeiros</h4>
            </div>
        </div>
    </div>

    <div class="box-app my-2">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-app text-uppercase openModal" modal="#modalNovoBarbeiro"><i class="fa fa-user-plus ic-left"></i>Cadastrar um novo barbeiro</button>
            </div>
        </div>
    </div>

    <div class="box-app my-2">
        <?

        // feedbacks
        if(!empty($data[0]['feedbacks'])){
            foreach($data[0]['feedbacks'] as $feedback){
                ?>
                <div class="row">
                    <div class="col-12">
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
<!--        Aqui vamos exibir os barbeiros-->
        <div class="row my-2">
            <?
            if(empty($data[0]['registros'])){
                ?>
                <div class="col-12 text-center">
                    <img src="<? echo URL_BASE; ?>public/img/empty.png" class="img-info" alt="">
                    <p class="mb-0 mt-3">
                        <span>
                            Nenhum barbeiro cadastrado. <a href="#" data-toggle="modal" data-target="#modalNovoBarbeiro"><strong>Clique aqui</strong></a> para cadastrar seu primeiro barbeiro.
                        </span>
                    </p>
                </div>
                <?
            }else{
                ?>
                <div class="col-12">
                    <table class="table table-striped table-responsive-lg table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-left">Nome</th>
                            <th class="text-center">Idade</th>
                            <th class="text-center">Data de contratação</th>
                            <th class="text-right">Outras opcões</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach($data[0]['registros'] as $barbeiros): ?>
                        <tr>
                            <td class="text-center">
                                <? echo $barbeiros['id_barbeiro']; ?>
                            </td>
                            <td class="text-left">
                                <? echo $barbeiros['nome_barbeiro']; ?>
                            </td>
                            <td class="text-center">
                                <? echo $barbeiros['idade_barbeiro']; ?>
                            </td>
                            <td class="text-center">
                                <? echo date('d/m/Y', strtotime($barbeiros['data_contratacao_barbeiro'])); ?>
                            </td>
                            <td class="text-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<? echo URL_BASE; ?>barbeiros/detalhes/<? echo $barbeiros['id_barbeiro']; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-eye ic-left"></i>Detalhes e especialidades</a>
                                    <a href="<? echo URL_BASE ?>barbeiros/apagar/<? echo $barbeiros['id_barbeiro']; ?>" class="btn btn-danger strong btn-sm onConfirm"><i class="fa fa-trash ic-left"></i>Apagar</a>
                                </div>
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

<div class="modal fade" id="modalNovoBarbeiro">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar um novo barbeiro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<? echo URL_BASE ?>barbeiros/cadastrar" method="post">
                <div class="modal-body">
                    <div class="row form-group">
                        <label for="" class="control-label col-form-label col-3">*Nome:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nome_barbeiro" placeholder="Ex: João Arinaldo">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="" class="control-label col-form-label col-3">*Idade:</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="idade_barbeiro" id="idade_barbeiros" min="16" placeholder="Ex: 26">
                        </div>
                    </div>

                    <div class="row form-group align-items-center lnh">
                        <label for="" class="control-label col-form-label col-3">*Data de contratação:</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" name="data_contratacao_barbeiro" id="data_contratacao_barbeiro" value="<? echo date('Y-m-d'); ?>" placeholder="Ex: 26">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="salvar_barbeiro" class="btn btn-primary">Salvar</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>