<?php

    class Usuario
    {

        private $dbname = "projeto_login";
        private $host = "127.0.0.1";
        private $user = "root";
        private $passwd = ""; 
        private $pdo;

        public function __construct()
        {
            try
            {
                $this->pdo = new PDO("mysql:dbname=".$this->dbname.";host=".$this->host,
                                    $this->user ,$this->passwd);
            }
            catch (PDOException $pdoex) 
            {
                echo "Erro com o banco de dados: " . $pdoex->getMessage();
                exit();
            }
            catch(Exception $ex)
            {
                echo "Erro genérico: " . $ex->getMessage();
                exit();
            }
        }

        public function cadastrar($nome, $telefone, $email, $senha)
        {
            //verifica se ja existe o email cadastrado
            $cmd = $this->pdo->prepare(" SELECT id_usuario FROM usuarios WHERE email = :email ");
            $cmd->bindValue(":email", $email);
            $cmd->execute();
            if($cmd->rowCount() > 0) //email ja cadastrado
            {
                return false;
            }
            else //caso nao, Cadastrar
            {
                $cmd = $this->pdo->prepare(" INSERT INTO usuarios (nome, telefone, email, senha) 
                VALUES (:nome, :telefone, :email, :senha) ");
                $cmd->bindValue(":nome", $nome);
                $cmd->bindValue(":telefone", $telefone);
                $cmd->bindValue(":email", $email);
                $cmd->bindValue(":senha", md5($senha));
                $cmd->execute();
                return true;
            }
        }

        public function logar($email, $senha)
        {
            $dado = array();
            //verificar se email e senha ja estao cadastrados
            $cmd = $this->pdo->prepare(" SELECT id_usuario FROM usuarios WHERE email = :email AND senha = :senha ");
            $cmd->bindValue(":email", $email);
            $cmd->bindValue(":senha", md5($senha));
            $cmd->execute();
            if($cmd->rowCount() > 0) //entrar no sistema(sessao)
            {
                $dado = $cmd->fetch(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                return true; //logado com sucesso
            }
            else
            {
                return false; //nao foi possivel logar
            }
        }
    }
?>