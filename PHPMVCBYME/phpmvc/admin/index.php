<?php
$main_path = dirname(__FILE__);
define('ADMIN_APP_PATH', $main_path.'/app');
define('ADMIN_CONTROLLER_PATH', $main_path.'/app/controllers');
define('ADMIN_MODEL_PATH', $main_path.'/app/models');
define('ADMIN_VIEW_PATH', $main_path.'/app/views');
define('ADMIN_URL', 'http://localhost/projectsbyme/phpmvc/admin/');
define('ADMIN_URL_ASSETS', 'http://localhost/projectsbyme/phpmvc/assets/admin/');

echo APP_PATH;
exit;

spl_autoload_register(function ($class_name) {
    $paths = array(APP_PATH, CONTROLLER_PATH, MODEL_PATH, VIEW_PATH, CORE_PATH, DB_PATH, HELPER_PATH);
    foreach ($paths as $class_file_path) {
        $full_path = $class_file_path.'/'.$class_name.'.php';
        if (file_exists($full_path)) {
            require $full_path;
        }
    }
});

function view($view, $data) {
    ob_start();

    extract($data);
    require VIEW_PATH.'/'.$view.'/'.$view.'.php';

    $out = ob_get_contents();

    ob_end_clean();

    echo $out;
}

$controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'index';
$controller = strtolower($controller);
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';
$action = strtolower($action);
$actionName = $action.'Action';
$controllerClass = $controller.'Controller';

if (class_exists($controllerClass)) {
    $instanceController = new $controllerClass();
    if (method_exists($instanceController, $actionName)) {
        $instanceController->$actionName();
    } else {
        $instanceController->indexAction();
    }
} else {
    $controllerClass = 'errorController';
    $instanceController = new $controllerClass();
}
