<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el código del producto desde la solicitud
$code = $_POST['code'];

// Consulta para eliminar el producto con el código especificado
$sql = "DELETE FROM tb_product
        WHERE
        code='$code'
        ";

// Ejecutar la consulta
$result = $connect->query($sql);

// Verificar si la eliminación fue exitosa
if($result) {
    // Si la eliminación fue exitosa, devolver una respuesta JSON con éxito true
    echo json_encode(array("success"=>true));
} else {
    // Si la eliminación falló, devolver una respuesta JSON con éxito false
    echo json_encode(array("success"=>false));    
}


