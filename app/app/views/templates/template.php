<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickBeard | Agendamentos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/libs/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/libs/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/css/style.css">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/libs/toastr/toastr.css">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/libs/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="<? echo URL_BASE; ?>public/libs/datetimepicker-master/build/jquery.datetimepicker.min.css">
</head>
<body>
    
    <? require_once "App/Views/templates/navbar.php"; ?>
    <? require_once 'App/views/'.$view.'.view.php'; ?>
</body>
<script src="<? echo URL_BASE; ?>public/libs/jquery/dist/jquery.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/bootstrap-4.0.0-dist/js/bootstrap.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/toastr/toastr.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/sweetalert2/dist/sweetalert2.js"></script>
<script src="<? echo URL_BASE; ?>public/libs/datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script src="<? echo URL_BASE; ?>public/js/app.js"></script>
</html>