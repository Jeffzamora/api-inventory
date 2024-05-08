<?php

// Incluir el archivo de conexión a la base de datos
include "../connection.php";

// Obtener datos del formulario POST
$list_product = $_POST['list_product']; // Lista de productos en formato JSON
$type = $_POST['type']; // Tipo de transacción (IN para entrada, OUT para salida)
$total_price = $_POST['total_price']; // Precio total de la transacción

// Obtener la fecha y hora actual
$date = new DateTime();
$createdAt = $date->format('Y-m-d H:i:sP'); // Fecha y hora de creación del registro
$updatedAt = $createdAt; // Fecha y hora de actualización inicialmente igual a la de creación

// Construir la consulta SQL para insertar un nuevo registro en la tabla de historial
$sql = "INSERT INTO tb_history SET
        list_product='$list_product',
        total_price='$total_price',
        type='$type',
        created_at='$createdAt',
        updated_at='$updatedAt'";

// Ejecutar la consulta SQL
$result = $connect->query($sql);

// Verificar si la consulta se ejecutó con éxito
if($result) { 
    // Decodificar la lista de productos de JSON a un array de objetos
    $products = json_decode($list_product);
    
    // Iterar sobre cada producto en la lista
    foreach ($products as $itemDynamic) {
        // Convertir el objeto dinámico en un array asociativo
        $item = (array)$itemDynamic;
        
        // Obtener el código del producto y su stock actual
        $code = $item['code'];
        $stock = $item['stock'];
        $quantity = $item['quantity'];
        
        // Calcular el nuevo stock según el tipo de transacción
        $new_stock = 0;
        if ($type == 'IN') {
            // Si es una entrada, se suma la cantidad al stock actual
            $new_stock = $stock + $quantity;
        } else {
            // Si es una salida, se resta la cantidad al stock actual
            $new_stock = $stock - $quantity;
        }
        
        // Construir la consulta SQL para actualizar el stock del producto
        $sql_in = "UPDATE tb_product
                    SET
                    stock='$new_stock',
                    updated_at='$updatedAt'
                    WHERE
                    code='$code'";
        
        // Ejecutar la consulta SQL para actualizar el stock del producto
        $connect->query($sql_in);
    }
    // Enviar una respuesta JSON indicando que la operación fue exitosa
    echo json_encode(array("success"=>true));
} else {
    // Enviar una respuesta JSON indicando que la operación falló
    echo json_encode(array("success"=>false));
}