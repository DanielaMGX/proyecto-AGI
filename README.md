# Proyecto VozIP

Este es un sistema de gestión de facturas para el proyecto VozIP.

## Requisitos

Para ejecutar este proyecto, necesitas tener instalado XAMPP o un entorno de servidor PHP con MySQL/MariaDB.

## Instalación de XAMPP

Sigue estos pasos para instalar XAMPP:

1. Descarga XAMPP desde el sitio oficial: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
2. Ejecuta el instalador y sigue las instrucciones.
3. Abre el panel de control de XAMPP y arranca los módulos `Apache` y `MySQL`.
4. (Opcional) Si deseas que XAMPP se ejecute como un servicio, marca las casillas correspondientes en el panel de control.

## Configuración de la Base de Datos

Para configurar la base de datos para este proyecto, sigue estos pasos:

1. Abre el `phpMyAdmin` accediendo a `http://localhost/phpmyadmin` en tu navegador.
2. Crea una nueva base de datos llamada `facturacion`.
3. Importa el esquema de la base de datos proporcionado en el archivo `Database.sql` incluido en este proyecto.
4. Verifica que las tablas se hayan creado correctamente.

## Configuración del Proyecto

Para configurar el proyecto, sigue estos pasos:

1. Clona este repositorio en la carpeta `htdocs` de tu instalación de XAMPP.
2. Navega a la carpeta del proyecto desde tu terminal y ejecuta `composer install` para instalar las dependencias de PHP (si se utiliz
