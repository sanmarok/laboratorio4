<?php



require_once 'controllers/template.controller.php';

require_once 'models/connection.php';

require_once 'controllers/users.controller.php';
require_once 'models/users.models.php';

require_once 'controllers/clients.controller.php';
require_once 'models/clients.models.php';

require_once 'controllers/products.controller.php';
require_once 'models/products.models.php';

$template = new ControllerTemplate();
$template->ctrShowTemplate();
