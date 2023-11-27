<?php
$ControllerClients = new ControllerClients();
$clients = $ControllerClients->ctrGetClients();
$maritalStatus = $ControllerClients->ctrGetMaritalStatus();
$today = new DateTime();
$ControllerClients->ctrAddClient();
$ControllerClients->ctrDeleteClient();
$ControllerClients->ctrEditClient();
?>
<div class="card card-primary m-2">
    <div class="card-header">
        <h3 class="card-title">Clientes</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php
        if ($_SESSION['user_type_id'] == 1) {
            echo ' <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddClient">
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
                    <th>Documento</th>
                    <th>Fecha de nacimiento</th>
                    <th>Edad</th>
                    <th>Estado civil</th>
                    <th>Fecha de creación</th>
                    <?php
                    if ($_SESSION['user_type_id'] == 1) {
                        echo '<th>Acciones</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clients as $client) {
                    echo "<tr>";
                    echo "<td>{$client['id']}</td>";
                    echo "<td>{$client['name']}</td>";
                    echo "<td>{$client['last_name']}</td>";
                    echo "<td>{$client['email']}</td>";
                    echo "<td>{$client['dni']}</td>";
                    echo "<td>{$client['birth_date']}</td>";
                    $birthdate = DateTime::createFromFormat('d/m/Y', $client['birth_date']);
                    $age = $today->diff($birthdate);
                    echo "<td>{$age->y}</td>";
                    echo "<td>{$client['marital_status_name']}</td>";
                    echo "<td>{$client['creation_date']}</td>";

                    if ($_SESSION['user_type_id'] == 1) {
                        echo "<td><div class='text-center'>";
                        include 'clients.modalEditClient.php';
                        //Boton de borrar
                        echo '<button type="button" class="btn btn-danger mx-1 " onclick="confirmDeleteClient(this)"><i class="fas fa-trash"></i></button>';
                        // Formulario para borrar usuario
                        echo '<form id="deleteClientForm' . $client['id'] . '" method="post" style="display: none;">
                            <input type="hidden" name="delete_client_id" value="' . $client['id'] . '">
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
include 'clients.modalAddClient.php';
?>