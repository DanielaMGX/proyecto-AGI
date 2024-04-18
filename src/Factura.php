<?php

class Factura {
    private $db;

    // Constructor que acepta una conexión PDO y la almacena en una propiedad privada
    public function __construct($db) {
        $this->db = $db;
    }

    // Método público para registrar pagos en una factura
    public function registrarPago($cedula, $monto) {
        // Comienza una transacción para garantizar la atomicidad de la operación
        $this->db->beginTransaction();

        try {
            $sql = "UPDATE facturas SET monto_pagado = monto_pagado + :monto WHERE cedula = :cedula AND monto_pagado + :monto <= monto_total";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':cedula', $cedula);

            if (!$stmt->execute()) {
                // Si la ejecución falla, lanzar una excepción
                throw new Exception("No se pudo registrar el pago.");
            }

            // Si el pago se registró correctamente, obtener los detalles actualizados de la factura
            $facturaActualizada = $this->obtenerFactura($cedula);
            
            // Confirmar la transacción
            $this->db->commit();

            return $facturaActualizada;
        } catch (Exception $e) {
            // En caso de cualquier excepción, revertir la transacción
            $this->db->rollBack();
            // Lanzar la excepción para que pueda ser manejada en una capa superior
            throw $e;
        }
    }

    // Método privado para obtener los detalles actualizados de una factura
    private function obtenerFactura($cedula) {
        $sql = "SELECT monto_total, monto_pagado FROM facturas WHERE cedula = :cedula";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        $factura = $stmt->fetch();

        if ($factura) {
            // Calcular el saldo restante y devolverlo junto con el total abonado
            return [
                'total_abonado' => $factura['monto_pagado'],
                'saldo_restante' => $factura['monto_total'] - $factura['monto_pagado']
            ];
        } else {
            // Si no se encuentra la factura, lanzar una excepción
            throw new Exception("Factura no encontrada para la cédula proporcionada.");
        }
    }
}
