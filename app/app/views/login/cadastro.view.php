<div class="container margin-top-app">
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
        <div class="row">
        <div class="col-12 col-md-12 text-center">
            <img src="<? echo URL_BASE; ?>public/img/Logo-fundo-branco.png" class="img-logo-login" alt="">
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-12 text-center">
            <span class="badge badge-success">AGENDAMENTOS</span>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center lnh">
            <small class="text-muted">
                <i class="fa fa-smile-o ic-left"></i><strong>Que bom ter você conosco!</strong>
                informe seu e-mail, nome e senha de acesso para criar sua conta em nossa plataforma.    
            </small>
        </div>
    </div>
    <form action="<? echo URL_BASE; ?>login/cadastro" method="post">
    <?
            // feedbacks
    if(!empty($data['feedbacks'])){
        foreach($data['feedbacks'] as $feedback){
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

        <div class="row my-3">
            <div class="col-12">
                <input type="text" class="form-control-app" placeholder="Nome" name="nome" id="nome" autocomplete="off">
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12">
                <input type="email" class="form-control-app" placeholder="E-mail" name="email" id="email" autocomplete="off" >
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12">
                <input type="password" class="form-control-app" placeholder="Senha" name="senha" id="senha" value="">
            </div>
        </div>

        <div class="row my-3 align-items-center">
            <div class="col-4 text-left">
                <button class="btn btn-app" type="submit" name="cadastrar"><i class="fa fa-sign-in ic-left"></i>Criar conta e entrar</button>
            </div>
            
        </div>

        <div class="row">
            <div class="col-12 text-center lnh">
                <b>Já tem sua conta? <a href="<? echo URL_BASE; ?>login">Clique aqui</a> e se realize o login!</b>
            </div>
        </div>
    </form>
    </div>
    </div>
</div>