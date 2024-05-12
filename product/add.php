<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener los datos del formulario
$code = $_POST['code'];
$name = $_POST['name'];
$stock = $_POST['stock'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$lab = $_POST['lab'];
$exp = $_POST['exp'];

// Obtener la fecha y hora actual
$date = new DateTime();
$createdAt = $date->format('Y-m-d H:i:sP');
$updatedAt = $createdAt;

// Consultar si ya existe un producto con el mismo código
$sql_check_code = "SELECT * FROM tb_product WHERE code='$code'";
$result_check_code = $connect->query($sql_check_code);

// Verificar si ya existe un producto con el mismo código
if ($result_check_code->num_rows > 0) {
    // Si ya existe un producto con el mismo código, devolver un mensaje de error
    echo json_encode(array(
        "success" => false,
        "message" => "code",
    ));
} else {
    // Si no existe un producto con el mismo código, insertar el nuevo producto
    $sql = "INSERT INTO tb_product SET
        code='$code',
        name='$name',
        stock='$stock',
        unit='$unit',
        price='$price',
        created_at='$createdAt',
        updated_at='$updatedAt',
        lab = '$lab',
        exp = '$exp'
        ";
    $result = $connect->query($sql);
    
    // Verificar si la inserción fue exitosa
    if($result) {    
        echo json_encode(array("success"=>true));
    } else {
        echo json_encode(array("success"=>false));
    }
}
