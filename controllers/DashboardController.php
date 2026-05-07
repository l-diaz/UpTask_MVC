<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;


class DashboardController
{
    public static function index(Router $router)
    {
        $alertas = [];
        session_start();
        isAuth();

        $proyectos = Proyecto::belongsTo('propietarioId', $_SESSION['id']);

        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'alertas' => $alertas,
            'proyectos' => $proyectos
        ]);
    }

    public static function crear_proyecto(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);
            $alertas = $proyecto->validarProyecto();

            if (empty($alertas)) {
                //generar una url unica
                $hash = md5(uniqid());
                $proyecto->url = $hash;
                //almacenar el creador del proyceto
                $proyecto->propietarioId = $_SESSION['id'];
                //guardar el proyecto
                $proyecto->guardar();
                //redireccionar 
                header('Location: /proyecto?id=' . $proyecto->url);
            }
        }

        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router)
    {
        session_start();
        $alertas = [];
        isAuth();

        $token = $_GET['id'];
        if (!$token) header('Location: /dashboard');
        //revisar que el propio usuario pueda acceder a sus proyectos
        $proyecto = Proyecto::where('url', $token);
        if ($proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }


        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto,
            'alertas' => $alertas
        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        $alertas = [];
        isAuth();

        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_perfil();

            if (empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);

                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    // mensaje de error
                    Usuario::setAlerta('error', 'El email ya está en uso');
                } else {
                    //guardar el nuevo nombre y email
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Guardado Correctamente');

                    //asignar el nombre nuevo a la sesion
                    $_SESSION['nombre'] = $usuario->nombre;
                }

                $alertas = $usuario->getAlertas();
            }
        }

        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function cambiar_password(Router $router)
    {
        session_start();
        $alertas = [];
        isAuth();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();

            if (empty($alertas)) {
                $resultado = $usuario->comprobarPassword();

                if ($resultado) {
                    //asignar el nuevo password
                    $usuario->password = $usuario->password_nuevo;
                    //eliminar password2 y password_nuevo
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    //hashear el nuevo password
                    $usuario->hashPassword();
                    //guardar el nuevo password
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        Usuario::setAlerta('exito', 'Password Guardado Correctamente');
                    }
                } else {
                    Usuario::setAlerta('error', 'El password actual es incorrecto');
                }
                $alertas = $usuario->getAlertas();
            }
        }

        $router->render('dashboard/cambiar_password', [
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
    }
}
