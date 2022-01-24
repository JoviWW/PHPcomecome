<?php
$response = array();
$con = pg_connect(getenv("DATABASE_URL"));

if(isset($_GET["codusu"])){
$codusu = $_GET["codusu"];
$result = pg_query($con, "SELECT * FROM usuario WHERE(codusu = $codusu);");
    if(!empty($result)){
        if ( pg_num_rows ($result) > 0) {
        
          $resultnumseg = pg_query($con, "SELECT Count(*) as numseg FROM seguidos where(seguido=$codusu);");
          $resultnumrec = pg_query($con, "SELECT Count(*) as numrec FROM receita where(autor=$codusu);");
          $result = pg_fetch_array($result);
          $resultnumseg  = pg_fetch_array($resultnumseg );
          $$resultnumrec = pg_fetch_array($resultnumrec);
          $usario = array();
          $usario["nome"] =  $result["nome"];
          $usuario["sobre"] =  $result["sobre"];
          $usuario["numseg"] =  $resultnumseg["numseg"];
          $usuario["numrec"] =  $resultnumrec["numrec"];
          $usuario["imagem"] = $result["imagem"];
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