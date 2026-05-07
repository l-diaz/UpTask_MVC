<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver a Perfil</a>

    <form action="/cambiar-password" class="formulario" method="POST">
        <div class="campo">
            <label for="password">Password Actual</label>
            <input
                type="password"
                name="password_actual"
                placeholder="Tu password Actual" />
        </div>
        <div class="campo">
            <label for="password">Nuevo Password</label>
            <input
                type="password"
                name="password_nuevo"
                placeholder="Tu Nuevo password" />
        </div>

        <input type="submit" class="boton" value="Actualizar Password">

    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>