<?php
// Conectar con la base de datos
$conexion = new mysqli("localhost", "root", "", "biblioteca_imagenes");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se ha enviado un término de búsqueda
$nombreBuscar = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Consulta de búsqueda por nombre
if ($nombreBuscar != '') {
    $sql = "SELECT id, nombre, tipo, imagen FROM imagenes WHERE nombre LIKE '%$nombreBuscar%'";
} else {
    $sql = "SELECT id, nombre, tipo, imagen FROM imagenes";
}

$resultado = $conexion->query($sql);
$imagenes = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $imagenBase64 = base64_encode($fila['imagen']);
        $imagenes[] = [
            'id' => $fila['id'],
            'nombre' => $fila['nombre'],
            'tipo' => $fila['tipo'],
            'imagen' => $imagenBase64
        ];
    }
}

echo json_encode($imagenes);
$conexion->close();
?>
