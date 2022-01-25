<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codusu"])){
$codusu = $_GET["codusu"];
$result = pg_query($con, "SELECT * FROM receita where codusu = $codusu;");
if ( pg_num_rows ($result) > 0) {
    $response["success"] = 1;
    $response["receitas"] = array();

   /* while ($row = pg_fetch_array($result)){
        $receita = array();
        $receita["codreceita"] = $row["codreceita"];
        $receita["nomerec"] = $row["nomerec"];
        $receita["imagem"] = $row["imagem"];
        array_push($response["receitas"], $receita);

    }*/
    
    echo json_encode($response);

} else{
  
    $response["success"] = 0;
    $response["msg"] = "Nao ha receitas do usuario.";
    echo json_encode($response);
    
}
} else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de usuario nao recebido.";
    echo json_encode($response);
 }


pg_close($con);
?>