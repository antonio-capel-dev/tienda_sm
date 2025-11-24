<?php
class Tipo_Impuesto {
    private PDO $db;

    public function __construct(PDO $db) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $db;
    }

    
    public function listarDB(int $pagina = 1, int $paginado = 10): array {
        $pagina = max(1, $pagina);
        $inicio = ($pagina - 1) * $paginado;

        // Total de registros
        $stmt = $this->db->prepare('SELECT COUNT(*) AS total FROM tipo_impuesto');
        $stmt->execute();
        $total = (int) $stmt->fetch(PDO::FETCH_ASSOC)["total"];

        // Página actual
        $sql = 'SELECT id_tipo_impuesto, impuesto, valor
                FROM tipo_impuesto
                ORDER BY id_tipo_impuesto ASC
                LIMIT :inicio, :paginado';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
        $stmt->bindValue(':paginado', $paginado, PDO::PARAM_INT);
        $stmt->execute();

        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            "total" => $total,
            "paginas" => ceil($total / $paginado),
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

        $impuesto = trim($form['impuesto']);
        $valor = (float)$form['valor'];

        if ($impuesto === '' || $valor < 0) return false;

        $sql = 'INSERT INTO tipo_impuesto (impuesto, valor)
                VALUES (:impuesto, :valor)';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':impuesto', $impuesto);
        $stmt->bindValue(':valor', $valor);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function guardarDetalle(int $id, array $form): bool {
        if (!isset($form['impuesto'], $form['valor'])) return false;

        $impuesto = trim($form['impuesto']);
        $valor = (float)$form['valor'];

        $sql = 'UPDATE tipo_impuesto
                SET impuesto = :impuesto, valor = :valor
                WHERE id_tipo_impuesto = :id';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':impuesto', $impuesto);
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM tipo_impuesto WHERE id_tipo_impuesto = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

}
?>
