<div class="login-container">
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="index.php?action=login" id="formLogin">
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="login-input">
                <span class="icon">📧</span>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" class="login-input">
                <span class="icon">🔒</span>
            </div>
            <div class="options">
                <!-- <label><input type="checkbox"> Recuérdame</label> -->
                <!-- <a href="#" id="forgot-password-link">¿Olvidaste tu contraseña?</a> -->
            </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
            <p class="register">¿No tienes una cuenta? <a href="#" id="register-link">Regístrate</a></p>
        </form>
    </div>
</div>


<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-register-modal">&times;</span>
        <h2>Registro</h2>
        <form action="#" id="fromRegistro">
            <div class="input-group">
                <label for="razonSocial">Razon social</label>
                <input type="text" id="razon_s" name="razonSocial" placeholder="Razon social" required>
            </div>
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email-reg" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="input-group">
                <label for="constraseña-reg">Contraseña</label>
                <input type="password" id="password-reg" name="constraseña" placeholder="Contraseña" required>
            </div>
            <div class="input-group">
                <label for="confirmarContraseña">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" name="confirmarContraseña" placeholder="Confirmar Contraseña" required>
            </div>
            <div class="input-group">
                <label for="direccion">Direccion</label>
                <input type="text" id="Direccion" name="direccion" placeholder="Direccion" required>
            </div>
            <div class="input-group">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Telefono" required>
            </div>
            <div class="input-group">
                <label for="localidad">Localidad</label>
                <select name="localidad" id="localidad" required>
                    <option value="0">Seleccionar localidad</option>
                    <?PHP foreach ($localidades as $l) { ?>
                        <option value="<?PHP echo $l->getCodigoLocalidad() ?>"><?PHP echo $l->getNombreLocalidad(); ?></option>
                    <?PHP }; ?>
                </select>
            </div>
            <div class="input-group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" required>
                    <option value="0">Seleccionar un Rol</option>
                    <?PHP foreach ($roles as $r) { ?>
                        <option value="<?PHP echo $r->getCodigoRol() ?>"><?PHP echo $r->getRol(); ?></option>
                    <?PHP }; ?>
                </select>
            </div>
            <button type="submit" class="register-btn">Registrarse</button>
        </form>
    </div>
</div>


<div id="forgot-password-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-forgot-modal">&times;</span>
        <h2>Recuperar Contraseña</h2>
        <form id="forgot-password-form">
            <div class="input-group">
                <label for="email-forgot">Correo Electrónico</label>
                <input type="email" id="email-forgot" placeholder="Ingresa tu correo electrónico" required>
            </div>
            <button type="submit" class="send-btn">Enviar</button>
            <p id="email-sent-message" style="display:none; color: green;">¡Correo de recuperación enviado!</p>
        </form>
    </div>
</div>