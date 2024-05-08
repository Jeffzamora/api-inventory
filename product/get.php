<?php
// Incluir el archivo de conexión
include "../connection.php";

// Consulta para seleccionar todos los productos
$sql = "SELECT * FROM tb_product";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, inicializar un array para almacenar los productos
    $products = array();

    // Recorrer cada fila de resultados y almacenarla en el array de productos
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Devolver una respuesta JSON con éxito true y los datos de los productos
    echo json_encode(array(
        "success" => true,
        "data" => $products,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}

