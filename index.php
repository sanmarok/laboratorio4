<?php

// require_once 'extensiones/phpmailer/src/Exception.php';
// require_once 'extensiones/phpmailer/src/PHPMailer.php';
// require_once 'extensiones/phpmailer/src/SMTP.php';

require_once 'controllers/template.controller.php';

// require_once 'controladores/productos.controlador.php';
// require_once 'modelos/productos.modelo.php';

require_once 'models/connection.php';

require_once 'controllers/users.controller.php';
require_once 'models/users.models.php';


$template = new ControllerTemplate();
$template->ctrShowTemplate();
