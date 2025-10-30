<?php
/**
 * Class Clients
 * 
 * This class manages client records for invoicing purposes, ensuring 
 * compliance with legal requirements (name, ID, address, contact info).
 * 
 * Features:
 * - Insert, update, delete, list (10 per page), and view details
 * - Full validation for mandatory fields and email addresses
 * - Robust error handling using try/catch
 * 
 * @author  
 * @version 1.0
 */

class Clients {
    /** @var PDO Database connection instance */
    private $db;

    /**
     * Constructor
     * 
     * @param PDO $db A PDO database connection instance
     */
    public function __construct(PDO $db) {
        $this->db = $db;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Validate email format and domain existence
     * 
     * @param string $email
     * @return bool
     * @throws Exception if the email is invalid or domain doesn’t exist
     */
    private function validateEmail(string $email): bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
            throw new Exception("The email domain does not exist or has no valid mail server.");
        }

        return true;
    }

    /**
     * Insert a new client record
     */
    public function insert($firstName, $lastName, $docType, $docNumber, $address, $phone, $email): array {
        try {
            if (empty($firstName) || empty($lastName) || empty($docType) || empty($docNumber)) {
                throw new Exception("Mandatory fields cannot be empty.");
            }

            $this->validateEmail($email);

            $sql = "INSERT INTO clients 
                    (first_name, last_name, document_type, document_number, address, phone, email)
                    VALUES (:firstName, :lastName, :docType, :docNumber, :address, :phone, :email)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':docType', $docType);
            $stmt->bindParam(':docNumber', $docNumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return ["success" => true, "message" => "Client successfully inserted."];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    /**
     * Update an existing client
     */
    public function update($id, $firstName, $lastName, $docType, $docNumber, $address, $phone, $email): array {
        try {
            if (empty($id)) {
                throw new Exception("Client ID is required.");
            }

            $this->validateEmail($email);

            $sql = "UPDATE clients SET 
                        first_name = :firstName,
                        last_name = :lastName,
                        document_type = :docType,
                        document_number = :docNumber,
                        address = :address,
                        phone = :phone,
                        email = :email
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':docType', $docType);
            $stmt->bindParam(':docNumber', $docNumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return ["success" => true, "message" => "Client successfully updated."];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    /**
     * Delete a client
     */
    public function delete($id): array {
        try {
            if (empty($id)) {
                throw new Exception("Client ID is required for deletion.");
            }

            $sql = "DELETE FROM clients WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                throw new Exception("No client found with the provided ID.");
            }

            return ["success" => true, "message" => "Client successfully deleted."];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    /**
     * List clients in pages of 10 records
     */
    public function list(int $page = 1): array {
        try {
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $sql = "SELECT * FROM clients ORDER BY id DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            return ["success" => true, "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }

    /**
     * Retrieve client details by ID
     */
    public function viewDetail($id): array {
        try {
            if (empty($id)) {
                throw new Exception("Client ID is required.");
            }

            $sql = "SELECT * FROM clients WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $client = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$client) {
                throw new Exception("Client not found.");
            }

            return ["success" => true, "data" => $client];
        } catch (Exception $e) {
            return ["success" => false, "error" => $e->getMessage()];
        }
    }
}
?>
