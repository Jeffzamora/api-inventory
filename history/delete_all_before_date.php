<?php
// Incluir el archivo de conexión
include "../connection.php";

// Consultar el número total de filas en la tabla "tb_history"
$sql = "SELECT id_history FROM tb_history";
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, contar el número total de filas
    $totalRows = $result->num_rows;

    // Devolver el número total de filas en formato JSON
    echo json_encode(array(
        "success" => true,
        "data" => $totalRows,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON indicando éxito false y sin datos
    echo json_encode(array(
        "success" => false,
        "message" => "No se encontraron filas en la tabla tb_history.",
    ));
}