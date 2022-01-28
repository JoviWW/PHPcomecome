<?php 

$response = array();
if(isset($_POST["codusu"]) && isset($_POST["codreceita"])){


$codusu = $_POST['codusu'];
$codreceita = $_POST['codreceita'];
$con = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($con, "INSERT INTO favorito(codreceita,codusu) VALUES ('$codreceita','$codusu');");
if($result){
    $response["success"] = 1;
    $response["msg"] = "Produto criado com sucesso";

    pg_close($con);
    echo json_encode($response);
} else {
    $response["success"] = 2;
    $response["msg"] = "Favorito já existente.";
    $resulterminar = pg_query($con, "DELETE FROM favorito WHERE(codusu = '$codusu' and codreceita = '$codreceita');");
    pg_close($con);
    echo json_encode($response);
}


} else {
     $response["success"] = 0;
    $response["msg"] = "Parametros não atendidos";

   
    echo json_encode($response);}
?>