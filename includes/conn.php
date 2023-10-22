<?php
// Configuración de la base de datos
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'votingsystem';

// Intentar establecer la conexión a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Verificar si se pudo conectar
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// La conexión se ha establecido con éxito
// Puedes usar $conn para realizar consultas y operaciones en la base de datos.
	/*$conn = new mysqli('localhost', 'root', '', 'votingsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}*/

	
?>


