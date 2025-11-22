<?php
 
class Tipo_Impuesto {
    public $id;
    public $nombre;
    public $porcentaje;
    private $db;

    
    public function __construct($db)
    {
        $this->db = $db;
    }

    
    public function listarDB($pagina, $paginado)
    {
        try {
            // Contar total de registros
            $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM tipo_impuesto');
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

            // Calcular inicio
            $pagina -= 1;
            $inicio = $pagina * $paginado;

            // Obtener datos paginados
            $stmt = $this->db->prepare('
                SELECT id_tipo_impuesto, nombre, porcentaje 
                FROM tipo_impuesto
                ORDER BY porcentaje DESC
                LIMIT ' . $inicio . ',' . $paginado . '
            ');
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array(
                "total" => $total,
                "paginas" => ceil($total / $paginado),
                "paginaActual" => $pagina + 1,
                "datos" => $datos
            );
        } catch (Exception $e) {
            error_log("Error en listarDB: " . $e->getMessage());
            return array("total" => 0, "paginas" => 0, "paginaActual" => 1, "datos" => []);
        }
    }

    /**
     * Obtener un impuesto por su ID
     */
    public function obtenerPorId($id)
    {
        try {
            $stmt = $this->db->prepare('
                SELECT * FROM tipo_impuesto 
                WHERE id_tipo_impuesto = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $resultado ? $resultado : false;
        } catch (Exception $e) {
            error_log("Error en obtenerPorId: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Crear un nuevo tipo de impuesto
     */
    public function nuevo($nombre, $porcentaje)
    {
        try {
            $stmt = $this->db->prepare('
                INSERT INTO tipo_impuesto (nombre, porcentaje) 
                VALUES (:nombre, :porcentaje)
            ');
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':porcentaje', $porcentaje, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en nuevo: " . $e->getMessage());
            return false;
        }
    }

    public function modificar($id, $nombre, $porcentaje)
    {
        try {
            $stmt = $this->db->prepare('
                UPDATE tipo_impuesto 
                SET nombre = :nombre, 
                    porcentaje = :porcentaje
                WHERE id_tipo_impuesto = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':porcentaje', $porcentaje, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en modificar: " . $e->getMessage());
            return false;
        }
    }


    public function baja($id)
    {
        try {
            $stmt = $this->db->prepare('
                DELETE FROM tipo_impuesto 
                WHERE id_tipo_impuesto = :id
            ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error en baja: " . $e->getMessage());
            return false;
        }
    }

    public function calcularPrecioConImpuesto($precioBase, $idTipoImpuesto)    {
        $impuesto = $this->obtenerPorId($idTipoImpuesto);
        
        if (!$impuesto) {
            return $precioBase;
        }
        
        $porcentaje = $impuesto['porcentaje'];
        return $precioBase * (1 + ($porcentaje / 100));
    }

    /**
     * Renderizar vista (método temporal para debug)
     */
    public function render($datos)
    {
        echo "<pre>";
        echo "RENDER\n";
        print_r($datos);
        echo "</pre>";
    }
}
?>