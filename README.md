README: Aplicación Web de Gestor de Contactos

Descripción del Proyecto

Esta aplicación web, desarrollada con Laravel y utilizando Lando para la configuración del entorno, permite la gestión de contactos mediante el consumo de APIs REST de Oracle Service Cloud. Las principales funcionalidades incluyen:

Consultar contactos existentes (por ciudad, nombre, correo y teléfono).

Crear nuevos contactos.

Eliminar contactos existentes.

Almacenar los resultados de consultas en una base de datos local para acceso offline.

Nota: La funcionalidad de edición de contactos no está disponible debido a problemas con el endpoint REST proporcionado.

Tecnologías Utilizadas

Framework: Laravel

Gestor de Entornos: Lando

Frontend: Blade, AJAX, Bootstrap

Control de Versiones: Git (Git Workflow)

Base de Datos: MySQL (integrada en Lando)

Requisitos Previos

Antes de instalar y ejecutar la aplicación, asegúrate de tener instalados:

Lando: Guía de Instalación de Lando

Git: Guía de Instalación de Git

Navegador Web: Preferiblemente Google Chrome o Firefox.

Instalación

Sigue estos pasos para configurar y ejecutar la aplicación en tu entorno local:

1. Clonar el Repositorio

Clona el repositorio desde GitHub usando el siguiente comando:

git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_REPOSITORIO>

2. Configurar el Entorno de Lando

Crea y configura el archivo .lando.yml en el directorio del proyecto. Este archivo ya está incluido en el repositorio y define los servicios necesarios (PHP, MySQL, etc.).

Ejecuta el siguiente comando para iniciar los servicios:

lando start

Esto generará la URL local y los puertos necesarios para acceder a la aplicación.

3. Instalar Dependencias de PHP

Instala las dependencias necesarias de Laravel mediante Composer (incluido en Lando):

lando composer install

4. Configurar el Archivo .env

Copia el archivo .env.example y renómbralo como .env:

cp .env.example .env

Actualiza las variables de entorno en el archivo .env para que coincidan con la configuración de tu base de datos. Por ejemplo:

DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=lando
DB_USERNAME=lando
DB_PASSWORD=lando

5. Generar la Key de la Aplicación

Ejecuta el siguiente comando para generar una key única para la aplicación:

lando artisan key:generate

6. Migrar la Base de Datos

Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

lando artisan migrate

7. Ejecutar la Aplicación

Inicia el servidor de desarrollo de Laravel:

lando artisan serve

Accede a la aplicación a través de la URL generada, normalmente http://localhost:8000 o el puerto configurado por Lando.

Uso de la Aplicación

Consultar Contactos: Usa el formulario en la página principal para buscar contactos por ciudad, nombre, correo o teléfono. Los resultados se mostrarán en una tabla.

Crear Nuevos Contactos: Completa el formulario de creación y envíalo para agregar un nuevo contacto.

Eliminar Contactos: Utiliza el botón de eliminar asociado a cada contacto en la tabla de resultados.

Persistencia Offline: Si el servicio REST no está disponible, los últimos resultados consultados se cargarán desde la base de datos local.

Manejo de Errores

Se implementaron mensajes claros para el usuario en caso de errores en las llamadas al API REST.

Los errores del sistema se registran en el archivo storage/logs/laravel.log.

Estructura del Proyecto

app/Http/Controllers: Contiene los controladores para manejar las solicitudes del usuario.

app/Services: Lógica para el consumo de las APIs REST.

resources/views: Plantillas Blade para el frontend.

public/js: Scripts JavaScript para manejar las llamadas AJAX.

Control de Versiones

El proyecto utiliza Git Workflow con las siguientes ramas principales:

main: Contiene la versión estable del código.

develop: Rama de desarrollo activa.

feature/: Ramas para implementar nuevas funcionalidades.

Asegúrate de realizar PRs hacia la rama develop antes de fusionar cambios.

Problemas Conocidos

Endpoint de Edición: El API REST para la actualización de contactos no funcionó durante el desarrollo, por lo que esta funcionalidad no está disponible.

Autores

Proyecto desarrollado por [Tu Nombre/Equipo].

Contacto

Para cualquier duda o comentario, por favor contacta a: [panqueva763@gmail.com].
