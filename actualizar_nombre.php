<?php
// Conectar con la base de datos
$conexion = new mysqli("localhost", "root", "", "biblioteca_imagenes");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['id']) && isset($_POST['nombre'])) {
    $idImagen = $_POST['id'];
    $nuevoNombre = $conexion->real_escape_string($_POST['nombre']);

    $sql = "UPDATE imagenes SET nombre = '$nuevoNombre' WHERE id = $idImagen";

    if ($conexion->query($sql) === TRUE) {
        echo "Nombre actualizado correctamente";
    } else {
        echo "Error al actualizar el nombre: " . $conexion->error;
    }
}

$conexion->close();
?>
