<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '../../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Ingresa tu nuevo Password</p>
        <?php include_once __DIR__ . '../../templates/alertas.php'; ?>
        <?php if ($mostrar) { ?>

            <form method="POST" class="formulario">
                <div class="campo">
                    <label for="password">Password</label>
                    <input type="password"
                        id="password"
                        placeholder="Escribe tu password"
                        name="password" />
                </div>
                <div class="campo">
                    <label for="password2"> Confirma tu Password</label>
                    <input type="password"
                        id="password2"
                        placeholder="Confirma tu password"
                        name="password2" />
                </div>

                <input type="submit" class="boton" value="Guardar Password">
            </form>
        <?php } ?>
        <div class="acciones">
            <a href="/">¿Ya tiene cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>

    </div><!--Contenedor SM -->
</div>