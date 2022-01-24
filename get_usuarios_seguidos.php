<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codusu"])){
$codusu = $_GET["codusu"];
$result = pg_query($con, "SELECT ususeg.* from usuario usu join seguidos seg on (seg.seguindo = usu.codusu) join usuario ususeg on (seg.seguido = ususeg.codusu) where usu.codusu = $codusu;");
if ( pg_num_rows ($result) > 0) {
    $response["success"] = 1;
    $response["receitas"] = array();

    while ($row = pg_fetch_array($result)){
        $usuario = array();
        $usuario["nome"] = $row["nome"];
        $usuario["codusu"] = $row["codusu"];
        $usuario["sobreusu"] = $row["sobreusu"];
        $usuario["imagem"] = $row["imagem"];
        array_push($response["usuario"], $receita);

    }
    
    echo json_encode($response);

} else{
  
    $response["success"] = 0;
    $response["msg"] = "Nenhum usuário é seguido.";
    echo json_encode($response);
    
}
}
else{
  
    $response["success"] = 0;
    $response["msg"] = "Nenhum usuário está logado.";
    echo json_encode($response);
}
pg_close($con);
?>