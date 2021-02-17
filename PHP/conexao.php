<?php
	class conexao_banco{
		//Variaveis para acesso ao banco
		private $host="localhost";
		private $banco="controle-acesso";
		private $usuario="root";
		private $senha="root";
		public $conexao;


		public function conectar(){
			$this->conexao=null;
			try{
				$this->conexao=new PDO("mysql:host=".$this->host.";dbname=".$this->banco,$this->usuario,$this->senha);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);/*
				$this->conexao->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
				$this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);*/
				$this->conexao->exec("SET CHARACTER SET utf8");
			}catch(PDOException $mensagem){
				echo "Erro de conexão: ".$mensagem->POSTMessage();
			}
			return $this->conexao;
		}
		public function fechar_conexao() {
			$this->conexao=null;
		}
	}
?>