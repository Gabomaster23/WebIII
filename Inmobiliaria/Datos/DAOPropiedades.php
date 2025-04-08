<?php
require_once 'conexion.php'; 
require_once '../Modelo/propiedad.php'; 



class DAOPropiedades{
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
    public function agregarPropiedad($titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho,$largo,$area, $num_habitaciones, $num_banos,$estacionamiento,$estado){
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("INSERT INTO propiedades 
    (titulo, descripcion, tipo, precio, ubicacion, ancho, largo, area, num_habitaciones, num_banos, estacionamiento, estado, id_usuario) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sentenciaSQL->execute(array($titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho,$largo,$area, $num_habitaciones, $num_banos,$estacionamiento,$estado,1));

            // Puedes retornar el ID del usuario insertado si lo necesitas
            return $this->conexion->insert_id;
        } catch (PDOException $e) {
            // Manejo de errores
            return false;
        }
    }
    public function eliminarPropiedad($id){
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("DELETE FROM propiedades WHERE id = ?");
            $sentenciaSQL->execute(array($id));

            return true;
        } catch (PDOException $e) {
            // Manejo de errores
            return false;
        }
    }
    public function actualizarPropiedad($id, $titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado) {
        try {
            $this->conectar();
    
            $sentenciaSQL = $this->conexion->prepare("UPDATE propiedades SET 
                titulo = ?, descripcion = ?, tipo = ?, precio = ?, ubicacion = ?, ancho = ?, largo = ?, area = ?, num_habitaciones = ?, num_banos = ?, estacionamiento = ?, estado = ? 
                WHERE id = ?");
    
            // Ejecutar la consulta con los valores
            $sentenciaSQL->execute(array($titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado, $id));
    
            return true;
    
        } catch (PDOException $e) {
            echo "Error al actualizar la propiedad: " . $e->getMessage();
            return false;
        }
    }
    public function obtenerPropiedadPorId($id) {
        try {
            $this->conectar();
    
            $sentenciaSQL = $this->conexion->prepare("SELECT * FROM propiedades WHERE id = ?");
            $sentenciaSQL->execute(array($id));
    
            $resultado = $sentenciaSQL->get_result();
            return $resultado->fetch_assoc();
    
        } catch (PDOException $e) {
            echo "Error al obtener la propiedad: " . $e->getMessage();
            return false;
        }
    }
    
    
}

?>