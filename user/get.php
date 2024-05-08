<?php
// Incluir el archivo de conexión
include "../connection.php";

// Consulta para seleccionar todos los usuarios con nivel 'Employee'
$sql = "SELECT * FROM tb_user WHERE level='Employee'";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar los usuarios
    $users = array();

    // Recorrer cada fila de resultados y almacenarla en el array de usuarios
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    // Devolver una respuesta JSON con éxito true y los datos de los usuarios
    echo json_encode(array(
        "success" => true,
        "data" => $users,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}

