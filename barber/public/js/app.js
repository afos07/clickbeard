const serverOnline = false;
let URL_BASE = '';
const msgErrorNetwork = 'Não foi possível executar a ação solicitada. Verifique sua conexão com a internet e tente novamente.';
if(serverOnline){
    URL_BASE = '';
}else{
    URL_BASE = 'http://localhost/clickbeard/barber/';
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    const openModal = ()=>{
        // funcão para abrir modals
        $('.openModal').click(function () {
            let target = $(this).attr('modal');
            $(target).modal('show');
        });
    }

    openModal();

    const onBack = ()=>{
        $('.onBack').click(function(){
            window.history.back();
        })
    }
    onBack();

    const onConfirm = ()=>{
        $('.onConfirm').click(function(){
            let url = $(this).attr('href');
            Swal.fire({
                title: 'Você realmente deseja prosseguir com esta operação?',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText:'Não',
            }).then((result) => {
                if(result.value){
                    window.location.href = url;
                }
            });
            return false;
        })
    }
    onConfirm();
})