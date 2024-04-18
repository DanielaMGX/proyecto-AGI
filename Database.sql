-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS facturacion;
USE facturacion;

-- Crear la tabla de facturas
CREATE TABLE IF NOT EXISTS facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(255) NOT NULL,
    monto_total DECIMAL(10, 2) NOT NULL,
    monto_pagado DECIMAL(10, 2) DEFAULT 0.00,
    CONSTRAINT CK_monto CHECK (monto_pagado <= monto_total)
);

-- Insertar datos de ejemplo en la tabla de facturas
INSERT INTO facturas (cedula, monto_total, monto_pagado) VALUES
('123456789', 1000.00, 300.00),
('987654321', 1500.00, 150.00),
('192837465', 2000.00, 0.00);
