<?php

// Función para obtener la configuración de conexión según el entorno
function get_db_config() {
    $config = array();
    
    // Configuración para entorno local
    $config['local'] = array(
        'server' => "localhost",
        'user' => "root",
        'password' => "",
        'database' => "db_inventory"
    );
    
    // Configuración para entorno de producción
    $config['production'] = array(
        'server' => "devzamora.com",
        'user' => "JZ008US00002",
        'password' => "Zamora97.",
        'database' => "db_inventory"
    );
    
    // Obtener el nombre del host
    $host = $_SERVER['HTTP_HOST'];
    
    // Determinar el entorno según el host
    if ($host == 'localhost' || $host == '127.0.0.1') {
        return $config['local']; // Entorno local
    } else {
        return $config['production']; // Entorno de producción
    }
}

// Obtener la configuración de conexión
$db_config = get_db_config();

// Detalles de la base de datos
$server = $db_config['server']; // Dirección del servidor de la base de datos
$user = $db_config['user']; // Nombre de usuario de la base de datos
$password = $db_config['password']; // Contraseña de la base de datos
$database = $db_config['database']; // Nombre de la base de datos

// Intentar establecer una conexión a la base de datos
$connect = new mysqli($server, $user, $password, $database);

// Verificar si la conexión fue exitosa
if ($connect->connect_error) {
    // Si la conexión falla, imprimir un mensaje de error y terminar el script
    die("Error de conexión: " . $connect->connect_error);
} else {
    // Si la conexión es exitosa, imprimir un mensaje de confirmación
    echo "Conexión exitosa";
}