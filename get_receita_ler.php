<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if (isset($_GET["codreceita"])){
$codreceita = $_GET["codreceita"];
$result = pg_query($con, "SELECT * FROM receita WHERE(codreceita = 1);");
    if(!empty($result)){
        if ( pg_num_rows ($result) > 0) {

          $row = pg_fetch_array($result)
          $receita = array();
          $receita["codreceita"] = $row["codreceita"];
          $receita["nomerec"] = $row["nomerec"];
          $receita["sobre"] = $row["sobre"];
          $receita["ingredientes"] = $row["ingredientes"];
          $receita["preparo"] = $row["preparo"];
          $receita["data"] = $row["data"];
          //$receita["Imagem"] = $row["Imagem"];
        $response["success"] = 1;
        $response["receita"] = array();
        array_push($response["receita"], $receita);

        echo json_encode($response);
              
        } else {
            $response["success"] = 0;
            $response["msg"] = "Produto não encontrado."
            echo json_encode($response);
        }

}  else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de receita nao recebido."
    echo json_encode($response);
}
pg_close($con);
?>