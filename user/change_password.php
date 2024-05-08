<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el ID de usuario y la nueva contraseña del formulario
$idUser = $_POST['id_user'];
$password = md5($_POST['password']); // Aplicar hash a la contraseña para mayor seguridad

// Obtener la fecha y hora actual
$date = new DateTime();
$updatedAt = $date->format('Y-m-d H:i:sP');

// Consulta para actualizar la contraseña del usuario
$sql = "UPDATE tb_user SET 
        password='$password',
        updated_at='$updatedAt'
        WHERE
        id_user='$idUser'
        ";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si la actualización fue exitosa
if ($result) {    
    // Si la actualización fue exitosa, devolver una respuesta JSON con éxito true
    echo json_encode(array(
        "success" => true
    ));
} else {
    // Si la actualización falló, devolver una respuesta JSON con éxito false
    echo json_encode(array(
        "success" => false
    ));
}

