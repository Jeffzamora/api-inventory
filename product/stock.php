<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el código del producto desde la solicitud
$code = $_POST['code'];

// Consulta para seleccionar el producto con el código especificado
$sql = "SELECT * FROM tb_product WHERE code='$code'";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Si se encontraron resultados, inicializar una variable para almacenar el stock del producto
    $stock = 0;

    // Recorrer cada fila de resultados y obtener el stock del producto
    while ($row = $result->fetch_assoc()) {
        // Convertir el stock a un entero
        $stock = (int)$row['stock'];
    }

    // Devolver una respuesta JSON con éxito true y el stock del producto
    echo json_encode(array(
        "success" => true,
        "data" => $stock,
    ));
} else {
    // Si no se encontraron resultados, devolver una respuesta JSON con éxito false
    echo json_encode(array("success" => false));
}