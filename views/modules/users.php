<?php
if ($_SESSION['user_type_id'] != 1 && $_SESSION['user_type_id'] != 2) {
    echo '<script>denegatedUser()</script>'; // Asegúrate de salir después de mostrar el SweetAlert
} else {
    $ControllerUsers = new ControllerUsers();
    $users = $ControllerUsers->ctrGetUSers(null, null);
    $roles = $ControllerUsers->ctrGetUserTypes();
    $ControllerUsers->ctrAddUser();
    $ControllerUsers->ctrDeleteUser();
    $ControllerUsers->ctrChangeUserStatus();
    $ControllerUsers->ctrRestorePassword();
    $ControllerUsers->ctrEditUser();
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
                                include 'views/modules/users.modalRestorePassword.php';
                                include 'views/modules/users.modalEditUser.php';
                            }
                            if ($user['user_type_id'] != 1) {
                                include 'views/modules/users.modalRestorePassword.php';
                                include 'views/modules/users.modalEditUser.php';
                                switch ($user['status']) {
                                    case 'inactive':
                                        echo "<button class='btn btn-secondary mx-1' onclick='confirmChangeStatus(this, \"{$user['id']}\", \"active\")'><i class='fas fa-power-off'></i></button>";
                                        break;
                                    case 'active':
                                        echo "<button class='btn btn-success mx-1' onclick='confirmChangeStatus(this, \"{$user['id']}\", \"inactive\")'><i class='fas fa-power-off'></i></button>";
                                        break;
                                }
                                // Formulario para cambiar estado
                                echo '<form id="changeStatusForm' . $user['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="change_status_user_id" value="' . $user['id'] . '">
                                    <input type="hidden" name="new_status" value="">
                                </form>';
                                echo '<button type="button" class="btn btn-danger mx-1 " onclick="confirmDeleteUser(this)"><i class="fas fa-trash"></i></button>';
                                // Formulario para borrar usuario
                                echo '<form id="deleteForm' . $user['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="delete_user_id" value="' . $user['id'] . '">
                                </form>';
                            }
                            echo "</div></td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    include 'users.modalAddUser.php';
}
?>