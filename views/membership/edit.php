<?php
/**
 * Vista: Editar Membresía
 * * CLIENTE: Formulario que muestra datos de la membresía y permite editarlos
 */

require_once __DIR__ . '/../layouts/header.php';
?>

<h2>Editar Membresía</h2>

<form method="POST" action="/index.php?controller=membership&action=update" class="form">
    
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($membership['id']); ?>">
    
    <div class="form-group">
        <label for="name">Nombre *</label>
        <input type="text" id="name" name="name" required 
               value="<?php echo htmlspecialchars($_POST['name'] ?? $membership['name']); ?>"
               class="<?php echo isset($errors['name']) ? 'error' : ''; ?>">
        <?php if (isset($errors['name'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['name']); ?></span>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="price">Precio *</label>
        <input type="number" step="0.01" id="price" name="price" required 
               value="<?php echo htmlspecialchars($_POST['price'] ?? $membership['price']); ?>"
               class="<?php echo isset($errors['price']) ? 'error' : ''; ?>">
        <?php if (isset($errors['price'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['price']); ?></span>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="duration_days">Días de duración</label>
        <input type="number" id="duration_days" name="duration_days" 
               value="<?php echo htmlspecialchars($_POST['duration_days'] ?? $membership['duration_days']); ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Descripción *</label>
        <input type="text" id="description" name="description" required 
               value="<?php echo htmlspecialchars($_POST['description'] ?? $membership['description']); ?>"
               class="<?php echo isset($errors['description']) ? 'error' : ''; ?>">
        <?php if (isset($errors['description'])): ?>
            <span class="error-message"><?php echo htmlspecialchars($errors['description']); ?></span>
        <?php endif; ?>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="/index.php?controller=membership&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>