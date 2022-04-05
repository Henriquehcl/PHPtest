<?php 

namespace App\Controller;

use App\DataBase\Conect;
use App\DataBase\Control;
use App\WebServer\ViaCEP;
class EnderecoController{


	//verificar se o CEP existe no banco de dados
	public static function existeCEP($cep){
		$cep = substr_replace($cep, '-', -3, 0);
		//print($cep);exit();
		$sql = "SELECT * FROM endereco WHERE cep = '$cep'";
		$stmt = Conect::prepare($sql);
	    //$stmt->bindValue(1, $n->getCep());
	    $stmt->execute();

	    if($stmt->rowCount() > 0) {
	        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

	        return $resultado;
	    } else {

	        return false;

	    }

	}

	//listar CEPs existentes
	public function selectCEPs() {

    $sql = "SELECT * FROM endereco";

    $stmt = Conect::prepare($sql);
    $stmt->execute();

   if($stmt->rowCount() > 0) {
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $resultado;
    } else {
        return [];
    }
    //return $stmt->fetchAll();

	}

	public static function buscarViaCEP($cep){
/*
			$url = "https://viacep.com.br/ws/".$cep."/json/";

			$end = file_get_contents($url);

			$array = json_decode($end, true);
    
 			return isset($array['cep']) ? $array : null;
*/
			
			//echo $cep;
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

	    

	    //convertendo JSON para ARRAY
	    $array = json_decode($response, true);
	    
	    //retornando o conteudo em array
	    return isset($array['cep']) ? $array : null;

	}

	public function insert($data){

    $sql  = "INSERT INTO endereco (cep,logradouro, bairro, localidade, uf) VALUES (?,?,?,?,?)";
    $stmt = Conect::prepare($sql);

    //$stmt->bindValue(':nome', $this->nome, \PDO::PARAM_STR);
    $stmt->bindValue(1, $data->getCep());
    $stmt->bindValue(2, $data->getLogradouro());
    $stmt->bindValue(3, $data->getBairro());
    $stmt->bindValue(4, $data->getLocalidade());
    $stmt->bindValue(5, $data->getUf());

    $stmt->execute();
    
    return ;

/*
    $sql = 'INSERT INTO Names (firstname,lastname) VALUES (?,?)' ;

    $stmt = Conect::prepare($sql);
    $stmt->bindValue(1, $nome->getFirstName());
    $stmt->bindValue(2, $nome->getLastName());

    $stmt->execute();
    */
}

}

?>