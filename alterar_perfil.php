<?php
$response = array();
if(isset($_POST['codusu']) && isset($_POST['sobre']) && isset($_POST['nome']) && isset($_FILES['imagem'])){
$nome = $_POST['nome'];
$sobre = $_POST['sobre'];
$codusu = $_POST['codusu'];
$imageFileType = strtolower(pathinfo(basename($_FILES["imagem"]["nomerec"]), PATHINFO_EXTENSION));
$image_base64 = base64_encode(file_get_contents($_FILES['imagem']['tmp_name']) );
$imagem = 'data:image/'.$imageFileType.';base64,'.$image_base64;
$con = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($con, "UPDATE usuario SET (nome = $nome, sobre = $sobre, imagem = $imagem) WHERE(codusu = $codusu);");
if($result){
    $response["success"] = 1;
    $response["msg"] = "Produto criado com sucesso";

    pg_close($con);
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["msg"] = "Produto não criado";

    pg_close($con);
    echo json_encode($response);
}


} else {
     $response["success"] = 0;
    $response["msg"] = "Produto nao criado";

   
    echo json_encode($response);}
?>