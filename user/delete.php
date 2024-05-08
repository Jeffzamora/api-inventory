<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el ID de usuario desde la solicitud
$id_user = $_POST['id_user'];

// Consulta para eliminar el usuario con el ID especificado
$sql = "DELETE FROM tb_user WHERE id_user='$id_user'";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si la eliminación fue exitosa
if($result) {
    // Si la eliminación fue exitosa, devolver una respuesta JSON con éxito true
    echo json_encode(array("success"=>true));
} else {
    // Si la eliminación falló, devolver una respuesta JSON con éxito false
    echo json_encode(array("success"=>false));
}

