<?php
$main_path = dirname(__FILE__);
define('APP_PATH', $main_path.'/app');
define('CONTROLLER_PATH', $main_path.'/app/controllers');
define('MODEL_PATH', $main_path.'/app/models');
define('VIEW_PATH', $main_path.'/app/views');
define('CORE_PATH', $main_path.'/core');
define('DB_PATH', $main_path.'/core/database');
define('HELPER_PATH', $main_path.'/core/helper');
define('INDEX2_PATH',$main_path.'/index2');
define('URL', 'http://localhost/PHPMVCBYME/phpmvc/');
define('URL_ASSETS', 'http://localhost/PHPMVCBYME/phpmvc/assets/');

spl_autoload_register(function ($class_name) {
    $paths = array(APP_PATH, CONTROLLER_PATH, MODEL_PATH, VIEW_PATH, CORE_PATH, DB_PATH, HELPER_PATH);
    foreach ($paths as $class_file_path) {
        $full_path = $class_file_path.'/'.$class_name.'.php';
        if (file_exists($full_path)) {
            require $full_path;
        }
    }
});
//echo '<pre>';
//print_r(INDEX2_PATH);
//echo '</pre>';
//exit();
function view($view, $data) {
    ob_start();

    extract($data);
//    require VIEW_PATH.'/'.$view.'/'.$view.'.php';
    require INDEX2_PATH.'/'.'index2.php';

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
