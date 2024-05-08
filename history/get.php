<?php
// Incluir el archivo de conexión
include "../connection.php";

// Número de registros a mostrar por página
$count = 10;

// Obtener el número de página desde la solicitud POST
$page = $_POST['page'];

// Calcular el inicio de la selección en función de la página actual
$start = ($page - 1) * $count;

// Consulta para seleccionar los registros de historial con paginación
$sql = "SELECT id_history, created_at, total_price, type FROM tb_history
        ORDER BY created_at DESC
        LIMIT $start, $count";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, inicializar un array para almacenar los datos
    $history = array();

    // Recorrer cada fila de resultados y almacenarla en el array de historial
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }

    // Devolver una respuesta JSON con éxito true y los datos de historial paginados
    echo json_encode(array(
        "success" => true,
        "data" => $history,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}