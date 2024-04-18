<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Factura.php';

// Inicializar la conexión a la base de datos
$db = Database::getConnection();
$factura = new Factura($db);

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedula'] ?? '';
    $monto = $_POST['monto'] ?? 0;

    // Es importante validar y sanitizar las entradas
    $cedula = filter_var($cedula, FILTER_SANITIZE_STRING);
    $monto = filter_var($monto, FILTER_VALIDATE_FLOAT);

    if ($cedula !== false && $monto !== false && $monto > 0) {
        try {
            $resultado = $factura->registrarPago($cedula, $monto);
            $mensaje = "Pago registrado. Total abonado: {$resultado['total_abonado']}, Saldo restante: {$resultado['saldo_restante']}";
        } catch (Exception $e) {
            // Capturar y mostrar el mensaje de error
            $mensaje = "Error al registrar pago: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor, introduzca una cédula válida y un monto mayor a cero.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta y Pago de Facturas</title>
</head>
<body>
    <h1>Consulta y Pago de Facturas</h1>
    <form action="index.php" method="post">
        Número de Cédula: <input type="text" name="cedula" required><br>
        Monto a Pagar: <input type="number" name="monto" step="0.01" required><br>
        <button type="submit">Pagar</button>
    </form>
    <?php if (!empty($mensaje)): ?>
        <p><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>
</body>
</html>
