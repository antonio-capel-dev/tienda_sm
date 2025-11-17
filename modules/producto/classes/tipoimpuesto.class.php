<?php
    class Tipo_impuesto {
        public $id_tipo_impuesto;
        public $impuesto;
        public $valor;
        private PDO $db;
    
        public function __construct(PDO$db) {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->db = $db;
        }

        function listarDB(int $pagina = 1, int $paginado = 10):array {
            $pagina = max(1, (int)$pagina);
            $paginado = max(1, (int)$paginado);
            $inicio = ($pagina - 1) * $paginado;


            $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM tipo_impuesto');
            $stmt->execute();
            $total = (int)$stmt->fetch(PDO::FETCH_ASSOC)["total"];

            $sql = 'SELECT id_tipo_impuesto, impuesto, valor
                    FROM tipo_impuesto
                    ORDER BY id_tipo_impuesto ASC
                    LIMIT ' . (int)$inicio . ', ' . (int)$paginado;

            

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                "version" => "nueva",
                "total" => $total,
                "paginas" => (int)ceil($total / $paginado),
                "paginaActual" => $pagina,
                "datos" => $datos
            ];
            
        }

        public function verDetalle(int $id): ?array {
            $stmt = $this->db->prepare('SELECT * FROM tipo_impuesto WHERE id_tipo_impuesto = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            return $fila ?: null;
        }

        public function crear(array $form): bool {
            if (!isset($form['impuesto'], $form['valor'])) return false;
        
        $impuesto = trim((string)$form['impuesto']);
        if ($impuesto === '') return false;

        $valor = (float)$form['valor'];
        if ($valor < 0) return false;

        $sql = 'INSERT INTO tipo_impuesto (impuesto, valor) VALUES (:impuesto, :valor)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':impuesto', $impuesto);
        $stmt->bindValue(':valor', $valor);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

        public function eliminar(int $id): bool {
            $stmt  = $this->db->prepare('DELETE FROM tipo_impuesto WHERE id_tipo_impuesto = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            try {
                return $stmt->execute();
            } catch(Exception $e) {
                return false;
            }
        }



        public function guardarDetalle(int $id,  array $formulario): bool {

            if (!isset($formulario['impuesto'], $formulario['valor'])) {
                return false;
            }

            $impuesto = trim((string)$formulario['impuesto']);
            $valor = (float)$formulario['valor'];

            $sql = 'UPDATE tipo_impuesto
                    SET impuesto = :impuesto,
                    valor = :valor
                    WHERE id_tipo_impuesto = :id';

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':impuesto', $impuesto, PDO::PARAM_STR);
            $stmt->bindValue(':valor', $valor);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            try{
                return $stmt->execute();
                } catch (Exception $e) {
                    return false;
                }
            }
            public function render(array $data): string {
            $html="";
            if (isset($data["datos"]) && is_array($data["datos"])) {
                $html .= '<table class="table table-striped">';
                $html .= '<thead><tr><th>ID</th><th>Impuesto</th><th>Valor</th></tr></thead><tbody>';
                foreach($data['datos'] as $fila) {
                    $id = htmlspecialchars((string)$fila['id_tipo_impuesto'], ENT_QUOTES, 'UTF-8');
                    $imp = htmlspecialchars($fila['impuesto'], ENT_QUOTES, 'UTF-8');
                    $valor = htmlspecialchars((string)$fila['valor'], ENT_QUOTES, 'UTF-8');
                    $html .= "<tr><td>{$id}</td><td>{$imp}</td><td>{$valor}</td></tr>";
                }
                $html .= '</tbody></table>';
            }
            return $html;
        }
    }







?>