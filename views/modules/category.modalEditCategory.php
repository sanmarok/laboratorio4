<?php
echo '<button class="btn btn-warning mr-1" data-toggle="modal" data-target="#modalEditType' . $category['id'] . '"><i class="fa-solid fa-pen-to-square"></i></button>';

echo '<div class="modal fade text-left" id="modalEditType' . $category['id'] . '" tabindex="-1" role="dialog" aria-labelledby="modalEditType" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTypeLabel">Editar estado civil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">';
echo "<form id='editUserForm_" . $category['id'] . "' method='post' onsubmit='return validateEditTypeForm(\"" . $category['id'] . "\")' class='needs-validation' novalidate>";
echo '<input type="hidden" id="editUserTypeId_' . $category['id'] . '" name="editUserTypeId" value="' . $category['id'] . '">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="editTypeName_' . $category['id'] . '" name="editTypeName" required autocomplete="off" minlength="2" value="' . $category['name'] . '">
                            <div class="invalid-feedback">Por favor, ingrese al menos 4 caracteres para el nombre.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';
