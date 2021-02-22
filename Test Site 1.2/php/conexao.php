<?php
	class conexao_banco{
		//Variaveis para acesso ao banco
		private $host="localhost";
		private $banco="Web-Faj";
		private $usuario="postgres";
		private $senha="ugulino10";
		public $conexao;


		public function conectar(){
			$this->conexao=null;
			try{
				$this->conexao=new PDO("pgsql:host=".$this->host.";dbname=".$this->banco,$this->usuario,$this->senha);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $mensagem){
				echo "Erro de conexão: ".$mensagem->getMessage();
			}
			return $this->conexao;
		}
		public function fechar_conexao() {
			$this->conexao=null;
		}
	}
?>