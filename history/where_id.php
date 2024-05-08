<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el ID de historial desde la solicitud POST
$id_history = $_POST['id_history'];

// Consulta para seleccionar el registro de historial con el ID especificado
$sql = "SELECT * FROM tb_history WHERE id_history='$id_history'";

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

    // Devolver una respuesta JSON con éxito true y los datos del historial
    echo json_encode(array(
        "success" => true,
        "data" => $history[0],
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}