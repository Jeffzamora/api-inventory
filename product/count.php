<?php
// Incluir el archivo de conexión
include "../connection.php";

// Consulta para seleccionar todos los códigos de productos
$sql = "SELECT code FROM tb_product";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, contar el número total de filas (códigos de productos)
    $totalCodes = $result->num_rows;

    // Devolver el número total de códigos de productos en formato JSON
    echo json_encode(array(
        "success" => true,
        "data" => $totalCodes,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false y sin datos
    echo json_encode(array(
        "success" => false,
        "message" => "No se encontraron códigos de productos.",
    ));
}

