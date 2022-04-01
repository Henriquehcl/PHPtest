<?php


ini_set('display_startup_errors', TRUE);
ini_set( 'display_errors', TRUE );
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
use \App\Controller\EnderecoController;
use \App\Controller\Control;


//if(isset($_POST['cep'])){
  
  //$cep=$_POST['cep'];
  $cep='01001-000';
  $cep=str_replace('-', '', $cep);
  $cep=intval($cep);
  $cep=01001000;
  
  //proicurar se o CEP já esta cadastrado no sistema
  $existeCEP = EnderecoController::existeCEP($cep);
  
  //Se não estiver no sistema, vai consultar no ViaCEP
  if($existeCEP == false){

    $buscarCEP= EnderecoController::buscarViaCEP($cep);
    //$buscarCEP=json_encode($buscarCEP);    
    //print(gettype($buscarCEP));
    var_dump($buscarCEP);
    print_r($buscarCEP);exit();
    
    $data = new \App\Controller\Control();
    $salvar = new \App\Controller\EnderecoController();
    $data ->setCep($buscarCEP[0]);
    $data ->setLogradouro($buscarCEP[1]);
    $data ->setBairro($buscarCEP[2]);
    $data ->setLocalidade($buscarCEP[3]);
    $data ->setUf($buscarCEP[4]);
    //var_dump($data);exit();
    
    $salvar -> insert($data);
    
    /*
    cep
    logradouro
    bairro
    localidade
    uf
    */
}

//}



 ?>