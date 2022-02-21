<?
$totalRo = count($data);

if($totalRo > 1){
    $nav = $data['rota'];
}else{
    $nav = $data[0]['rota'];
}

?>
<header>
    <div class="row">
        <div class="col-12 text-center">
            <img src="<? echo URL_BASE; ?>public/img/Logo-fundo-colorido.png" class="img-info" alt="">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <? echo $nav == '' || $nav == 'dashboard' ? 'active' : '' ?>" href="<? echo URL_BASE; ?>"><i class="fa fa-home ic-left"></i>Início</a>
                </li>
                
            

                <li class="nav-item">
                    <?
                    if(!isset($_SESSION['estaLogado'])){
                        ?>
                        <a class="nav-link <? echo $nav == 'login' || $nav == 'cadastro' ? 'active' : ''; ?>" href="<? echo URL_BASE ?>login"><i class="fa fa-sign-in ic-left"></i>login | Criar conta</a>
                        <?
                    }
                    ?>
                </li>

                <?
                if(isset($_SESSION['estaLogado'])){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <? echo $nav == 'painelUsuario' ? 'active' : '' ?>" href="<? echo URL_BASE ?>painelUsuario"><i class="fa fa-sign-in ic-left"></i>Meus agendamentos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <? echo $nav == 'login' || $nav == 'cadastro' ? 'active' : '' ?>" href="<? echo URL_BASE ?>login/logout"><i class="fa fa-sign-out ic-left"></i>Sair</a>
                    </li>
                    <?
                }
                ?>
                
            </ul>
        </div>
    </div>
</header>