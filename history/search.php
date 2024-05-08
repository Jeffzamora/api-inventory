<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener la fecha desde la solicitud POST
$date = $_POST['date'];

// Consulta para seleccionar los registros de historial que coincidan con la fecha proporcionada
$sql = "SELECT * FROM tb_history
        WHERE
        created_at LIKE '%$date%'
        ";

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

    // Devolver una respuesta JSON con éxito true y los datos de historial que coinciden con la fecha
    echo json_encode(array(
        "success" => true,
        "data" => $history
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}