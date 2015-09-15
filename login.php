<?php
require("config.inc.php");

if (!empty($_POST)) {
    //obtenemos los usuarios respecto al usuario que llega por parámetro
    $query = " 
            SELECT
                username, 
                password,
                tipo
            FROM usuarios 
            WHERE 
                username = :username 
        ";
    
    $query_params = array(
        ':username' => $_POST['username']
    );
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        
        $response["success"] = 0;
        $response["message"] = "Problema con la base de datos, vuelve a intentarlo";
        die(json_encode($response));
        
    }
    
    //la variable a continuación nos permitirará determinar 
    //si es o no la información correcta
    //la inicializamos en "false"
    $validated_info = false;
    
    //vamos a buscar a todas las filas
    $row = $stmt->fetch();
    if ($row) {
        //en caso que no lo este, solo comparamos como acontinuación
        if (md5($_POST['password']) === $row['password']) {
            $login_ok = true;
        }

        /*if ($row['tipo'] == 'admin') {
            $tipo = true;
        }*/
    }

    if ($login_ok) {
        /*if ($tipo) {
            $response["success"] = 2;
            $response["message"] = "Login correcto admin!";
            die(json_encode($response));
        }
        else {*/
            $response["success"] = 1;
            $response["message"] = "Login correcto!";
            die(json_encode($response));
        //}
    } else {
        $response["success"] = 0;
        $response["message"] = "Login INCORRECTO";
        die(json_encode($response));
    }
} else {
    header('Location: index.html');
}

?>