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

    public function listarDB($pagina, $paginado){
            $stmt = $this->db->prepare( 'SELECT id_producto, nombre, descripcion, precio FROM producto LIMIT .$inicio., .$paginado.');
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

            $pagina-=1;

            $arrADevolver=array();
            
            $inicio=$pagina * $paginado;

            $stmt = $this->db->prepare('
                                    SELECT id_producto, nombre, descripcion, precio FROM producto LIMIT .$inicio., .$paginado.');

            $fin=$inicio + $paginado;
}
    }
?>