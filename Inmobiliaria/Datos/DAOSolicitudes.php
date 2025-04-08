<?php
require_once 'Conexion.php'; 
require_once '../Modelo/solicitudes.php'; 



class DAOSolicitudes{
    private $conexion; 
    
    /**
     * Permite obtener la conexión a la BD
     */
    private function conectar() {
        try {
            global $conn;
            $this->conexion = $conn;
        } catch (Exception $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function agregarSolicitud($nombre, $email, $telefono, $mensaje){
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("INSERT INTO solicitudes_contacto 
    (nombre, email, telefono, mensaje) 
    VALUES (?,?,?,?)");
            $sentenciaSQL->execute(array($nombre, $email, $telefono, $mensaje));

            // Puedes retornar el ID del usuario insertado si lo necesitas
            return $this->conexion->insert_id;
        } catch (PDOException $e) {
            // Manejo de errores
            return false;
        }
    }

}

?>