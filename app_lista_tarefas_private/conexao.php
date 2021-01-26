<?php
    class Conexao{

        private $host = 'localhost';
        private $dbname = 'php_com_pdo';
        private $user = 'root';
        private $senha = '';

        public function conectar(){
            try{

                $conexao = new PDO(
                    //Aqui vamos chamar dentro do construtor da classe os atributos nativos da classe PDO nativa do PHP
                    "mysql:host = $this->host; dbname=$this->dbname",
                    "$this->user",
                    "$this->senha"
                );

                return $conexao;

            }catch (PDOException $e){
                echo '<p>'.$e->getMessage(). '</p>';
            }   
        }
    }
?>