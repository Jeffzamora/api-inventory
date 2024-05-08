<?php
// Incluir archivo de conexión a la base de datos
include "../connection.php";

// Obtener el tipo desde el formulario POST
$type = $_POST['type'];

// Consultar la base de datos para contar el número de registros que coinciden con el tipo especificado
$sql = "SELECT id_history FROM tb_history WHERE type='$type'";
$result = $connect->query($sql);

// Devolver el número de filas resultantes en formato JSON
echo json_encode(array(
    "data" => $result->num_rows,
));