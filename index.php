<?php
ini_set('display_startup_errors', TRUE);
ini_set( 'display_errors', TRUE );
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
use \App\Controller\EnderecoController;
use \App\Controller\Control;


if(isset($_POST['cep'])){
  
  $cep=$_POST['cep'];
  //$cep='72302-051';
  $cep=str_replace('-', '', $cep);
  $cep=intval($cep);
 
  
  //proicurar se o CEP já esta cadastrado no sistema
  $existeCEP = EnderecoController::existeCEP($cep);
  if($existeCEP){
    $existe = 'cep existe';
  }
  //Se não estiver no sistema, vai consultar no ViaCEP
  if($existeCEP == false){

    $buscarCEP= EnderecoController::buscarViaCEP($cep);    

    $data = new \App\Controller\Control();
    $salvar = new \App\Controller\EnderecoController();
    $data ->setCep($buscarCEP["cep"]);
    $data ->setLogradouro($buscarCEP["logradouro"]);
    $data ->setBairro($buscarCEP["bairro"]);
    $data ->setLocalidade($buscarCEP["localidade"]);
    $data ->setUf($buscarCEP["uf"]);
    //salvando no banco
    $salvar -> insert($data);
    
    /*
    cep
    logradouro
    bairro
    localidade
    uf
    */
  }

  //selecionar no banco CEPs já cadastrados
  $cepscadastrados = new \App\Controller\EnderecoController();
      $listagem = '';
    foreach($cepscadastrados->selectCEPs() as $n){
     
       $listagem.= '<tr>
                      <td>'.$n['cep'].'</td>
                      <td>'.$n['logradouro'].'</td>
                      <td>'.$n['bairro'].'</td>
                      <td>'.$n['localidade'].'</td>
                      <td>'.$n['uf'].'</td>
                    </tr>';
        //echo "ID ".$n['id']." Nome ".$n['firstname']." Sobrenome ".$n['lastname']."<br>";
    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>
  <body>

    <header>
      <div class="container header">
        <h1 class="display-3">Consulte CEPs</h1>
      </div>
    </header>

    <div class="container content">
      <div class="container mt-5">
        <form action="" class="row align-items-center" id="formulario" method="POST">
          <div>
            <input type="text" pattern= "\d{5}-?\d{3}"  name="cep" id="cep" class="form-control form-control-lg" placeholder="Informe o CEP desejado" maxlength="9" required>
          </div>
          <div class="col-3">
            <button type="submit" id="enviar" class="btn btn-primary btn-lg"><div id="ring" class="lds-dual-ring"></div><span id="searchText" class="text-white">Buscar</span></button>
          </div>
          <div class="col-12">
            <span id="error"></span>
          </div>
        </form>
      <!---->

      <div class="col-6  mt-5" id="card" style="display: none;" >
      </div>
      <div class="col-6  mt-5">        
        <section>

          <table class="table bg-light mt-3 ">
              <thead>
                <tr>
                  <th>CEP</th>
                  <th>LOGRADOURO</th>
                  <th>BAIRRO</th>
                  <th>LOCALIDADE</th>
                  <th>UF</th>

                </tr>
              </thead>
              <tbody>
                  <?=$listagem?>
              </tbody>
          </table>

        </section>
      </div>
      </div>
    </div>

           <footer>
            <div class="social">
              <a class="nav-link"  href="https://github.com/Henriquehcl"  target="_blank">
                <svg height="32" aria-hidden="true" viewBox="0 0 16 16" version="1.1" width="32" data-view-component="true">
                <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
              </a>
              <a class="nav-link" href="https://www.linkedin.com/in/henrique-correa-de-lima-2455b7a6/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" style="color: #0a66c2">
                <g>
                <path d="M34,2.5v29A2.5,2.5,0,0,1,31.5,34H2.5A2.5,2.5,0,0,1,0,31.5V2.5A2.5,2.5,0,0,1,2.5,0h29A2.5,2.5,0,0,1,34,2.5ZM10,13H5V29h5Zm.45-5.5A2.88,2.88,0,0,0,7.59,4.6H7.5a2.9,2.9,0,0,0,0,5.8h0a2.88,2.88,0,0,0,2.95-2.81ZM29,19.28c0-4.81-3.06-6.68-6.1-6.68a5.7,5.7,0,0,0-5.06,2.58H17.7V13H13V29h5V20.49a3.32,3.32,0,0,1,3-3.58h.19c1.59,0,2.77,1,2.77,3.52V29h5Z" fill="currentColor"></path>
                </g>
                </svg>
              </a>
            </div>
        </footer>
      <!--<script src="assets/js/script.js"></script>-->
  </body>
</html>
