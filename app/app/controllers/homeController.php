<?php
use App\core\Controller;
use App\Auth;
class Home extends Controller {
    public function index(){
        $especialidades = ["Sobrancelha", "Corte de Tesoura", "Corte de Máquina", "Bigode", "Peruca", "Desenhos"];

        $data = [
            "rota"=> "dashboard",
            "especialidades"=> $especialidades
        ];
        $this-> view('dashboard/dashboard', [$data]);
    }


}