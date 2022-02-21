<div class="container-login">
    <div class="boxLogin">
        <div class="row">
            <div class="col-12 col-md-12 text-center">
                <img src="<? echo URL_BASE; ?>public/img/Logo-fundo-branco.png" class="img-logo-login" alt="">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12 text-center">
                <span class="badge badge-success">ADMIN</span>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center lnh">
                <small class="text-muted">
                    <i class="fa fa-smile-o ic-left"></i><strong>Que bom que você voltou!</strong>
                    informe seu e-mail e senha de acesso para entrar no <strong>ClickBeard!</strong>
                </small>
            </div>
        </div>

        <form action="<? echo URL_BASE; ?>login/entrar" method="post">

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
                    <input type="email" class="form-control-app" placeholder="E-mail" name="email" id="email" autocomplete="off">
                </div>
            </div>

            <div class="row my-3">
                <div class="col-12">
                    <input type="password" class="form-control-app" placeholder="Senha" name="senha" id="senha">
                </div>
            </div>

            <div class="row my-3 align-items-center">
                <div class="col-4 text-left">
                    <button class="btn btn-app" type="submit" name="entrar"><i class="fa fa-sign-in ic-left"></i>Entrar</button>
                </div>
                <div class="col-8 text-right lnh">
                    <small class="text-muted">
                        <cite>Ao entrar, você afirma concordar com nossos <a href="#modalTermosUso" data-toggle="modal" data-target="#modalTermosUso"><b>termos e condições</b></a></cite>
                    </small>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalTermosUso">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Termos de Uso e Condição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row my-2">
                    <div class="col-12 text-center">
                        <img src="<? echo URL_BASE; ?>public/img/Logo-fundo-branco.png" class="logoMiniLeft" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2>1. Termos</h2>            <p>Ao acessar ao site <a href='clickbeard.app'>ClickBeard</a>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis ​​e concorda que é responsável pelo cumprimento de todas as leis locais aplicáveis. Se você não concordar com algum                desses termos, está proibido de usar ou acessar este site. Os materiais contidos neste site são protegidos pelas leis de direitos autorais e marcas comerciais aplicáveis.</p>            <h2>2. Uso de Licença</h2>            <p>É concedida permissão para baixar temporariamente uma cópia dos materiais (informações ou software) no site ClickBeard , apenas para visualização transitória pessoal e não comercial. Esta é a concessão de uma licença, não uma transferência de título e,                sob esta licença, você não pode: </p>            <ol>            <li>modificar ou copiar os materiais;  </li>            <li>usar os materiais para qualquer finalidade comercial ou para exibição pública (comercial ou não comercial);  </li>            <li>tentar descompilar ou fazer engenharia reversa de qualquer software contido no site ClickBeard;  </li>            <li>remover quaisquer direitos autorais ou outras notações de propriedade dos materiais; ou  </li>            <li>transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.</li>            </ol>            <p>Esta licença será automaticamente rescindida se você violar alguma dessas restrições e poderá ser rescindida por ClickBeard a qualquer momento. Ao encerrar a visualização desses materiais ou após o término desta licença, você deve apagar todos os materiais                baixados em sua posse, seja em formato eletrónico ou impresso.</p>            <h2>3. Isenção de responsabilidade</h2>            <ol>            <li>Os materiais no site da ClickBeard são fornecidos 'como estão'. ClickBeard não oferece garantias, expressas ou implícitas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limitação, garantias implícitas ou condições de comercialização,            adequação a um fim específico ou não violação de propriedade intelectual ou outra violação de direitos. </li>            <li>Além disso, o ClickBeard não garante ou faz qualquer representação relativa à precisão, aos resultados prováveis ​​ou à confiabilidade do uso dos            materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</li>            </ol>            <h2>4. Limitações</h2>            <p>Em nenhum caso o ClickBeard ou seus fornecedores serão responsáveis ​​por quaisquer danos (incluindo, sem limitação, danos por perda de dados ou lucro ou devido a interrupção dos negócios) decorrentes do uso ou da incapacidade de usar os materiais em ClickBeard,                mesmo que ClickBeard ou um representante autorizado da ClickBeard tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdições não permitem limitações em garantias implícitas, ou limitações de responsabilidade                por danos conseqüentes ou incidentais, essas limitações podem não se aplicar a você.</p>            <h2>5. Precisão dos materiais</h2>            <p>Os materiais exibidos no site da ClickBeard podem incluir erros técnicos, tipográficos ou fotográficos. ClickBeard não garante que qualquer material em seu site seja preciso, completo ou atual. ClickBeard pode fazer alterações nos materiais contidos em seu                site a qualquer momento, sem aviso prévio. No entanto, ClickBeard não se compromete a atualizar os materiais.</p>            <h2>6. Links</h2>            <p>O ClickBeard não analisou todos os sites vinculados ao seu site e não é responsável pelo conteúdo de nenhum site vinculado. A inclusão de qualquer link não implica endosso por ClickBeard do site. O uso de qualquer site vinculado é por conta e risco do usuário.</p>            </p>            <h3>Modificações</h3>            <p>O ClickBeard pode revisar estes termos de serviço do site a qualquer momento, sem aviso prévio. Ao usar este site, você concorda em ficar vinculado à versão atual desses termos de serviço.</p>            <h3>Lei aplicável</h3>            <p>Estes termos e condições são regidos e interpretados de acordo com as leis do ClickBeard e você se submete irrevogavelmente à jurisdição exclusiva dos tribunais naquele estado ou localidade.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>