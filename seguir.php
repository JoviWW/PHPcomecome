<?php 

$response = array();
if(isset($_POST["codseguido"]) && isset($_POST["codseguindo"])){


$codseguido= $_POST['codseguido'];
$codseguindo = $_POST['codseguindo'];
$con = pg_connect(getenv("DATABASE_URL"));
$resultver = pg_query($con, "SELECT * FROM seguidos WHERE(seguido = '$codseguido' and seguindo = '$codseguindo')");

if ( pg_num_rows ($resultver) > 0) {
    $response["success"] = 2;
    $response["msg"] = "Já seguindo.";
    $resulterminar = pg_query($con, "DELETE FROM seguidos WHERE(seguido = '$codseguido' and seguindo = '$codseguindo');");
    pg_close($con);
    echo json_encode($response);
} else {

$result = pg_query($con, "INSERT INTO seguidos(seguido,seguindo) VALUES ('$codseguido','$codseguindo');");
if($result){
    $response["success"] = 1;
    $response["msg"] = "Produto criado com sucesso";

    pg_close($con);
    echo json_encode($response);}
}
}else {
     $response["success"] = 0;
    $response["msg"] = "Parametros não atendidos";
    pg_close($con);
   
    echo json_encode($response);}
?>