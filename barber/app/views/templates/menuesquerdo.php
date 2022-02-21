<?php
$navigation = $data[0]['rota'];
?>
<div class="col-md-12 flexTop lnh">
    <p class="mb-0">
        <small>
            Bem-vindo(a) <strong><? echo $_SESSION['nomeUsuario']; ?></strong>
        </small>
    </p>
</div>
<a href="<?php echo URL_BASE."dashboard/1"; ?>" class="<?php echo $navigation == 'dashboard' || $navigation == '' ? 'menu-ativo' : ''; ?>">
    <div class="row my-2">
        <div class="col-md-12 text-center" data-toggle="tooltip" title="Resumo">
            <i class="fa fa-dashboard"></i>
            <p class="mb-0"><small>Resumo</small></p>
        </div>
    </div>
</a>

<a href="<?php echo URL_BASE."barbeiros/1"; ?>" class="<?php echo $navigation == 'barbeiros' ? 'menu-ativo' : ''; ?>">
    <div class="row my-2">
        <div class="col-md-12 text-center" data-toggle="tooltip"title="Barbeiros">
            <i class="fa fa-users "></i>
            <p class="mb-0"><small>Barbeiros</small></p>
        </div>
    </div>
</a>




<a href="<?php echo URL_BASE."login/logout/"; ?>" class="<?php echo $navigation == 'logout' ? 'menu-ativo' : ''; ?>">
    <div class="row my-2">
        <div class="col-md-12 text-center" data-toggle="tooltip"title="Sair">
            <i class="fa fa-power-off"></i>
            <p class="mb-0"><small>Sair</small></p>
        </div>

    </div>
</a>

<div class="col-12 flexBottom">
    <img src="<? echo URL_BASE; ?>public/img/Logo-fundo-colorido.png" class="logoMiniLeft" alt="">
</div>