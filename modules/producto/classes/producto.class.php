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

<<<<<<< HEAD
        public function nuevo(){

        }

        public function baja(){

=======
        public function nuevo(array $form = []): bool{
            if (!isset($form['nombre'], $form['percio'] $form['id_tipo_impuesto'])) return false;

            $nombre = trim((string)$form['nombre']);
            if ($nombre === '') return false;

            $precio = (float)$form['precio'];
            if ($nombre === '') return false;
            $descripcion = isset($form['descripcion']) ? trim((string)$form['descripcion']) : null
            $imagen = isset($form['imagen']) ? trim ((string)$form['imagen']) : null;
             $sql = 'INSERT INTO producto (nombre, descripcion, imagen, precio, id_tipo_impuesto)
                VALUES (:nombre, :descripcion, :imagen, :precio, :id_tipo_impuesto)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':descripcion', $descripcion, $descripcion === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':imagen', $imagen, $imagen === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':precio', $precio);
        $stmt->bindValue(':id_tipo_impuesto', $id_tipo, PDO::PARAM_INT);



            $stmt = $this->db->prepare('DELETE FROM producto WHERE id_producto = :id');
            $stmt->bindValue('id', $id, PDO:: PARAM_INT);
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

        public function eliminar(int $id): bool{
            $stmt = $this->db->prepare('DELETE FROM producto WHERE id_producto = :id');
            $stmt->bindValue('id', $id, PDO:: PARAM_INT);
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
>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
        }
        
        
        public function listarDB($pagina, $paginado){
            $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM producto');
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

            $pagina-=1;

            $inicio=$pagina * $paginado;

            $stmt = $this->db->prepare('
                                        SELECT id_producto, nombre, descripcion, precio 
                                        FROM producto
                                        LIMIT '.$inicio.','.$paginado.'
                                        ');
            $stmt->execute();
            //$stmt->bindValue(1, $type, PDO::PARAM_STR, 256);
            //$stmt->bindParam(2, $lob, PDO::PARAM_LOB);
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);


            return array("version"=>"nueva", "total"=>$total, "paginas"=>ceil($total/$paginado), "paginaActual"=>$pagina + 1, "datos"=>$datos);
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
<<<<<<< HEAD
=======
  
            

>>>>>>> b588d6d (✨ Refactor completo: CRUD de tipo_impuesto y producto, controladores corregidos, paginación segura, validaciones, sanitización, render mejorado y arquitectura MVC más sólida.)
            
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


        public function render($theme, $data, $type){
            $html="";
            if (isset($data["datos"]) && is_array($data["datos"])) {
                foreach($data["datos"] as $id=>$prod){
                    $precio=($prod["precio"]!="")?number_format($prod["precio"], 2, ",", ".")." €":"";
                    $html.='<tr>';
                        $html.= '<td>'.$id.'</td>';
                        $html.= '<td>'.$prod["nombre"].'</td>';
                        $html.= '<td align="right">'.$precio.'</td>';
                        $html.= '<td>';
                            $html.= '<a href="index.php?contenido=verproducto&id='.$prod["id_producto"].'">Ver</a>';
                            $html.= '&nbsp;';
                            $html.= '<a href="index.php?contenido=editarproducto&id='.$prod["id_producto"].'">Editar</a>';
                        $html.= '</td>';
                    $html.= '</tr>';
                }
            }
            $response = str_replace("##CONTENT@@", $html, file_get_contents($theme));
            if(array_key_exists("nombre", $data)){
                $response = str_replace("##NOMBRE@@", $data["nombre"], $response);
            }
            if(array_key_exists("descripcion", $data)){
                $response = str_replace("##DESCRIPCION@@", ($data["descripcion"])?$data["descripcion"]:"", $response);
            }
            if(array_key_exists("precio", $data)){
                $response = str_replace("##PRECIO@@", number_format($data["precio"], 2, "," , "."), $response);
            }
            if(array_key_exists("id_producto", $data)){
                $response = str_replace("##ID@@", $data["id_producto"], $response);
            }
            if(array_key_exists("imagen", $data)){
                $response = str_replace("##IMAGEN@@", $data["imagen"], $response);
            }
            
            return $response;
        
        }
    }

    
?>