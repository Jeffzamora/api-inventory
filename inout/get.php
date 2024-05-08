<?php
// Incluir archivo de conexión a la base de datos
include "../connection.php";

// Definir la cantidad de resultados por página
$count = 10;

// Obtener el número de página y el tipo desde la solicitud POST
$page = $_POST['page'];
$type = $_POST['type'];

// Calcular el índice de inicio para la consulta según el número de página
$start = ($page - 1) * $count;

// Construir la consulta SQL para seleccionar los datos paginados
$sql = "SELECT id_history, created_at, total_price, type FROM tb_history
        WHERE type='$type'
        ORDER BY created_at DESC
        LIMIT $start, $count";

// Ejecutar la consulta SQL
$result = $connect->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar los datos de historial
    $history = array();

    // Iterar sobre los resultados y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }

    // Devolver los resultados en formato JSON como respuesta exitosa
    echo json_encode(array(
        "success" => true,
        "data" => $history,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON indicando el fracaso
    echo json_encode(array("success" => false));
}