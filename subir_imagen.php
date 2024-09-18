<?php
// Conectar con la base de datos
$conexion = new mysqli("localhost", "root", "", "biblioteca_imagenes");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se han enviado múltiples imágenes
if (isset($_FILES['imagenes'])) {
    $imagenes = $_FILES['imagenes'];

    for ($i = 0; $i < count($imagenes['name']); $i++) {
        $nombreImagen = $imagenes['name'][$i];
        $tipoImagen = $imagenes['type'][$i];
        $tamanioImagen = $imagenes['size'][$i];
        $imagenTemp = $imagenes['tmp_name'][$i];

        // Comprobar que el archivo es una imagen PNG, JPEG, WebP o ICO
        if (($tipoImagen == "image/png" || $tipoImagen == "image/jpeg" || $tipoImagen == "image/webp" || $tipoImagen == "image/x-icon") && $tamanioImagen <= 5000000) { // 5MB máximo
            $imagen = addslashes(file_get_contents($imagenTemp)); // Convertir imagen a binario

            $sql = "INSERT INTO imagenes (nombre, tipo, tamanio, imagen) VALUES ('$nombreImagen', '$tipoImagen', '$tamanioImagen', '$imagen')";

            if (!$conexion->query($sql)) {
                echo "Error al subir imagen: " . $conexion->error;
            }
        } else {
            echo "Solo se permiten imágenes PNG, JPEG, WebP o ICO de máximo 5MB";
        }
    }
    echo "Imágenes subidas correctamente";
}

$conexion->close();
?>
