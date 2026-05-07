<?php

namespace Model;

use Model\ActiveRecord;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //validar el login del usuario
    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El email del usuario es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "La contraseña debe tener al menos 6 caracteres";
        }
        return self::$alertas;
    }
    // validar cuentas nuevas
    public function validarNuevasCuenta()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El nombre del usuario es obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El email del usuario es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "La contraseña es obligatoria";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "La contraseña debe tener al menos 6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Las contraseñas no son iguales";
        }
        return self::$alertas;
    }

    public function validar_Perfil()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = "El Nombre es obligatorio";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "El Email es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }

        return self::$alertas;
    }

    public function nuevo_password(): array
    {
        if (!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }
        if (strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    //comprobar el password
    public function comprobarPassword(): bool
    {
        return password_verify($this->password_actual, $this->password);
    }

    //para hashear el password 
    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //generar un token para validar cuenta
    public function crearToken(): void
    {
        $this->token = uniqid();
    }
    //validar un email
    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['error'][] = "El email del usuario es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "Email no válido";
        }
        return self::$alertas;
    }
    //validar el nuevo password
    public function validarPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = "El password no puede ir vacio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "La contraseña debe tener al menos 6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Las contraseñas no son iguales";
        }
        return self::$alertas;
    }
}
