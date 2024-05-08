<?php
// Incluir el archivo de conexión
include "../connection.php";

// Consulta para seleccionar todos los usuarios con nivel 'Employee'
$sql = "SELECT id_user FROM tb_user WHERE level='Employee'";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, contar el número total de filas (usuarios)
    $totalUsers = $result->num_rows;

    // Devolver el número total de usuarios en formato JSON
    echo json_encode(array(
        "success" => true,
        "data" => $totalUsers,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false y sin datos
    echo json_encode(array(
        "success" => false,
        "message" => "No se encontraron usuarios con nivel 'Employee'.",
    ));
}
?>
