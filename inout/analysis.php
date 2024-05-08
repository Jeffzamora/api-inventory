<?php
// Incluir archivo de conexión a la base de datos
include "../connection.php";

// Obtener el tipo y la fecha del formulario POST
$type = $_POST['type'];
$today = new DateTime($_POST['today']);

// Obtener la zona horaria local del servidor
$loc = (new DateTime())->getTimezone();

// Convertir la fecha a la zona horaria local del servidor
$today->setTimezone($loc);

// Crear un array con las fechas de la semana actual
$week = array();
for ($i = 0; $i < 7; $i++) {
    $week[] = $today->format('Y-m-d');
    $today->sub(new DateInterval('P1D')); // Restar un día a la fecha actual
}

// Consultar la base de datos
$sql = "SELECT * FROM tb_history
        WHERE type='$type'
        ORDER BY created_at DESC";
$result = $connect->query($sql);

// Verificar si se obtuvieron resultados de la consulta
if ($result->num_rows > 0) {
    $list_total = array(0,0,0,0,0,0,0); // Inicializar un array para almacenar los totales por día
    $history = array(); // Inicializar un array para almacenar los datos de historial
    
    // Iterar sobre los resultados de la consulta
    while ($row = $result->fetch_assoc()) {
        // Obtener la fecha del registro y convertirla a formato Y-m-d
        $date = new DateTime($row['created_at']);
        $the_day = $date->format('Y-m-d');
        
        // Verificar si la fecha del registro está dentro de la semana actual
        if (in_array($the_day, $week)) {
            // Buscar el índice correspondiente al día en el array de la semana
            $index = array_search($the_day, $week);
            
            // Sumar el total del precio al día correspondiente
            $list_total[$index] += floatval($row['total_price']);
        } else {
            // Si la fecha del registro no está dentro de la semana actual, salir del bucle
            break;
        }
        
        // Agregar el registro al array de historial
        $history[] = $row;
    }
    
    // Devolver una respuesta JSON con los datos obtenidos
    echo json_encode(array(
        "success" => true,
        "list_total" => $list_total,
        "data" => $history,
    ));
} else {
    // Si no se obtuvieron resultados de la consulta, devolver un mensaje de error
    echo json_encode(array("success" => false));
}