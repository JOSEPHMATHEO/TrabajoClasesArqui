<?php
/**
 * Vista: Lista de Tipos de Membresía
 * * CLIENTE: Esta vista se renderiza en el navegador del usuario.
 * Muestra los datos que el SERVIDOR envió después de procesar la petición.
 */

require_once __DIR__ . '/../layouts/header.php';
?>

<h2>Gestión de Tipos de Membresía</h2>

<div class="actions">
    <a href="/index.php?controller=membership&action=create" class="btn btn-primary">➕ Nueva Membresía</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Duración (Días)</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($memberships)): ?>
            <tr>
                <td colspan="6" class="text-center">No hay tipos de membresía registrados</td>
            </tr>
        <?php else: ?>
            <?php foreach ($memberships as $membership): ?>
                <tr>
                    <td><?php echo htmlspecialchars($membership['id']); ?></td>
                    <td><?php echo htmlspecialchars($membership['name']); ?></td>
                    
                    <td>$<?php echo number_format($membership['price'], 2); ?></td>
                    
                    <td><?php echo htmlspecialchars($membership['duration_days'] ?? 'N/A'); ?></td>
                    
                    <td><?php echo htmlspecialchars($membership['description']); ?></td>
                    
                    <td class="actions-cell">
                        <a href="/index.php?controller=membership&action=edit&id=<?php echo $membership['id']; ?>" class="btn btn-sm btn-secondary">Editar</a>
                        
                        <a href="/index.php?controller=membership&action=delete&id=<?php echo $membership['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('¿Está seguro de eliminar esta membresía?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>