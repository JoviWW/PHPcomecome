<?php
$response = array();
if(isset($_POST['nomerec']) && isset($_POST['preparo']) && isset($_POST['sobre']) && isset($_POST['ingrediente']) && isset($_FILES['imagem']) && isset($_POST['codusu'])){
$nomerec = $_POST['nomerec'];
$preparo = $_POST['preparo'];
$sobre = $_POST['sobre'];
$autor = $_POST['codusu'];
$ingredientes = $_POST['ingrediente'];
$imageFileType = strtolower(pathinfo(basename($_FILES["imagem"]["nomerec"]), PATHINFO_EXTENSION));
$image_base64 = base64_encode(file_get_contents($_FILES['imagem']['tmp_name']) );
$imagem = 'data:image/'.$imageFileType.';base64,'.$image_base64;
$con = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($con, "INSERT INTO receita (nomerec, sobre, preparo, ingrediente,imagem,autor) VALUES ('$nomerec','$sobre','$preparo','$ingredientes', '$imagem',$autor);");
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