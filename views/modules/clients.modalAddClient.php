<div class="modal fade" id="modalAddClient" tabindex="-1" role="dialog" aria-labelledby="modalAddClientLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddClientLabel">Agregar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newClientForm" method="post" onsubmit="return validateAddClientForm()" class="needs-validation" novalidate>
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
                            <label for="marital_status">Estado civil</label>
                            <select class="form-control" id="marital_status" name="marital_status" required autocomplete="off">
                                <option value="" disabled selected>Selecciona un estado civil</option>
                                <?php
                                foreach ($maritalStatus as $status) {
                                    echo "<option value=" . $status['id'] . ">" . $status['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione un estado civil.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dni">Documento de Identidad</label>
                            <input type="text" class="form-control" id="dni" name="dni" required autocomplete="off" oninput="validateDNI(this)">
                            <div class=" invalid-feedback">Por favor, ingrese un documento de identidad válido.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="birth_date">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required autocomplete="off">
                            <div class="invalid-feedback">Por favor, ingrese una fecha de nacimiento válida.</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Crear cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>