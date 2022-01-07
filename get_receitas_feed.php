<?php

$response = array();

$con = pg_connect(getenv("DATABASE_URL"));

$result = pg_query($con, "SELECT * FROM Receita ORDER BY Data desc;");

if ( pg_num_rows ($result) > 0) {

    $response["receitas"] = array();

    while ($row = pg_fetch_array($result)){
        $receita = array();
        $receita["id"] = $row["id"];
        $receita["Nomerec"] = $row["Nomerec"];
        $receita["Sobre"] = $row["Sobre"];
        $receita["Ingredientes"] = $row["Ingredientes"];
        $receita["Preparo"] = $row["Preparo"];
        //$receita["Imagem"] = $row["Imagem"];
        array_push($response["receitas"], $receita);

    }
    
    echo json_encode($response);

} else{
  
    $response["success"] = 0;
    $response["msg"] = "Nao ha produtos";
    echo json_encode($response);
    
}
pg_close($con);

?>