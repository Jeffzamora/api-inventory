<?php
// Incluir archivo de conexión a la base de datos
include "../connection.php";

// Obtener el tipo y la fecha desde la solicitud POST
$type = $_POST['type'];
$date = $_POST['date'];

// Construir la consulta SQL para seleccionar registros que coincidan con el tipo y contengan la fecha proporcionada
$sql = "SELECT * FROM tb_history
        WHERE
        type='$type' AND created_at LIKE '%$date%'
        ";

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
        "data" => $history
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON indicando el fracaso.
    echo json_encode(array("success" => false));
}