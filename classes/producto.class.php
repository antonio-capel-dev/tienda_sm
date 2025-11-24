<?php
class Producto
{
    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $precio;
    public $id_tipo_impuesto;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function nuevo() {}

    public function baja() {}

    /**
     * Listar productos con paginación desde base de datos
     */
    public function listarDB($pagina, $paginado)
    {
        $stmt = $this->db->prepare('SELECT p.id, p.nombre, p.descripcion,
        p.precio, ti.impuesto, ti.valor
        FROM producto as p
        LEFT JOIN tipo_impuesto ti ON p.id_tipo_impuesto = ti.id_tipo_impuesto
        LIMIT :inicio, :paginado');
        $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
        $stmt->bindValue(':paginado', $paginado, PDO::PARAM_INT);
        $stmt->execute();
        print_r($listado["datos"]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

        $pagina -= 1;
        $inicio = $pagina * $paginado;

        $stmt = $this->db->prepare('
            SELECT id_producto, nombre, descripcion, precio 
            FROM producto
            LIMIT ' . $inicio . ',' . $paginado . '
        ');
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array(
            "version" => "nueva", 
            "total" => $total, 
            "paginas" => ceil($total / $paginado), 
            "paginaActual" => $pagina + 1, 
            "datos" => $datos
        );
    }

    /**
     * Listar productos con paginación (versión array)
     */
    public function listar($pagina, $paginado)
    {
        $arrADevolver = array();
        $pagina -= 1;
        $listado = $this->listado();

        $inicio = $pagina * $paginado;
        $fin = $inicio + $paginado;
        
        if ($fin > count($listado)) {
            $fin = count($listado);
        }

        for ($x = $inicio; $x < $fin; $x++) {
            $arrADevolver[$x] = $listado[$x];
        }

        return array(
            "version" => "original", 
            "total" => count($listado), 
            "paginas" => ceil(count($listado) / $paginado), 
            "paginaActual" => $pagina + 1, 
            "datos" => $arrADevolver
        );
    }

    /**
     * Obtener listado completo de productos
     */
    public function listado()
    {
        $stmt = $this->db->prepare('
            SELECT id_producto, descripcion, nombre, precio 
            FROM producto
        ');
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    /**
     * Ver detalle completo de un producto
     */
    public function verdetalle($id)
    {
        $stmt = $this->db->prepare('
            SELECT * FROM producto 
            WHERE id_producto = :id_producto
        ');
        $stmt->bindValue(':id_producto', $id, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validar precio
        if (empty($datos["precio"]) || $datos["precio"] == "") {
            $datos["precio"] = "0.00";
        }

        // Validar imagen
        if (empty($datos["imagen"]) || $datos["imagen"] == "") {
            $datos["imagen"] = "https://www.bootdey.com/image/430x600/00CED1/000000";
        } else {
            // Si hay imagen, construir ruta
            $rutaImagen = "assets/images/products/" . $datos["imagen"];
            if (!file_exists($rutaImagen)) {
                $datos["imagen"] = "https://www.bootdey.com/image/430x600/00CED1/000000";
            } else {
                $datos["imagen"] = $rutaImagen;
            }
        }

        return $datos;
    }

    /**
     * Obtener datos de producto para editar
     */
    public function editardetalle($id)
    {
        $stmt = $this->db->prepare('
            SELECT * FROM producto 
            WHERE id_producto = :id_producto
        ');
        $stmt->bindValue(':id_producto', $id, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }

    /**
     * Guardar cambios de un producto desde formulario
     */
    public function guardardetalle($id, $formulario)
    {
        $stmt = $this->db->prepare('
            UPDATE producto SET 
                nombre = :nombre,
                precio = :precio,
                descripcion = :descripcion
            WHERE id_producto = :id_producto
        ');
        
        $stmt->bindValue(':id_producto', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nombre', $formulario["nombre"], PDO::PARAM_STR);
        $stmt->bindValue(':precio', $formulario["precio"], PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $formulario["descripcion"], PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error al guardar producto: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Modificar producto (con opción de cambiar imagen)
     */
    public function modificar($id, $nombre, $descripcion, $precio, $imagen = null)
    {
        if ($imagen === null) {
            $sql = 'UPDATE producto
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        precio = :precio
                    WHERE id_producto = :id_producto';
        } else {
            $sql = 'UPDATE producto
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        precio = :precio,
                        imagen = :imagen
                    WHERE id_producto = :id_producto';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindValue(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindValue(':id_producto', $id, PDO::PARAM_INT);
        
        if ($imagen !== null) {
            $stmt->bindValue(':imagen', $imagen, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }
}
?>