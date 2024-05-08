<?php
// Incluir el archivo de conexión
include "../connection.php";

// Obtener el ID de historial desde la solicitud POST
$id_history = $_POST['id_history'];

// Consulta para eliminar la fila de la tabla "tb_history" con el ID de historial especificado
$sql = "DELETE FROM tb_history
        WHERE
        id_history='$id_history'
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