<form method="post" action="index.php?controller=app&action=validarUsuario">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" name="correo" id="correo" class="form-control" />
    <label class="form-label" for="correo">Correo Electrónico *</label>
  </div>
  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="text" name="pass" id="pass" class="form-control" />
    <label class="form-label" for="pass">Contraseña *</label>
  </div>
  <!-- Submit button -->
  <input type="submit" value="Enviar" class="btn btn-primary btn-block col-6 mb-4">
</form>
