<?php
echo '<button class="btn btn-warning mx-1" data-toggle="modal" data-target="#modalEditClient_' . $client['id'] . '" data-user-id="' . $client['id'] . '" id="editClientBtn_' . $client['id'] . '"><i class="fas fa-edit"></i></button>';


echo '<div class="modal fade text-left" id="modalEditClient_' . $client['id'] . '" tabindex="-1" role="dialog" aria-labelledby="modalEditClientLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditClientLabel">Editar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editClientForm_' . $client['id'] . '" method="post" onsubmit="return validateEditClientForm(' . $client['id'] . ');" class="needs-validation" novalidate>
                    <input type="hidden" id="editClientId_' . $client['id'] . '" name="editClientId" value="' . $client['id'] . '">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="editClientName_' . $client['id'] . '" name="editClientName" required autocomplete="off" minlength="2" value="' . $client['name'] . '">
                            <div class="invalid-feedback">Por favor, ingrese al menos 2 caracteres para el nombre.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Apellido</label>
                            <input type="text" class="form-control" id="editClientLastName_' . $client['id'] . '" name="editClientLastName" required autocomplete="off" minlength="2" value="' . $client['last_name'] . '">
                            <div class="invalid-feedback">Por favor, ingrese al menos 2 caracteres para el apellido.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="editClientEmail_' . $client['id'] . '" name="editClientEmail" required autocomplete="off" value="' . $client['email'] . '">
                            <div class="invalid-feedback">Por favor, ingrese una dirección de correo electrónico válida.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marital_status">Estado civil</label>
                            <select class="form-control" id="editClientMaritalStatus_' . $client['id'] . '" name="editClientMaritalStatus" required autocomplete="off">';
foreach ($maritalStatus as $status) {
    $selected = ($status['id'] == $client['marital_status_id']) ? 'selected' : '';
    echo "<option value='" . $status['id'] . "' $selected>" . $status['name'] . "</option>";
}
echo '</select>
                            <div class="invalid-feedback">Por favor, seleccione un estado civil.</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dni">Documento de Identidad</label>
                            <input type="text" class="form-control" id="editClientDNI_' . $client['id'] . '" name="editClientDNI" required autocomplete="off" oninput="validateDNI(this)" value="' . $client['dni'] . '">
                            <div class=" invalid-feedback">Por favor, ingrese un documento de identidad válido.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="birth_date">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="editClientBirthDate_' . $client['id'] . '"';
$dateTime = DateTime::createFromFormat('d/m/Y', $client['birth_date']);
$formattedBirthDate = $dateTime->format('Y-m-d');
echo 'name="editClientBirthDate" required autocomplete="off" value="' . $formattedBirthDate . '">
                            <div class="invalid-feedback">Por favor, ingrese una fecha de nacimiento válida.</div>
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
