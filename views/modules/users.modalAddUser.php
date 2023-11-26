<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddUserLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newUserForm" method="post" onsubmit="return validateAddUserForm()" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="off" minlength="2">
                            <div class="invalid-feedback">Por favor, ingrese al menos 2 caracteres para el nombre.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Apellido</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required autocomplete="off" minlength="2">
                            <div class="invalid-feedback">Por favor, ingrese al menos 2 caracteres para el apellido.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                            <div class="invalid-feedback">Por favor, ingrese una dirección de correo electrónico válida.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="typeuser">Tipo de Usuario</label>
                            <select class="form-control" id="typeuser" name="typeuser" required autocomplete="off">
                                <option value="" disabled selected>Selecciona un tipo</option>
                                <?php
                                foreach ($roles as $role) {
                                    echo "<option value= " . $role['id'] . ">" . $role['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione un tipo de usuario.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="off" minlength="4">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">Por favor, ingrese al menos 4 caracteres para la contraseña.</div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_password">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required autocomplete="off">
                                <div class="invalid-feedback" id="passwordMismatchMessage">Las contraseñas no coinciden.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Crear usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>