<?php
    class Producto{
        public $id;
        public $nombre;
        public $descripcion;
        public $imagen;
        public $precio;
        public $id_tipo_impuesto;
        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function nuevo(array $form = []): bool {
            if (!isset($form['nombre'], $form['precio'], $form['id_tipo_impuesto'])) {
                return false;
            } 

            $nombre = trim((string)$form['nombre']);
            if ($nombre === '') {
                return false;
            } 
            $id_tipo_impuesto = (int)$form['id_tipo_impuesto'];
            $precio = (float)$form['precio'];
            if ($precio <=0) { return false;
            }
            $descripcion = isset($form['descripcion']) ? trim((string)$form['descripcion']) : null;
            $imagen = isset($form['imagen']) ? trim ((string)$form['imagen']) : null;
            //$id = isset($form)['id'])
            $sql = 'INSERT INTO producto (nombre, descripcion, imagen, precio, id_tipo_impuesto)
                VALUES (:nombre, :descripcion, :imagen, :precio, :id_tipo_impuesto)';

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':descripcion', $descripcion, $descripcion === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':imagen', $imagen, $imagen === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
            $stmt->bindValue(':precio', $precio);
            $stmt->bindValue(':id_tipo_impuesto', $id_tipo_impuesto, PDO::PARAM_INT);

            try{
             return $stmt->execute();
                }catch (PDOException $e) {
                    error_log("Fallo en la conexión a la base de datos");
                return false;
                }            
        }
        

        public function eliminar(int $id): bool{
            $sql = 'DELETE FROM producto WHERE id_producto = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            
            try{
                 return $stmt->execute();
                } catch (PDOException $e) {
                    return false;
                }
        }   
        
        public function listarDB($pagina, $paginado){
            $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM producto');
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];
            $pagina-=1;
            $inicio=$pagina * $paginado;
            $stmt = $this->db->prepare('
             SELECT 
                p.id_producto,
                p.nombre,
                p.descripcion,
                p.precio,
                ti.impuesto,
                ti.valor
                FROM producto AS p
                LEFT JOIN tipo_impuesto AS ti 
                ON p.id_tipo_impuesto = ti.id_tipo_impuesto
                LIMIT :inicio, :paginado
                ');
            $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
            $stmt->bindValue(':paginado', $paginado, PDO::PARAM_INT);
            $stmt->execute();

            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array("total"=> $total,
            "paginas"=>ceil($total/$paginado),
            "paginaActual"=> $pagina + 1,
            "datos" =>$datos);
        }

        
        public function listado(){
            $stmt = $this->db->prepare('SELECT id_producto, descripcion, nombre, precio FROM producto');
            $stmt->execute();
            //$stmt->bindValue(1, $type, PDO::PARAM_STR, 256);
            //$stmt->bindParam(2, $lob, PDO::PARAM_LOB);
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);


            //echo "<pre>"; print_r($datos); echo "</pre>";
            return $datos;
        }

        public function verdetalle($id){
            $stmt = $this->db->prepare('SELECT * FROM producto WHERE id_producto=:id_producto');
            $stmt->bindValue(':id_producto', $id);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

            if(empty($datos["precio"]) || $datos["precio"]==""){
                $datos["precio"]=0.00;
            }

            if(empty($datos["imagen"]) || $datos["imagen"]==""){
                $datos["imagen"]="https://www.bootdey.com/image/430x600/00CED1/000000";
            }else{
                $datos["imagen"]="assets/images/productos/".$datos["imagen"];
                if(!file_exists($datos["imagen"])){
                    $datos["imagen"]="https://www.bootdey.com/image/430x600/00CED1/000000";
                }
            }

            return $datos;
        }

        public function guardardetalle($id, $formulario){
            $stmt = $this->db->prepare('UPDATE producto SET nombre=:nombre, precio=:precio, descripcion=:descripcion WHERE id_producto=:id_producto');
            $stmt->bindValue(':id_producto', $id);
            $stmt->bindValue(':nombre', $formulario["nombre"]);
            $stmt->bindValue(':precio', $formulario["precio"]);
            $stmt->bindValue(':descripcion', $formulario["descripcion"]);
            
            try{
                if($stmt->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                return false;
            }
  
        }
    }
?>