<?php
include_once("interno/conexao_bd.php");

$login     = $_POST["login"];
$senha     = MD5($_POST["senha"]);





   $QueryUsuarios = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
       
        if ($result=mysqli_query($conn, $QueryUsuarios)){
            while($u=mysqli_fetch_object($result))
            {
              $VarID     = $u->id;
              $VarLogin  = $u->login; 
              $VarNome   = $u->nome; 
              $VarNivel  = $u->nivel;
              $VarUnidade  = $u->unidade; 
 
            }

           session_start();
        
               $_SESSION['s_id']    = $VarID;
               $_SESSION['s_login'] = $VarLogin;
               $_SESSION['s_nome']  = $VarNome;
               $_SESSION['s_nivel'] = $VarNivel;
               $_SESSION['s_unidade'] = $VarUnidade;

        
        
        
        ob_start();
        
        setcookie ("c_login", serialize ($_SESSION['s_login']), time() + 31536000, "/");
         ob_end_flush();


          if($VarNivel == "1"){ 
            echo "<script>location ='interno/impressao/inicio.php'; </script>";
          }
          
          if ($VarNivel == "2") {
           echo "<script>location ='interno/professor/'; </script>";
         }

          if ($VarNivel == "5") {
           echo "<script>location ='interno/professor/'; </script>";
         }
         if ($VarNivel == "3") {
           echo "<script>location ='interno/administrador/index.php'; </script>";
        }
        if ($VarNivel == "4") {
           echo "<script>location ='interno/colaborador/index.php'; </script>";
        }
            echo "<script>location ='retorno.php';</script>"; 
          }else{
           // echo "<script>location ='retorno.php';</script>"; 
          }



?>