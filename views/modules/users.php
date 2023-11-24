<?php
if ($_SESSION['user_type_id'] != 1 && $_SESSION['user_type_id'] != 2) {
    echo '<script>denegatedUser()</script>'; // Asegúrate de salir después de mostrar el SweetAlert
} else {
    $ControllerUsers = new ControllerUsers();
    $users = $ControllerUsers->ctrGetUSers(null, null);
    $roles = $ControllerUsers->ctrGetUserTypes();
    $ControllerUsers->ctrAddUser();
    $ControllerUsers->ctrDeleteUser();
?>
    <div class="card card-primary m-2">
        <div class="card-header">
            <h3 class="card-title">Usuarios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($_SESSION['user_type_id'] == 1) {
                echo ' <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddUser">
                            <i class="nav-icon fas fa-plus"></i>
                        </button>';
            }
            ?>
            <table id="dataTableUsers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo Electrónico</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Ultimo ingreso</th>
                        <th>Tipo</th>
                        <?php
                        if ($_SESSION['user_type_id'] == 1) {
                            echo '<th>Acciones</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) {
                        if ($user['id'] == $_SESSION['id']) {
                            echo "<tr class='bg-teal'>";
                        } else {
                            echo "<tr>";
                        }

                        echo "<td>{$user['id']}</td>";
                        echo "<td>{$user['name']}</td>";
                        echo "<td>{$user['last_name']}</td>";
                        echo "<td>{$user['email']}</td>";
                        echo "<td>{$user['status']}</td>";
                        echo "<td>{$user['creation_date']}</td>";
                        echo "<td>{$user['last_login_date']}</td>";
                        echo "<td>{$user['typeuser']}</td>";

                        if ($_SESSION['user_type_id'] == 1) {
                            echo "<td><div class='text-center'>";
                            if ($_SESSION['id'] == $user['id']) {
                                echo "<button class='btn btn-info mr-1'><i class='fas fa-key'></i></button>";
                            }
                            if ($user['user_type_id'] != 1) {
                                echo "<button class='btn btn-info mr-1'><i class='fas fa-key'></i></button>";
                                switch ($user['status']) {
                                    case 'active':
                                        echo "<button class='btn btn-outline-secondary mr-1' onclick='confirmChangeStatus(this, \"{$user['id']}\", \"inactive\")'><i class='fas fa-power-off'></i></button>";
                                        break;
                                    case 'inactive':
                                        echo "<button class='btn btn-outline-success mr-1' onclick='confirmChangeStatus(this, \"{$user['id']}\", \"active\")'><i class='fas fa-power-off'></i></button>";
                                        break;
                                }
                                echo '<button type="button" class="btn btn-danger" onclick="confirmDeleteUser(this)"><i class="fas fa-trash"></i></button>';
                                echo '<form id="deleteForm" method="post" style="display: none;">
                            <input type="hidden" name="delete_user_id" value="' . $user['id'] . '">
                        </form></div>';
                            }
                        }
                        echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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
                                    <option value="" disabled selected>Selecciona un rol</option>
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



<?php
}
?>