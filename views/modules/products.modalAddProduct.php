<div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddProductLabel">Agregar Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newProductForm" method="post" onsubmit="return validateAddProductForm()" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productName">Nombre del Producto</label>
                            <input type="text" class="form-control" id="productName" name="productName" required autocomplete="off" minlength="2">
                            <div class="invalid-feedback">Por favor, ingrese al menos 2 caracteres para el nombre del producto.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Categoría</label>
                            <select class="form-control" id="category" name="category" required>
                                <?php
                                foreach ($categorys as $category) {
                                    echo "<option value=" . $category['id'] . ">" . $category['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione una categoría.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price">Precio</label>
                            <input type="number" class="form-control" id="price" name="price" required step="0.01" min="0">
                            <div class="invalid-feedback">Por favor, ingrese un precio válido.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="stock">Stock</label>
                            <input type="number" pattern="\d+(\.\d{1,2})?" class="form-control" id="stock" name="stock" required step="0.01" min="0">
                            <div class="invalid-feedback">Por favor, ingrese una cantidad de stock válida.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="imagePath">Imagen del Producto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagePath" name="imagePath" required accept="image/*">
                                    <label class="custom-file-label" for="imagePath">Seleccionar archivo</label>
                                </div>
                            </div>
                            <div class="invalid-feedback">Por favor, seleccione una imagen válida.</div>
                            <small class="form-text text-muted">El archivo debe ser una imagen (JPEG, PNG, etc.) y no debe pesar más de 1 MB.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Estado</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione un estado.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Agregar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>