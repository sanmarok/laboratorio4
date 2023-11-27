<?php
echo '<button class="btn btn-warning mr-1" data-toggle="modal" data-target="#modalEditType' . $rol['id'] . '"><i class="fa-solid fa-pen-to-square"></i></button>';

echo '<div class="modal fade text-left" id="modalEditType' . $rol['id'] . '" tabindex="-1" role="dialog" aria-labelledby="modalEditType" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTypeLabel">Editar tipo de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserType_' . $rol['id'] . '" method="post" onsubmit="return validateEditTypeForm(' . $rol['id'] . ');" class="needs-validation" novalidate>
                    <input type="hidden" id="editUserTypeId_' . $rol['id'] . '" name="editUserTypeId" value="' . $rol['id'] . '">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="editTypeName' . $rol['id'] . '" name="editTypeName" required autocomplete="off" minlength="2" value="' . $rol['name'] . '">
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
