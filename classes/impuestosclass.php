<?php
    class Impuestos {
    public $id;
    public $nombre;
    public $porcentaje; 
    public $activo;      
    private $db;


   
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    /**
     * METODO: listado() - Obtiene TODOS los impuestos. This method return an array with all the register.
     */

    public function listado() {
        try {
            $sql = 'SELECT id, nombre, porcentaje, activo' .
            'FROM impuestos ' .
            'WHERE activo = 1 ' .
            'ORDER BY id DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en el listado: " . $e->getMessage());
            return [];
        }
    }

    public function listarDB($pagina, $paginado){
        try {
            $pagina -= 1;
            $inicio = $pagina * $paginado;

            $sql = 'SELECT id, nombre, porcentaje, activo ' .
            'FROM impuestos ' . 
            'ORDER BY id DESC LIMIT ?, ?';
        
            $stmt = $this->db->prepare($sql);
            $stmt->execute($inicio, $paginado);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }   catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            return [];
        }
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];
            $pagina-=1;
            $arrADevolver=array();
            $inicio=$pagina * $paginado;
            $stmt = $this->db->prepare('
                    SELECT id_impuesto, nombre, descripcion, precio FROM impuestos LIMIT .$inicio., .$paginado.');
            $fin=$inicio + $paginado;
}

    public function listar($pagina, $paginado) {
            $arrayAdevolver=array();
            $pagina -=1;
            $listado = $this->listado();

            $inicio=$pagina * $paginado;
            $fin=$inicio + $paginado;
            if($fin>count) {

            }
    }
    }
?>