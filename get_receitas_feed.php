<?php

$response = array();

$con = pg_connect(getenv("DATABASE_URL"));

$result = pg_query($con, "SELECT * FROM Receita ORDER BY Data desc;");

if(pg_num_rows($result)>0) {
    $response["receitas"] = array();
    while ($row = pg_fetch_query($result)){
        $receita = array();
        $receita["id"] = $row["id"];
        $receita["Nomerec"] = $row["Nomerec"];
        $receita["Sobre"] = $row["Sobre"];
        $receita["Ingredientes"] = $row["Ingredientes"];
        $receita["Preparo"] = $row["Preparo"];
        //$receita["Imagem"] = $row["Imagem"];
        array_push($response["receitas"], $receita);

    }
    pg_close($con);
    echo json_encode($response);

} else{
    pg_close($con);
    $response["success"] = 0;
    $response["msg"] = "Nao ha produtos";
    echo json_encode($response);

}
?>