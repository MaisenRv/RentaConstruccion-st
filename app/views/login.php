<div class="login-container">
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form action="#">
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" placeholder="Correo Electrónico" class="login-input">
                <span class="icon">📧</span>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Contraseña" class="login-input">
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
        <form action="#">
            <div class="input-group">
                <label for="razon_s">Razon social</label>
                <input type="text" id="razon_s" placeholder="Razon social">
            </div>
            <div class="input-group">
                <label for="email-reg">Correo Electrónico</label>
                <input type="email" id="email-reg" placeholder="Correo Electrónico">
            </div>
            <div class="input-group">
                <label for="password-reg">Contraseña</label>
                <input type="password" id="password-reg" placeholder="Contraseña">
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" placeholder="Confirmar Contraseña">
            </div>
            <div class="input-group">
                <label for="Direccion">Direccion</label>
                <input type="text" id="Direccion" placeholder="Direccion">
            </div>
            <div class="input-group">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" placeholder="Telefono">
            </div>
            <div class="input-group">
                <label for="localidad">Localidad</label>
                <select name="localidad" id="localidad">
                    <?PHP foreach ($localidades as $l) { ?>
                        <option value="<?PHP echo $l->getCodigoLocalidad() ?>"><?PHP echo $l->getNombreLocalidad(); ?></option>
                    <?PHP }; ?>
                </select>
            </div>
            <div class="input-group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol">
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