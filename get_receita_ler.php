<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codreceita"]) && isset($_GET["codusu"])){
$codreceita = $_GET["codreceita"];
$codusu = $_GET["codusu"];
$result = pg_query($con, "SELECT * FROM receita WHERE(codreceita = $codreceita);");
    if(!empty($result)){
        if ( pg_num_rows ($result) > 0) {
            $resultver = pg_query($con, "SELECT * FROM favorito WHERE(codusu = '$codusu' and codreceita = '$codreceita')");

            if ( pg_num_rows ($resultver) > 0) {$receita["favorito"] = true;} else { $receita["favorito"] = false;}
          $result = pg_fetch_array($result);
          $receita = array();
          $receita["nomerec"] =  $result["nomerec"];
          $receita["sobre"] =  $result["sobre"];
          $receita["ingrediente"] =  $result["ingrediente"];
          $receita["preparo"] =  $result["preparo"];
          $receita["imagem"] = $result["imagem"];
        $response["success"] = 1;
        $response["receita"] = array();
        array_push($response["receita"], $receita);
        echo json_encode($response);
              
        }   else {
            $response["success"] = 0;
            $response["msg"] = "Produto não encontrado.";
            echo json_encode($response);
        }
            } else {
            $response["success"] = 0;
            $response["msg"] = "Produto não encontrado.";
            echo json_encode($response);
        }

    }  else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de receita nao recebido.";
    echo json_encode($response);
 }

pg_close($con);
?>