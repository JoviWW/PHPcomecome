<?php

$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codusu"])){
$codusu = $_GET["codusu"];
$result = pg_query($con, "SELECT * from usuario usu join favorito fav on (fav.codusu = usu.codusu) join receita rec on (fav.codreceita = rec.codreceita) where usu.codusu = $codusu; ");
if ( pg_num_rows ($result) > 0) {
    $response["success"] = 1;
    $response["receitas"] = array();

    while ($row = pg_fetch_array($result)){
        $receita = array();
        $receita["codreceita"] = $row["codreceita"];
        $receita["nomerec"] = $row["nomerec"];
        $receita["sobre"] = $row["sobre"];
        //$receita["Imagem"] = $row["Imagem"];
        array_push($response["receitas"], $receita);

    }
    
    echo json_encode($response);

} else{
  
    $response["success"] = 0;
    $response["msg"] = "Nao ha receitas favoritadas";
    echo json_encode($response);
    
}
} else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de usuario nao recebido.";
    echo json_encode($response);
 }
pg_close($con);
?>