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


    public function listarDB($pagina, $paginado)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM producto');
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

        $pagina -= 1;

        $inicio = $pagina * $paginado;

        $stmt = $this->db->prepare('
                                        SELECT id_producto, nombre, descripcion, precio 
                                        FROM producto
                                        LIMIT ' . $inicio . ',' . $paginado . '
                                        ');
        $stmt->execute();
        //$stmt->bindValue(1, $type, PDO::PARAM_STR, 256);
        //$stmt->bindParam(2, $lob, PDO::PARAM_LOB);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return array("version" => "nueva", "total" => $total, "paginas" => ceil($total / $paginado), "paginaActual" => $pagina + 1, "datos" => $datos);
    }

    public function listar($pagina, $paginado)
    {
        $arrADevolver = array();
        $pagina -= 1;

        /*
            $listado=array(
                "0"=>"Patatas Rojas", 
                "1"=>"Patatas",
                "2"=>"Pimientos",
                "3"=>"Tomates",
                "4"=>"Pepinos",
                "5"=>"Cebolla",
                "6"=>"Cebollino",
                "7"=>"Tomate cherry",
                "8"=>"Cebolleta",
                "9"=>"Pimiento rojo",
                "10"=>"Arándanos",
            );/**/
        $listado = $this->listado();

        $inicio = $pagina * $paginado;
        $fin = $inicio + $paginado;
        if ($fin > count($listado)) {
            $fin = count($listado);
        }


        for ($x = $inicio; $x < $fin; $x++) {
            $arrADevolver[$x] = $listado[$x];
        }

        return array("version" => "original", "total" => count($listado), "paginas" => ceil(count($listado) / $paginado), "paginaActual" => $pagina + 1, "datos" => $arrADevolver);
    }

    public function listado()
    {
        $stmt = $this->db->prepare('SELECT id_producto, descripcion, nombre, precio FROM producto');
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);



        return $datos;
    }
    public function verdetalle($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM producto WHERE id_producto=:id_producto');
        $stmt->bindValue(':id_producto', $id);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);


        if (empty($datos["precio"]) || $datos["precio"] == "") {
            $datos["precio"] = "0.00";
        }

        if (empty($datos["imagen"]) || $datos["imagen"] == "") {
            $datos["imagen"] = "https://www.bootdey.com/imagen/430X600/00CED1/000000";

            $datos["imagen"] = "assets/images/products/" . $datos["imagen"];
            echo "ruta: " . getcwd();
            if (!file_exists("assets/images/products/" . $datos["imagen"]));
            $datos["imagen"] = "";
        }
    }




    public function editardetalle($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM producto WHERE id_producto=:id_producto');
        $stmt->bindValue(':id_producto', $id);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function guardardetalle($id, $formulario)
    {
        $stmt = $this->db->prepare('UPDATE * FROM producto WHERE id_producto=:id_producto');
        $stmt->bindValue(':id_producto', $id);
        $stmt->bindValue(':nombre', $formulario["nombre"]);
        $stmt->bindValue(':precio', $formulario["precio"]);
        $stmt->bindValue(':descripcion', $formulario["descripcion"]);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }



        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }


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
            $stmt->bindvalue(':imagen', $imagen, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }
}
