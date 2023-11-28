<?php
require_once './app/controllers/cias.controller.php';
require_once './app/controllers/siniestros.controller.php';
require_once './app/controllers/about.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// listar    ->         ciasController->listarCias();
// agregar   ->         ciasController->agregarCia();
// listarcia    ->      ciasController->listarCia($id);
// eliminar/:ID  ->     ciasController->removeCia($id); 
// mostrardetalle/:ID ->ciasController->detalleCia($id);
// actualizar/:ID  ->   ciasController->actualizarCia($id);
// actualizarCia/:ID  ->ciasController->updateCia($id);
// listarstro    ->     siniestrosController->listarStros();
// mostrarstros/:ID->   siniestrosController->verStrosporCia();
// agregarstro   ->     siniestrosController->agregarStro();
// listarCia  ->        siniestrosController->listarCias();
// about ->             aboutController->showAbout();
// login ->             authContoller->showLogin();
// logout ->            authContoller->logout();
// auth                 authContoller->auth(); // toma los datos del post y autentica al usuario

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        $controller = new ciasController();
        $controller->listarCias();
        break;
    case 'listarcia':
        $controller = new ciasController();
        $controller->listarCia($params[1]);
            break;
    case 'agregar':
        $controller = new ciasController();
        $controller->agregarCia();
        break;
    case 'eliminar':
        $controller = new ciasController();
        $controller->removeCia($params[1]);
        break;
    case 'mostrardetalle':
        $controller = new ciasController();
        $controller->detalleCia($params[1]);
        break;
    case 'actualizar':
        $controller = new ciasController();
        $controller->actualizarCia($params[1]);
        break;
    case 'actualizarCia':
        $controller = new ciasController();
        $controller->updateCia();
        break;
    case 'siniestros':
        $controller = new siniestrosController();
        $controller->mostrarSiniestros();
        break;
    case 'agregarstro':
        $controller = new siniestrosController();
        $controller->agregarStro();
        break;
    case 'eliminarstro':
        $controller = new siniestrosController();
        $controller->removeStro($params[1]);
        break;
    case 'actualizars':
        $controller = new siniestrosController();
        $controller->actualizarStro($params[1]);
        break;
    case 'actualizarStro':
        $controller = new siniestrosController();
        $controller->updateStro();
        break;
    case 'listarCia':
        $controller = new siniestrosController();
        $controller->listarCiasStro();
        break;
    case 'mostrarstros':
        $controller = new siniestrosController();
        $controller->verStrosporCia();
        break;
    
    
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}