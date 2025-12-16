<?php
/**
 * Controlador de Membresías
 */

require_once __DIR__ . '/../models/Membership.php';

class MembershipController {

    private $membershipModel;

    public function __construct() {
        $this->membershipModel = new Membership();
    }

    // LISTAR
    public function index() {
        $memberships = $this->membershipModel->getAll();
        require __DIR__ . '/../views/membership/index.php';
    }

    // MOSTRAR FORMULARIO CREAR
    public function create() {
        require __DIR__ . '/../views/membership/create.php';
    }

    // GUARDAR (INSERT)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?controller=membership&action=index');
            exit;
        }

        $data = [
            'name'          => $_POST['name'] ?? '',
            'price'         => $_POST['price'] ?? 0,
            'duration_days' => $_POST['duration_days'] ?? 0,
            'description'   => $_POST['description'] ?? null
        ];

        // Validación simple
        if (empty($data['name']) || $data['duration_days'] <= 0) {
            // Opcional: Podrías guardar errores en sesión para mostrarlos en la vista
            echo "Error: Datos inválidos. El nombre y la duración son obligatorios.";
            exit;
        }

        $this->membershipModel->create($data);

        // CORRECCIÓN: Redirección con la estructura correcta
        header('Location: /index.php?controller=membership&action=index');
        exit;
    }

    // MOSTRAR FORMULARIO EDITAR
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: /index.php?controller=membership&action=index');
            exit;
        }

        $membership = $this->membershipModel->getById($_GET['id']);

        if (!$membership) {
            echo "Membresía no encontrada";
            exit;
        }

        require __DIR__ . '/../views/membership/edit.php';
    }

    // ACTUALIZAR (UPDATE)
    public function update() {
        // CORRECCIÓN: El ID viene por POST (input hidden), no por GET
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
            header('Location: /index.php?controller=membership&action=index');
            exit;
        }

        $id = $_POST['id']; // Tomamos el ID del POST

        $data = [
            'name'          => $_POST['name'],
            'price'         => $_POST['price'],
            'duration_days' => $_POST['duration_days'],
            'description'   => $_POST['description'] ?? null
        ];

        $this->membershipModel->update($id, $data);

        header('Location: /index.php?controller=membership&action=index');
        exit;
    }

    // ELIMINAR
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: /index.php?controller=membership&action=index');
            exit;
        }

        $this->membershipModel->delete($_GET['id']);
        
        header('Location: /index.php?controller=membership&action=index');
        exit;
    }
}