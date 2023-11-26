<div class="modal fade" id="modalAddType" tabindex="-1" role="dialog" aria-labelledby="modalAddType" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTypeLabel">Agregar tipo de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newUserType" method="post" onsubmit="return validateAddTypeForm()" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="typename" name="typename" required autocomplete="off" minlength="2">
                            <div class="invalid-feedback">Por favor, ingrese al menos 4 caracteres para el nombre.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Crear tipo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>