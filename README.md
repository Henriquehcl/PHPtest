# Sistema para fazer busca no Via CEP.
### Priemiro Verifica se o CEP esta no banco de dados MySQL, se estiver exibe as informações
### caso não esteja, busca no Via CEP e salva no banco de dados

## rode o comando para instalar as dependencias 
```
composer install
```

## Tabela do banco de dados

```
CREATE TABLE `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(9),
  `logradouro` varchar(255),
  `bairro` varchar(255),
  `localidade` varchar(255),
  `uf` varchar(2),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cep` (`cep`)
) ENGINE=InnoDB;
```

### tive um problema para rodar parte do script em função de permissão do meu linux
### Esse link pode te ajudar, caso tenha o mesmo problema
### https://stackoverflow.com/questions/48845039/fixing-error-with-file-get-contents-permission-denied
