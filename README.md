# UpTask MVC

Aplicación de gestión de tareas y proyectos desarrollada con PHP 8 siguiendo el patrón de arquitectura MVC (Modelo-Vista-Controlador), con estilos en SASS y envío de correos con PHPMailer.

https://gabrieldev.infinityfreeapp.com/proyecto?id=f527d6773c10834c07b89d7f54182fa9

## Tecnologías

- PHP 8
- MySQL
- SASS / CSS
- JavaScript (Vanilla)
- PHPMailer 7
- Gulp 5
- Composer

## Requisitos previos

- PHP 8 o superior
- MySQL
- Composer
- Node.js y npm

## Instalación local

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/uptask-mvc.git
cd uptask-mvc
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias de Node

```bash
npm install
```

### 4. Configurar la base de datos

Crea una base de datos en MySQL llamada `uptask_mvc` e importa el esquema SQL.

Edita el archivo `includes/database.php` con tus credenciales:

```php
$db = mysqli_connect('localhost', 'tu_usuario', 'tu_password', 'uptask_mvc');
```

### 5. Configurar el servidor de correo

Edita `classes/Email.php` con tus credenciales SMTP (por defecto usa Mailtrap):

```php
$mail->Host     = 'sandbox.smtp.mailtrap.io';
$mail->Username = 'tu_usuario_mailtrap';
$mail->Password = 'tu_password_mailtrap';
```

### 6. Compilar los assets

Para desarrollo (modo watch):

```bash
npm run dev
```

### 7. Iniciar el servidor

Desde la carpeta `public/`:

```bash
php -S localhost:3000
```

Abre tu navegador en `http://localhost:3000`

## Estructura del proyecto

```
UpTask_MVC/
├── classes/            # Clases auxiliares (Email)
├── controllers/        # Controladores MVC
├── includes/           # Configuración (DB, funciones, app)
├── models/             # Modelos y ActiveRecord
├── public/             # Punto de entrada (index.php) y assets compilados
│   └── build/
│       ├── css/
│       ├── js/
│       └── img/
├── src/                # Fuentes SASS y JS sin compilar
│   ├── scss/
│   └── js/
├── vendor/             # Dependencias de Composer
├── views/              # Vistas y templates
│   ├── auth/
│   ├── dashboard/
│   ├── templates/
│   └── layout.php
├── Router.php
├── composer.json
├── gulpfile.js
└── package.json
```

## Funcionalidades

- Registro de usuarios con confirmación por email
- Inicio y cierre de sesión
- Recuperación de contraseña
- Gestión de proyectos (crear, editar, eliminar)
- Gestión de tareas por proyecto
- Perfil de usuario
