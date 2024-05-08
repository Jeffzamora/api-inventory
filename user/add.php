<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']); // Se aplica hash a la contraseña para mayor seguridad

// Obtener la fecha y hora actual
$date = new DateTime();
$createdAt = $date->format('Y-m-d H:i:sP');
$updatedAt = $createdAt;

// Consulta para verificar si el correo electrónico ya está registrado
$sql_check_email = "SELECT * FROM tb_user WHERE email='$email'";
$resultCheckEmail = $connect->query($sql_check_email);

// Verificar si se encontraron resultados (si el correo electrónico ya está en uso)
if ($resultCheckEmail->num_rows > 0) {
    echo json_encode(array(
        "success" => false,
        "message" => "email",
    ));
} else {
    // Si el correo electrónico no está registrado, se procede con la inserción del nuevo usuario
    $sql = "INSERT INTO tb_user
            SET
            name='$name',
            email='$email',
            password='$password',
            level='Employee',
            created_at='$createdAt',
            updated_at='$updatedAt'
            ";
    // Ejecutar la consulta
    $result = $connect->query($sql);

    // Verificar si la inserción fue exitosa
    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
}

