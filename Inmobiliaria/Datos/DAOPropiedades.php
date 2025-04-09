<?php
require_once 'conexion.php'; 
require_once '../Modelo/propiedad.php'; 

class DAOPropiedades {
    private $conexion;

    private function conectar() {
        try {
            global $conn;
            $this->conexion = $conn;
        } catch (Exception $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function agregarPropiedad($titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado) {
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("INSERT INTO propiedades 
                (titulo, descripcion, tipo, precio, ubicacion, ancho, largo, area, num_habitaciones, num_banos, estacionamiento, estado, id_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $sentenciaSQL->execute(array($titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado, 1));

            return $this->conexion->insert_id;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminarPropiedad($id) {
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("DELETE FROM propiedades WHERE id = ?");
            $sentenciaSQL->execute(array($id));

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarPropiedad($id, $titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado) {
        try {
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare("UPDATE propiedades SET 
                titulo = ?, descripcion = ?, tipo = ?, precio = ?, ubicacion = ?, ancho = ?, largo = ?, area = ?, num_habitaciones = ?, num_banos = ?, estacionamiento = ?, estado = ? 
                WHERE id = ?");

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

    // ✅ Multimedia

    public function obtenerMultimediaPorPropiedad($idPropiedad) {
        $this->conectar();
        $stmt = $this->conexion->prepare("SELECT * FROM multimedia WHERE id_propiedad = ?");
        $stmt->bind_param("i", $idPropiedad);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function agregarImagen($idPropiedad, $url) {
        $this->conectar();
        $stmt = $this->conexion->prepare("INSERT INTO multimedia (id_propiedad, tipo, url) VALUES (?, 'Imagen', ?)");
        $stmt->bind_param("is", $idPropiedad, $url);
        return $stmt->execute();
    }

    public function eliminarImagen($idImagen) {
        $this->conectar();
        $stmt = $this->conexion->prepare("DELETE FROM multimedia WHERE id = ?");
        $stmt->bind_param("i", $idImagen);
        return $stmt->execute();
    }
    
}
?>
