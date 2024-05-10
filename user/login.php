<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el correo electrónico y la contraseña del formulario
$email = $_POST['email'];
$password = md5($_POST['password']); // Se aplica hash a la contraseña para mayor seguridad

// Consulta para seleccionar al usuario con el correo electrónico y la contraseña especificados
$sql = "SELECT * FROM tb_user
        WHERE
        email='$email' AND password='$password'";
// Ejecutar la consulta
$result = $connect->query($sql);
// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, inicializar un array para almacenar al usuario
    $user = array();
    // Recorrer cada fila de resultados y almacenarla en el array de usuario
    while ($row = $result->fetch_assoc()) {
        $user[] = $row;
    }
    // Devolver una respuesta JSON con éxito true y los datos del usuario
    echo json_encode(array(
        "success" => true,
        "data" => $user[0], // Seleccionar el primer usuario del array (solo se espera un resultado)
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array(
        "success" => false
    ));
}


