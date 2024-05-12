<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener los datos del formulario
$old_code = $_POST['old_code'];
$code = $_POST['code']; // Nuevo código
$name = $_POST['name'];
$stock = $_POST['stock'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$lab = $_POST['lab'];
$exp = $_POST['exp'];

// Obtener la fecha y hora actual
$date = new DateTime();
$updatedAt = $date->format('Y-m-d H:i:sP');

// Consultar si ya existe otro producto con el nuevo código, excluyendo el producto actual
$sql_check_code = "SELECT * FROM tb_product WHERE code='$code' AND NOT code='$old_code'";
$result_check_code = $connect->query($sql_check_code);

// Verificar si ya existe otro producto con el nuevo código
if ($result_check_code->num_rows > 0) {
    // Si ya existe otro producto con el nuevo código, devolver un mensaje de error
    echo json_encode(array(
        "success" => false,
        "message" => "El nuevo código ya está en uso.",
    ));
} else {
    // Si no existe otro producto con el nuevo código, actualizar los datos del producto actual
    $sql = "UPDATE tb_product SET
        code='$code',
        name='$name',
        stock='$stock',
        unit='$unit',
        price='$price',
        updated_at='$updatedAt'
        lab = '$lab',
        exp = '$exp'
        WHERE
        code='$old_code'
        ";
    $result = $connect->query($sql);
    
    // Verificar si la actualización fue exitosa
    if($result) {    
        echo json_encode(array("success"=>true));
    } else {
        echo json_encode(array("success"=>false));
    }
}