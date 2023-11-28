<?php

// Botón para desplegar el modal con el ID del producto concatenado
echo "<td class='text-center'>
        <button id='btnInfo_{$product['id']}' class='btn btn-info mx-1' data-toggle='modal' data-target='#modalInfo_{$product['id']}'>
            <i class='fa-solid fa-circle-info'></i>
        </button>
      </td>";

// Modal con información adicional y el ID del producto concatenado
echo "<div class='modal fade' id='modalInfo_{$product['id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-xl modal-dialog-scrollable' role='document'>
            <div class='modal-content'>
                <!-- Contenido del modal aquí -->
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Detalles del Producto</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <!-- Contenido del cuerpo del modal aquí -->
                    <div class='form-row'>
                        <div class='col-md-6'>
                            <label><strong>ID del Producto:</strong></label>
                            <p>{$product['id']}</p>
                            
                            <label><strong>Nombre:</strong></label>
                            <p>{$product['name']}</p>
                            
                            <label><strong>Categoría:</strong></label>
                            <p>{$product['category_name']}</p>
                            
                            <label><strong>Precio:</strong></label>
                            <p>$ {$product['price']}</p>
                        </div>
                        <div class='col-md-6'>
                            
                            <label><strong>Estado:</strong></label>
                            <p>{$product['status']}</p>
                            
                            <label><strong>Stock:</strong></label>
                            <p>{$product['stock']}</p>";

$product['creation_date'] = date('d/m/Y', strtotime($product['creation_date']));

echo "<label><strong>Fecha de Creación:</strong></label>
                            <p>{$product['creation_date']}</p>
                        </div>
                        <div class='mx-auto'>";


echo "<img src='{$product['image_path']}' alt='Imagen del Producto' class='img-fluid' style='max-width: 400px;'>";


echo "</div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    <!-- Otros botones u opciones según sea necesario -->
                </div>
            </div>
        </div>
      </div>";
