<?php
/**
 * Modelo de Membresia
 * 
 * Este modelo representa la capa de acceso a datos para las membresias.
 * Se ejecuta en el SERVIDOR y se comunica con la base de datos.
 */

require_once __DIR__ . '/../config/database.php';

class Membership {
    private $db;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    /**
     * Obtiene todas las membresias desde el SERVIDOR de base de datos
     * 
     * @return array Lista de membresias
     */
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM membership_types");
        return $stmt->fetchAll();
    }
    
    /**
     * Obtiene una membresia por ID desde el SERVIDOR
     * 
     * @param int $id ID de la membresia
     * @return array|false Datos de la membresia o false si no existe
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM membership_types WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    

    
    /**
     * Crea un nuevo miembro en el SERVIDOR de base de datos AQUI ME QUEDE
     * 
     * @param array $data Datos del miembro (name, email, phone, registration_date)
     * @return int ID del miembro creado
     */
    public function create($data) {
        $sql = "INSERT INTO membership_types (name, price, duration_days, description) 
                VALUES (:name, :price, :duration_days, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'duration_days' => $data['duration_days'],
            'description' => $data['description'] ?? null
        ]);
        return $this->db->lastInsertId();
    }
    
    /**
     * Actualiza un miembro existente en el SERVIDOR
     * 
     * @param int $id ID del miembro
     * @param array $data Datos actualizados
     * @return bool True si se actualizó correctamente
     */
    public function update($id, $data) {
        $sql = "UPDATE membership_types 
                SET name = :name, price = :price, duration_days = :duration_days, 
                    description = :description
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'price' => $data['price'],
            'duration_days' => $data['duration_days'],
            'description' => $data['description']
        ]);
    }
    
    /**
     * Elimina un miembro del SERVIDOR de base de datos
     * 
     * @param int $id ID del miembro
     * @return bool True si se eliminó correctamente
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM membership_types WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
}

