<?php
echo "<button class='btn btn-info mx-1' data-toggle='modal' data-target='#modalRestorePassword_" . $user['id'] . "' data-user-id='{$user['id']}' id='restorePasswordBtn_" . $user['id'] . "' onclick='validateRestorePasswordForm(\"" . $user['id'] . "\")'><i class='fas fa-key'></i></button>";
echo "<div class='modal fade text-left' id='modalRestorePassword_" . $user['id'] . "' tabindex='-1' role='dialog' aria-labelledby='modalRestorePasswordLabel' aria-hidden='true'>
<div class='modal-dialog modal-xl' role='document'>
<div class='modal-content'>
<div class='modal-header'>
<h5 class='modal-title' id='modalRestorePasswordLabel'>Restaurar Contraseña</h5>
<button type='button' class='close' data-dismiss='modal' aria-label='Cerrar'>
<span aria-hidden='true'>&times;</span>
</button>
</div>
<div class='modal-body'>
<!-- Contenido del formulario de restauración de contraseña -->
<form id='restorePasswordForm_" . $user['id'] . "' method='post' onsubmit='return validateRestorePasswordForm(\"" . $user['id'] . "\")' class='needs-validation' novalidate>
<input type='hidden' id='userIdRestore' name='userIdRestore' value='" . $user['id'] . "'>
<div class='form-row'>
<div class='form-group col-md-6'>
<label for='newPasswordRestore'>Nueva contraseña</label>
<div class='input-group'>
 <input type='password' class='form-control' id='newPasswordRestore_" . $user['id'] . "' name='newPasswordRestore' required autocomplete='off' minlength='4'>
 <div class='input-group-append'>
     <button class='btn btn-outline-secondary' type='button' onclick='togglePassword(\"newPasswordRestore_" . $user['id'] . "\")'>
         <i class='fas fa-eye'></i>
     </button>
 </div>
 <div class='invalid-feedback'>Por favor, ingrese al menos 4 caracteres para la nueva contraseña.</div>
</div>
</div>
<div class='form-group col-md-6'>
<label for='confirmPasswordRestore'>Confirmar nueva contraseña</label>
<div class='input-group'>
 <input type='password' class='form-control' id='confirmPasswordRestore_" . $user['id'] . "' name='confirmPasswordRestore' required autocomplete='off'>
 <div class='input-group-append'>
 </div>
 <div class='invalid-feedback' id='passwordMismatchMessageRestore_" . $user['id'] . "'>Las contraseñas no coinciden.</div>
</div>
</div>
</div>
<div class='modal-footer'>
<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
<button type='submit' class='btn btn-success'>Restaurar Contraseña</button>
</div>
</form>
</div>
</div>
</div>
</div>";
