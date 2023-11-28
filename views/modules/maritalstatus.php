<?php
if ($_SESSION['user_type_id'] != 1 && $_SESSION['user_type_id'] != 2) {
    echo '<script>denegatedUser()</script>'; // Asegúrate de salir después de mostrar el SweetAlert
} else {
    $ControllerClients = new ControllerClients();
    $roles = $ControllerClients->ctrGetMaritalStatus();
    $ControllerClients->ctrDeleteMaritalStatus();
    $ControllerClients->ctrAddMaritalStatus();
    $ControllerClients->ctrEditMaritalStatus();
?>
    <div class="card card-primary m-2">
        <div class="card-header">
            <h3 class="card-title">Estados maritales</h3>
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

                            echo "<td><div class='text-center'>";
                            include "maritalstatus.modalEditMaritalStatus.php";

                            echo '<button type="button" class="btn btn-danger" onclick="confirmDeleteUserType(this)"><i class="fas fa-trash"></i></button>';
                            // Formulario para borrar usuario
                            echo '<form id="deleteUserType' . $rol['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="delete_user_type_id" value="' . $rol['id'] . '">
                                </form>';
                            echo "</div></td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    include 'maritalstatus.modalAddMaritalStatus.php';
}
