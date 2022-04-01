<?php

namespace App\Controller;

class Control{

	private $id;
    private $cep;
    private $logradouro;
    private $bairro;
    private $localidade;
    private $uf;

    public function getId(){
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getCep(){
        return $this->cep;
    }
    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getLogradouro(){
        return $this->logradouro;
    }
    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function getBairro(){
        return $this->bairro;
    }
    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getLocalidade(){
        return $this->localidade;
    }

    public function setLocalidade($localidade) {
        $this->localidade = $localidade;
    }

    public function getUf(){
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }    
}

?>