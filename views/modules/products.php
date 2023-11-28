<?php
$ControllerProducts = new ControllerProducts;
$categorys = $ControllerProducts->ctrGetCategorys();
$products = $ControllerProducts->ctrGetProducts();
$ControllerProducts->ctrAddProduct();
$ControllerProducts->ctrChangeProductStatus();
$ControllerProducts->ctrDeleteProduct();
?>
<div class="card card-primary m-2">
    <div class="card-header">
        <h3 class="card-title">Productos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <?php
        if ($_SESSION['user_type_id'] == 1) {
            echo ' <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalAddProduct">
                            <i class="nav-icon fas fa-plus"></i>
                        </button>';
        }
        ?>
        <table id="dataTableUsers" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Detalle</th>
                    <?php
                    if ($_SESSION['user_type_id'] == 1) {
                        echo '<th>Acciones</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>{$product['id']}</td>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td>{$product['category_name']}</td>";
                    include 'products.modalInfoProducts.php';
                    if ($_SESSION['user_type_id'] == 1) {
                        echo "<td><div class='text-center'>";
                        switch ($product['status']) {
                            case 'inactive':
                                echo "<button class='btn btn-secondary mx-1' onclick='confirmChangeStatusProducts(this, \"{$product['id']}\", \"active\")'><i class='fas fa-power-off'></i></button>";
                                break;
                            case 'active':
                                echo "<button class='btn btn-success mx-1' onclick='confirmChangeStatusProducts(this, \"{$product['id']}\", \"inactive\")'><i class='fas fa-power-off'></i></button>";
                                break;
                        }
                        // Formulario para cambiar estado
                        echo '<form id="changeStatusForm' . $product['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="change_status_user_id" value="' . $product['id'] . '">
                                    <input type="hidden" name="new_status" value="">
                                </form>';
                        echo '<button type="button" class="btn btn-danger mx-1 " onclick="confirmDeleteUser(this)"><i class="fas fa-trash"></i></button>';
                        // Formulario para borrar usuario
                        echo '<form id="deleteForm' . $product['id'] . '" method="post" style="display: none;">
                                    <input type="hidden" name="delete_user_id" value="' . $product['id'] . '">
                                </form>';
                    }
                    echo "</div></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include 'products.modalAddProduct.php';
?>