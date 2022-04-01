<?php
ini_set('display_startup_errors', TRUE);
ini_set( 'display_errors', TRUE );
ini_set('allow_url_fopen', true);
error_reporting(E_ALL);

function consultar($cep){
$url = "https://viacep.com.br/ws/".$cep."/json/";

$end = file_get_contents($url);

$array = json_decode($end, true);
    //var_dump($response);
    //retornando o conteudo em array
 return isset($array['cep']) ? $array : null;
}

$endereco = consultar(89188000);
print_r($endereco);
echo $endereco['cep'];
?>