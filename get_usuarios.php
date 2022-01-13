<?php

$response = array();

$con = pg_connect(getenv("DATABASE_URL"));

$result = pg_query($con, "SELECT * FROM usuario;");

if ( pg_num_rows ($result) > 0) {
    $response["success"] = 1;
    $response["usuarios"] = array();

    while ($row = pg_fetch_array($result)){
        $receita = array();
        $receita["nome"] = $row["nome"];
        $receita["sobreusu"] = $row["sobreusu"];
        //$receita["Imagem"] = $row["Imagem"];
        array_push($response["usuarios"], $receita);

    }
    
    echo json_encode($response);

} else{
  
    $response["success"] = 0;
    $response["msg"] = "Nao ha usuarios";
    echo json_encode($response);
    
}
pg_close($con);

?>