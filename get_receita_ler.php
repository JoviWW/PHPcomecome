<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if (isset($_GET["codreceita"]){
$codreceita = $_GET["codreceita"];
$result = pg_query($con, "SELECT * FROM receita WHERE(codreceita = $codreceita);");
    if(!empty($result)){
        if ( pg_num_rows ($result) > 0) {

          $result = pg_fetch_array($result);
          $receita = array();
          $receita["codreceita"] =  $result["codreceita"];
          $receita["nomerec"] =  $result["nomerec"];
          $receita["sobre"] =  $result["sobre"];
          $receita["ingredientes"] =  $result["ingredientes"];
          $receita["preparo"] =  $result["preparo"];
          $receita["data"] =  $result["data"];
          //$receita["Imagem"] = $row["Imagem"];
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

 }    else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de receita nao recebido.";
    echo json_encode($response);


pg_close($con);
?>