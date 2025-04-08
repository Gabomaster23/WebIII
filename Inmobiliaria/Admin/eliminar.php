<?php
require_once('../Datos/DAOPropiedades.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Obtén el ID de la propiedad a eliminar
    $id = $_GET['id'];

    $propiedadDAO = new DAOPropiedades();

    // Elimina el usuario de la base de datos
    if ($propiedadDAO->eliminarPropiedad($id)) {
        header("Location: propiedades.php");
    } else {
        echo "Error al eliminar el usuario.";
    }
}
?>

