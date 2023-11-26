<?php
if ($_SESSION['user_type_id'] != 1 && $_SESSION['user_type_id'] != 2) {
    echo '<script>denegatedUser()</script>'; // Asegúrate de salir después de mostrar el SweetAlert
} else {
    $ControllerUsers = new ControllerUsers();
    $roles = $ControllerUsers->ctrGetUserTypes();
    $ControllerUsers->ctrDeleteUserType();
?>
    <div class="card card-primary m-2">
        <div class="card-header">
            <h3 class="card-title">Tipos de usuarios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($_SESSION['user_type_id'] == 1) {
                echo ' <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddType">
                            <i class="nav-icon fas fa-plus"></i>
                        </button>';
            }
            ?>
            <table id="dataTableUsers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <?php
                        if ($_SESSION['user_type_id'] == 1) {
                            echo '<th>Acciones</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<tr>";
                        echo "<td>{$rol['id']}</td>";
                        echo "<td>{$rol['name']}</td>";
                        if ($_SESSION['user_type_id'] == 1) {
                            if ($rol['id'] != 1) {
                                echo "<td><div class='text-center'>";
                                echo '<button class="btn btn-info mr-1 "><i class="fa-solid fa-pen-to-square"></i></button>';
                                echo '<button type="button" class="btn btn-danger" onclick="confirmDeleteUserType(this)"><i class="fas fa-trash"></i></button>';
                                // Formulario para borrar usuario
                                echo '<form id="deleteUserType' . $rol['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="delete_user_type_id" value="' . $rol['id'] . '">
                                </form>';
                                echo "</div></td></tr>";
                            } else {
                                echo "<td></td></tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    include 'userstypes.modalAddType.php';
}
