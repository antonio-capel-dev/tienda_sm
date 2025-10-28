<?php
    class Impuestos {
    public $id;
    public $nombre
    public $porcentaje;0
    public $porcentaje;
    public $activo;
    private $db;
        /**Constructor al crear la clase impuestos */
    public function __constructor(db) {
        $this->db =$db;
    }

    public function nuevo() {
        $sql = "INSERT INTO impuestos (nombre, porcentaje, activo)
                VALUES (:nombre, :porcentaje, :activo)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'nombre' => $this>nombre,
            'porcentaje' => $this->activo
        ]);

        $this->id = $this->db->lastInsertID();

        return $this->id;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM impuestos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        //Obtener datos
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if($datos) {
            $this->id = $datos['id'];
            $this->nombre = $datos['nombre'];
            $this->porcentaje = $datos['porcentaje'];
            $this->activo = $datos['activo'];
        }
        return $datos;
    }
    }





?>