<?php

namespace App\WebServer;

class ViaCEP{

	public static function consultarCEP($cep){

		//iniciando o CURL
    	$curl = curl_init();

    	//configurações do CURL
    	curl_setopt_array($curl,[
        CURLOPT_URL => 'https://viacep.com.br/ws/'.$cep.'/json/',
        CURLOPT_RETURNTRANSFER => true, //retorna o conteudo da request
        CURLOPT_CUSTOMREQUEST => 'GET'
    	]);

    	//Response. executando a requisição do CURL
    	$response = curl_exec($curl);

    	//fechando a conexão
    	curl_close($curl);

    	//$data = simplexml_load_string($response);
		$data = json_decode($response, true);

		//$data = json_encode($data, false);
			//print $data;
    	//return print("Esse é o viacep");
    	print_r($cep);
    	var_dump($data);exit();
		return isset($data->erro) ? false : (array) $data ;
	    //return isset($data) ? $data : null;


	}
}

?>
