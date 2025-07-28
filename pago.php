<?php
session_start();

// Catálogo de productos (referencia para nombre y precio)
$catalogo = [
    1 => ['nombre' => 'Audífonos Bluetooth', 'precio' => 25000],
    2 => ['nombre' => 'Mouse Inalámbrico', 'precio' => 15000],
    3 => ['nombre' => 'Teclado Mecánico', 'precio' => 45000]
];

// Verifica si el carrito existe
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h2>⚠️ Tu carrito está vacío.</h2>";
    echo '<a href="productos.php">Volver a la tienda</a>';
    exit;
}

// Calcular total
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f9f9f9; }
        table { border-collapse: collapse; width: 60%; margin-bottom: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        .btn { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h2>Confirmación de tu pedido</h2>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['carrito'] as $id => $cantidad): ?>
            <?php if (isset($catalogo[$id])): ?>
                <?php
                    $producto = $catalogo[$id];
                    $subtotal = $producto['precio'] * $cantidad;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td>$<?= number_format($producto['precio'], 0, ',', '.') ?></td>
                    <td><?= $cantidad ?></td>
                    <td>$<?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total a pagar: $<?= number_format($total, 0, ',', '.') ?></h3>

<!-- Formulario que simula el proceso de pago -->
<form action="pago_realizado.php" method="POST">
    <input type="hidden" name="monto" value="<?= $total ?>">
    <button class="btn" type="submit">Pagar ahora</button>
</form>

<br>
<a href="carrito.php">← Volver al carrito</a>

</body>
</html>
