<?php
// Conectar con la base de datos
$conexion = new mysqli("localhost", "root", "", "biblioteca_imagenes");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se ha enviado un id para eliminar
if (isset($_POST['id'])) {
    $idImagen = $_POST['id'];

    // Eliminar la imagen de la base de datos
    $sql = "DELETE FROM imagenes WHERE id = $idImagen";

    if ($conexion->query($sql) === TRUE) {
        echo "Imagen eliminada correctamente";
    } else {
        echo "Error al eliminar imagen: " . $conexion->error;
    }
}

$conexion->close();
?>
