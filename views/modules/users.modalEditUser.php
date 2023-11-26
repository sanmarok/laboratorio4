<?php
echo "<button class='btn btn-warning mx-1' data-toggle='modal' data-target='#modalEditUser_" . $user['id'] . "' data-user-id='{$user['id']}' id='editUserBtn_" . $user['id'] . ")'><i class='fas fa-edit'></i></button>";

echo "
<div class='modal fade text-left' id='modalEditUser_" . $user['id'] . "' tabindex='-1' role='dialog' aria-labelledby='modalEditUserLabel_" . $user['id'] . "' aria-hidden='true'>
    <div class='modal-dialog modal-xl' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='modalEditUserLabel_" . $user['id'] . "'>Editar Usuario</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <form id='editUserForm_" . $user['id'] . "' method='post' onsubmit='return validateEditUserForm(\"" . $user['id'] . "\")' class='needs-validation' novalidate>
                    <!-- Agregar un campo oculto para almacenar el ID del usuario -->
                    <input type='hidden' id='editUserId_" . $user['id'] . "' name='editUserId' value='" . $user['id'] . "'>

                    <div class='form-row'>
                        <div class='form-group col-md-6'>
                            <label for='editName_" . $user['id'] . "' class='text-left'>Nombre</label>
                            <input type='text' class='form-control' id='editName_" . $user['id'] . "' name='editName' required autocomplete='off' minlength='2' value='" . $user['name'] . "'>
                            <div class='invalid-feedback'>Por favor, ingrese al menos 2 caracteres para el nombre.</div>
                        </div>
                        <div class='form-group col-md-6'>
                            <label for='editLastName_" . $user['id'] . "' class='text-left'>Apellido</label>
                            <input type='text' class='form-control' id='editLastName_" . $user['id'] . "' name='editLastName' required autocomplete='off' minlength='2' value='" . $user['last_name'] . "'>
                            <div class='invalid-feedback'>Por favor, ingrese al menos 2 caracteres para el apellido.</div>
                        </div>
                    </div>

                    <div class='form-row'>
                        <div class='form-group col-md-6'>
                            <label for='editEmail_" . $user['id'] . "' class='text-left'>Correo Electrónico</label>
                            <input type='email' class='form-control' id='editEmail_" . $user['id'] . "' name='editEmail' required autocomplete='off' value='" . $user['email'] . "'>
                            <div class='invalid-feedback'>Por favor, ingrese una dirección de correo electrónico válida.</div>
                        </div>
                        <div class='form-group col-md-6'>";
if ($user['id'] == 1) {
    echo "<input type='hidden' id='editTypeUser_" . $user['id'] . "' name='editTypeUser' value='1'>";
} else {
    echo "                            <label for='editTypeUser_" . $user['id'] . "' class='text-left'>Tipo de Usuario</label>
    <select class='form-control' id='editTypeUser_" . $user['id'] . "' name='editTypeUser' required autocomplete='off'>";
    echo "                                <option value='' disabled selected>Selecciona un tipo</option>";
    foreach ($roles as $role) {
        $selected = ($role['id'] == $user['user_type_id']) ? 'selected' : '';
        echo "<option value='" . $role['id'] . "' $selected>" . $role['name'] . "</option>";
    }
    echo "";
}
echo "</select>
                            <div class='invalid-feedback'>Por favor, seleccione un tipo de usuario.</div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
                        <button type='submit' class='btn btn-success'>Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>";
