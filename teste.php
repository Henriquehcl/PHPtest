<?php
ini_set('display_startup_errors', TRUE);
ini_set( 'display_errors', TRUE );
ini_set('allow_url_fopen', true);
error_reporting(E_ALL);
//phpinfo();
//exit();
function cep($cep){
    $cep = 89188000;
    $curl = curl_init();
    //print_r($curl);
    //configurações do CURL
    curl_setopt_array($curl,[
      //CURLOPT_URL => 'https://viacep.com.br/ws/'.$cep.'/json/',
      CURLOPT_URL => 'http://localhost/ConsultaCEP/api.php',
      CURLOPT_RETURNTRANSFER => true, //retorna o conteudo da request
      CURLOPT_CUSTOMREQUEST => 'GET'
    ]);

    //Response. executando a requisição do CURL
    $response = curl_exec($curl);

    


    //fechando a conexão
    curl_close($curl);

    //convertendo JSON para ARRAY
    //$array = json_decode($response, true);
    //var_dump($response);
    //retornando o conteudo em array
    return isset($array['cep']) ? $array : null;
   
}

$endereco = (cep(89188000));
//$n=$endereco['cep']->cep;
echo $endereco; // não exibe nada no navegador
print_r($endereco);// não exibe nada no navegador
var_dump($endereco);// Returna NLL

 
?>

