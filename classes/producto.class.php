<?php
    class Producto{
        public $id;
        public $nombre;
        public $descripcion;
        public $imagen;
        public $precio;
        public $id_tipo_impuesto;
        private PDO $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function nuevo(){

        }

        public function baja(){

        }
        
        public function modificar(){

        }
        public function listarDB($pagina, $paginado){
            $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM producto');
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

            $pagina-=1;

            $inicio=$pagina * $paginado;

                    

            $stmt = $this->db->prepare('
    SELECT id_producto, nombre, descripcion, precio FROM producto LIMIT '.$inicio.', '.$paginado.'');

            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $fin=$inicio + $paginado;

            return array("version"=>"nueva", "total"=>$total, "paginas"=>ceil($total/$paginado), "paginaActual"=>$pagina);
        }
        
        public function listar($pagina, $paginado){
            $arrADevolver=array();
            $pagina-=1;

            $listado = $this->listado();

            $inicio=$pagina * $paginado;
            $fin=$inicio + $paginado;
            if($fin>count($listado)){
                $fin=count($listado);
            }
            

            for($x=$inicio; $x<$fin; $x++){
                $arrADevolver[$x]=$listado[$x];
            }
            
            return array("total"=>count($listado), "paginas"=>ceil(count($listado)/$paginado), "paginaActual"=>$pagina + 1, "datos"=>$arrADevolver);
        }
        
        public function listado() {
            $stmt = $this->db->prepare('SELECT id_producto, descripcion, nombre, precio FROM producto');
            $stmt->execute();
            $datos = $stmt->fetch();
            return $datos;
        }
    }
?>