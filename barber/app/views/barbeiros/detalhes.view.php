
<?php
$infoBarbeiro = $data[0]['dadosBarbeiro'];

?>
<div class="container-fluid mt-3">
    <div class="box-app">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 titulo-page"><i class="fa fa-dashboard ic-left"></i>Detalhes e especialidades</h4>
            </div>
        </div>
    </div>
    <div class="box-app my-2">
        <div class="row">
            <div class="col-3">
                <button class="btn btn-app onBack"><i class="fa fa-arrow-left ic-left"></i>Voltar</button>

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
        <div class="row mt-3">
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link clickTab" data-toggle="tab" href="#dadosBarbeiros"><i class="fa fa-info-circle ic-left"></i>Dados básico sobre o barbeiro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active clickTab" data-toggle="tab" href="#especialidadesBarbeiros"><i class="fa fa-graduation-cap ic-left"></i>Especialidades</a>
                    </li>

                </ul>
                <div id="tabApp" class="tab-content mt-3">
                    <div class="tab-pane fade " id="dadosBarbeiros">
                        <form action="<? echo URL_BASE ?>barbeiros/detalhes/<? echo $infoBarbeiro['id_barbeiro'] ?>" method="post">
                            <div class="row form-group">
                                <label for="" class="control-label col-form-label col-2">*Nome:</label>
                                <div class="col-sm-6">
                                    <input type="hidden" value=" <? echo $infoBarbeiro['id_barbeiro']; ?>" name="id_barbeiro" readonly>
                                    <input type="text" class="form-control" name="nome_barbeiro" placeholder="Ex: João Arinaldo" value="<? echo $infoBarbeiro['nome_barbeiro']; ?>" required>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="control-label col-form-label col-2">*Idade:</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="idade_barbeiro" id="idade_barbeiros" min="16" placeholder="Ex: 26" value="<? echo $infoBarbeiro['idade_barbeiro']; ?>" required>
                                </div>
                            </div>

                            <div class="row form-group align-items-center lnh">
                                <label for="" class="control-label col-form-label col-md-2 col-12">*Data de contratação:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="data_contratacao_barbeiro" id="data_contratacao_barbeiro" value="<? echo $infoBarbeiro['data_contratacao_barbeiro']; ?>" placeholder="Ex: 26" required>
                                </div>
                            </div>

                            <div class="row form-group align-items-center lnh">
                                <div class="col-md-2 col-12">

                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-success" type="submit" name="atualizar_barbeiro"><i class="fa fa-save ic-left"></i>Atualizar dados do barbeiro</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="especialidadesBarbeiros">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <span class="card-subtitle strong"><i class="fa fa-gratipay ic-left text-danger"></i>Especialidades de <? echo $infoBarbeiro['nome_barbeiro'] ?></span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row my-2">
                                            <?
                                            if(empty($data[0]['especialidadesBarbeiros'])){
                                                ?>
                                                <div class="col-12 text-center">
                                                    <img src="<? echo URL_BASE; ?>public/img/empty.png" class="img-info" alt="">
                                                    <p class="mb-0 mt-3">
                                                        <span>
                                                            Nenhuma especialidade para o barbeiro cadastrada.
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
                                                            <th class="text-left">Descrição</th>

                                                            <th class="text-right">Outras opcões</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <? foreach($data[0]['especialidadesBarbeiros'] as $especialidades): ?>
                                                            <tr>
                                                                <td class="text-left align-middle">
                                                                    <? echo $especialidades['desc_especialidade']; ?>
                                                                </td>
                                                                <td class="text-right align-middle">
                                                                    <div class="btn-group" role="group">
                                                                        <a href="#" class="btn btn-danger strong btn-sm apagaEsp" esp="<? echo base64_encode($especialidades['id_especialidade']); ?>" idB="<? echo base64_encode($especialidades['barbeiro_id_especialidade']); ?>"><i class="fa fa-trash ic-left"></i>Apagar</a>
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
                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <span class="card-subtitle strong"><i class="fa fa-gratipay ic-left text-danger"></i>Cadastre uma nova especialidade para <? echo $infoBarbeiro['nome_barbeiro'] ?></span>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" method="post" id="formEspecialidades">
                                            <div class="row form-group">
                                                <label for="" class="control-label col-form-label col-3">*Descrição:</label>
                                                <div class="col-sm-6">
                                                    <input type="hidden" value=" <? echo $infoBarbeiro['id_barbeiro']; ?>" name="id_barbeiro" readonly>
                                                    <select name="especialidade_barbeiro" id="especialidade_barbeiro" required class="custom-select">
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
                                            <div class="row form-group align-items-center lnh">
                                                <div class="col-md-3 col-12">

                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success" type="submit" name="atualizar_barbeiro"><i class="fa fa-save ic-left"></i>Cadastrar especialidade</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = ()=>{
        const apagaEsp = ()=>{
            $('.apagaEsp').click(function(){
                Swal.fire({
                title: 'Você realmente deseja prosseguir com esta operação?',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText:'Não',
                }).then((result) => {
                    if(result.value){
                        let id = atob($(this).attr('esp'));
                        let idB = atob($(this).attr('idB'));
                        $.ajax({
                            url:`${URL_BASE}ajax/apagaEspBarbeiro`,
                            type:'POST',
                            dataType:'json',
                            data:{
                                esp:id,
                                idB:idB
                            },
                            success:function(retorno){
                                if(retorno.status == 'successo'){
                                    toastr.success(retorno.mensagem, 'Tudo certo!');
                                    setTimeout(function(){
                                        document.location.reload(true);
                                    }, 2000);
                                }else{
                                    toastr.info(retorno.mensagem, 'Atenção: ');
                                }
                            },
                            error:function(){
                                toastr.error(msgErrorNetwork, 'Erro de conexão');
                            }
                        });
                    }
                });
                
            });
        }
        apagaEsp();
        
        const addEsp = ()=>{
            $('#formEspecialidades').submit(function(e){
                e.preventDefault();
                let ref = $(this).serialize();
                $.ajax({
                    url:`${URL_BASE}ajax/cadastraEspBarbeiro`,
                    type:'POST',
                    dataType:'json',
                    data:ref,
                    success:function(retorno){
                        if(retorno.status == 'successo'){
                            toastr.success(retorno.mensagem, 'Tudo certo!');
                            setTimeout(function(){
                                document.location.reload(true);
                            }, 2000);       
                        }else{
                            toastr.info(retorno.mensagem, 'Atenção: ');
                        }
                    },
                    error:function(){
                        toastr.error(msgErrorNetwork, 'Erro de conexão');
                    }
                })
            })
        }
        addEsp();

        const clickTab = ()=>{
            $('.clickTab').click(function(){
                let target = $(this).attr('href');
                localStorage.setItem('@navTabActive', target);
            });
        }
        clickTab();

        const tabActiveVeriify = ()=>{
            let target = localStorage.getItem('@navTabActive');
            if(target){
                $('.clickTab').removeClass('active');
                $(`[href="${target}"]`).tab('show');
            }
        }
        tabActiveVeriify();
    }
</script>