<?php
$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codusu"]) && isset($_GET["codseguindo"])){
$codusu = $_GET["codusu"];
$codseguindo = $_GET["codseguindo"];
$result = pg_query($con, "SELECT * FROM usuario WHERE(codusu = $codusu);");
    if(!empty($result)){
        if ( pg_num_rows ($result) > 0) {
         // $resultver = pg_query($con, "SELECT Count(*) as seg FROM seguidos WHERE(codseguido = '$codusu' and codseguindo = '$codseguindo')");
          $resultnumseg = pg_query($con, "SELECT Count(*) as numseg FROM seguidos where(seguido=$codusu);");
          $resultnumrec = pg_query($con, "SELECT Count(*) as numrec FROM receita where(autor=$codusu);");
          $result = pg_fetch_array($result);
          $resultnumseg  = pg_fetch_array($resultnumseg );
          //$resultver  = pg_fetch_array($resultver);
          $resultnumrec = pg_fetch_array($resultnumrec);
          $usuario = array();
          $usuario["nome"] =  $result["nome"];
          $usuario["sobre"] =  $result["sobre"];
          $usuario["numseg"] =  $resultnumseg["numseg"];
          $usuario["numrec"] =  $resultnumrec["numrec"];
          $usuario["imagem"] = $result["imagem"];
          //$usuario["seg"] =  $resultver["seg"];
        $response["success"] = 1;
        $response["usuario"] = array();
        array_push($response["usuario"], $usuario);
        echo json_encode($response);
              
        }   else {
            $response["success"] = 0;
            $response["msg"] = "Produto não encontrado.";
            echo json_encode($response);
        }
            } else {
            $response["success"] = 0;
            $response["msg"] = "Produto não encontrado.";
            echo json_encode($response);
        }

    }  else { 
    $response["success"] = 0;
    $response["msg"] = "Codigo de receita nao recebido.";
    echo json_encode($response);
 }

pg_close($con);
?>