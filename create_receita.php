<?php

$response = array();
/*if(isset($_POST['Nomerec']) && isset($_POST['Preparo']) && isset($_POST['Sobre']) && isset($_POST['Ingredientes']) && isset($_FILES['Imagem'])){
$nomerec = $_POST['Nomerec'];
$preparo = $_POST['Preparo'];
$sobre = $_POST['Sobre'];
$ingredientes = $_POST['Ingredientes'];
$imageFileType = strtolower(pathinfo(basename($_FILES["Imagem"]["Nomerec"]), PATHINFO_EXTENSION));
$image_base64 = base64_encode(file_get_contents($_FILES['Imagem']['tmp_name']) );
$imagem = 'data:image/'.$imageFileType.';base64,'.$image_base64;
$con = pg_connect(getenv("DATABASE_URL"));
$result = pg_query($con, "INSERT INTO Receita (Nomerec, Sobre, Preparo, Ingredientes) VALUES ('$nomerec','$sobre','$preparo','$ingredientes')");
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
    $response["msg"] = "Campo requerido não preenchido";

    pg_close($con);
    echo json_encode($response);
}*/
?>