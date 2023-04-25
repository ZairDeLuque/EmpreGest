<?php
require_once ('dashboardDataControl/sessionControl/SessionControl.php');
require_once ('dashboardDataControl/getTWorkers.php');

function checkSession(){
    if (checkSessionActive() == false) {
        header('Location: ../sign_in.html');
        exit;
    }
}

checkSession();

$username = getName();
$countableWorkers = getTotalWorkers();

function getTotalWorkers() {
    global $username;

    return workers($username);
}

function getName() {
    return obtainSessionData(1);
}

function getVersion() {
    require_once ('./dashboardDataControl/getversionService.php');

    $s = getDataServer();

    return "App version: " . $s['Ver'];
}

function messageHour() {
    date_default_timezone_set('America/Mexico_City');
    $hora = date('H');

    if ($hora >= 5 && $hora < 12) {
      return "¡Buenos días!";
    } elseif ($hora >= 12 && $hora < 19) {
      return "¡Buenas tardes!";
    } else {
      return "¡Buenas noches!";
    }
}

function messageIcon() {
    date_default_timezone_set('America/Mexico_City');
    $hora = date('H');

    if ($hora >= 5 && $hora < 12) {
      return "cloud-moon";
    } elseif ($hora >= 12 && $hora < 19) {
      return "sun";
    } else {
      return "moon-stars";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Icon-->
    <link rel="shortcut icon" href="../../icon/icon.ico" type="image/x-icon"> 

    <!--Stylesheet add-->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/dashboard.css">

    <title>EmpreGest - Dashboard</title>

</head>
<body>
    <!--Scripts-->
    <script src="../../vendor/aos/dist/aos.js"></script>

    <script>

        AOS.init();

    </script>

    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top border-bottom border-dark" style="position:relative; background-color: #101010; user-select:none;">
        <div class="container-fluid">
            <i data-aos="fade-down" data-aos-duration="1500" class="bi-shop" style="font-size: 1.8rem; margin-right: .8rem; color:#ffc107;"></i>
            <a data-aos="fade-down" data-aos-duration="1500" class="navbar-brand" style="color:#ffc107;">EmpreGest - <?php echo $username?></a>
            <button data-aos="fade-down" data-aos-duration="1500" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header border-bottom border-dark" style="background-color: #101010 !important;">
                    <i class="bi-database-fill" style="font-size: 1.6rem; margin-right: .8rem; color:#ffc107;"></i>
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dashboard</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="background-color: #101010 !important;">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <h5 style="color: gray">Herramientas: </h5>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="bi-house-fill" style="font-size: 1rem; color:white;"></i> Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-person-vcard" style="font-size: 1rem; color:gray;"></i> Personal
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark w-50" s>
                                <li><a class="dropdown-item" href="#"><i class="bi-person-fill-add" style="font-size: 1rem; color:lightgray;"></i> Agregar</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi-person-fill-up" style="font-size: 1rem; color:lightgray;"></i> Editar</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi-person-fill-dash" style="font-size: 1rem; color:lightgray;"></i> Eliminar</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-box2" style="font-size: 1rem; color:gray;"></i> Inventario
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark w-50" s>
                                <li><a class="dropdown-item" href="#"><i class="bi-bar-chart" style="font-size: 1rem; color:lightgray;"></i> Ver estado</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi-pencil" style="font-size: 1rem; color:lightgray;"></i> Editar inventario</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="bi-file-spreadsheet" style="font-size: 1rem; color:lightgray;"></i> Exportar datos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi-cart-fill" style="font-size: 1rem; color:gray;"></i> Sistema de Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi-calendar-fill" style="font-size: 1rem; color:gray;"></i> Calendario</a>
                        </li>
                    </ul>
                    <hr class="hr-bw-2">
                    <h5 style="color: gray;">Cuenta:</h5>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-link">
                            <div class="row">
                                <div class="col-1">
                                    <img src="../../icon/user.png" width="32px" height="32px">
                                </div>
                                <div class="col mt-1" style="margin-left: 1rem; user-select:none;">
                                    Nombre de la cuenta
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi-gear-fill" style="font-size: 1rem; color:gray;"></i> Configuración de cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./dashboardDataControl/sessionControl/destroy.php"><i class="bi-door-open-fill" style="font-size: 1rem; color: gray;"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!--Div Container-->

    <div class="container w-auto mt-4 border border-warning" style="border-radius: 15px; color: white;">

        <div class="row mt-3" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-3">
                <h4 style="color:#ffc107"><i class="bi-<?php echo messageIcon();?>" style="font-size: 1.3rem; color:#ffc107;"></i>   <?php echo messageHour();?></h4>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <label style="color: gray; opacity: 0.4;"><?php echo getVersion()?></label>
                </div>
            </div>
        </div>
        <h5 class="mt-1" style="color: gray;" data-aos="fade-up" data-aos-duration="1200">Bienvenido <?php echo $username;?></h5>

        <hr class="hr-bw-2" data-aos="fade-up" data-aos-duration="1200">

        <div class="row mb-3" style="font-size:18px; color:gray;">
            <div class="col" data-aos="flip-down" data-aos-duration="1400">
                <label><i class="bi-person-bounding-box" style="font-size: 1rem; color:gray;"></i> Personal total: <br><?php echo $countableWorkers?></label>
            </div>
            <div class="col" data-aos="flip-down" data-aos-duration="1600">
                <label><i class="bi-piggy-bank" style="font-size: 1rem; color:gray;"></i> Presupuesto total: <br><?php echo null?></label>
            </div>
            <div class="col" data-aos="flip-down" data-aos-duration="1800">
                <label><i class="bi-cart-check" style="font-size: 1rem; color:gray;"></i> Total de ventas: <br><?php echo null?></label>
            </div>
            <div class="col" data-aos="flip-down" data-aos-duration="2000">
                <label><i class="bi-check-circle" style="font-size: 1rem; color:gray;"></i> Estado de la cuenta: <br><?php echo null?></label>
            </div>
        </div>
    </div>

    <!--Div container sub info-->

    <div class="container w-auto mt-4 border border-warning" style="border-radius: 15px; color: white;">
        <div class="row mt-3 mb-3">
            <div class="col border-end border-warning">
                <h4 data-aos="fade-up" data-aos-duration="2200" style="color:#ffc107"><i class="bi-person-check" style="font-size: 1.4rem; color:#ffc107;"></i> Trabajadores activos:</h4>
                <hr data-aos="fade-up" data-aos-duration="2200" class="hr-bw-2">

                <div data-aos="fade-up" data-aos-duration="2400" class="container" style="max-height: 200px; overflow-y: scroll;">

                <table class="table" style="color: white;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Zair</td>
                        <td>DeLuque</td>
                        <td>0</td>
                        <td>Hombre</td>
                    </tr>
                </tbody>
                </table>

                </div>
            </div>
            <div class="col border-start border-warning">
                <h4 data-aos="fade-up" data-aos-duration="2600" style="color:#ffc107"><i class="bi-app-indicator" style="font-size: 1.4rem; color:#ffc107;"></i> Notificaciones:</h4>
                <hr data-aos="fade-up" data-aos-duration="2600" class="hr-bw-2">

                <div data-aos="fade-up" data-aos-duration="2800" class="container" style="max-height: 200px; overflow-y: scroll;">

                <table class="table" style="color:white;">
                    <tbody>
                        <tr>
                            <td class="col-1"><i class="bi-bell" style="font-size: 1.4rem; color:#ffc107;"></i></td>
                            <td style="transform: translateY(-5px);"><b>Titulo</b><br><label style="color: lightgray;">Subtitulo</label></td>
                        </tr>
                    </tbody>
                </table>

                </div>

            </div>
        </div>
    </div>

    <!--Div News-->

    <div class="container w-auto mt-4 border border-warning" style="border-radius: 15px; color: white;">

        <h5 class="mt-3" style="color: #ffc107;"><i class="bi-newspaper" style="font-size: 1.4rem; color:#ffc107;"></i> Noticias acerca de EmpreGest y Aurora Studios:</h5>

        <hr class="hr-bw-2">

        <div class="container-fluid">
            <div class="row mb-3 flex-nowrap overflow-auto">
                <?php 
                
                require_once('./dashboardDataControl/newsService.php');

                $c = 0;

                while ($c < 5){?>
                    
                    <div class="card border border-dark-subtle" style="width: 18rem; margin-bottom: .5rem; margin-right: 1rem; background-color: #101010; color: white;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ObtainNewsInformation("title", $c, 5)?></h5>
                            <p class="card-text" style="text-align: justify;"><?php echo ObtainNewsInformation("info", $c, 5)?></p>
                        </div>
                        <?php if(ObtainNewsInformation("URL", $c, 5) != null){?>
                            <a href="<?php echo ObtainNewsInformation("URL", $c, 5)?>" class="btn btn-outline-light mb-3">Ver más</a>
                        <?php } ?>
                    </div>
                    
                <?php $c++; }?>               
            </div>
        </div>
    </div>
    
    <!--Pie de pagina-->

    <footer class="bd-footer py-2 py-md-3" style="background-color: #101010;">
        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <div class="row">
            <div class="col-lg-3 mb-3">
                <p class="mb-2" style="color: rgb(75, 75, 75);">Diseñado usando:</p>
                <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="/" aria-label="Bootstrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="d-block me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="rgb(75, 75, 75)"></path></svg>
                <span class="fs-5" style="color: rgb(75, 75, 75);">Bootstrap</span>
                </a>
                <ul class="list-unstyled small">
                <li class="mb-2" style="color: rgb(75, 75, 75);">Codigo bajo licencia <a href="https://github.com/twbs/bootstrap/blob/main/LICENSE" target="_blank" rel="license noopener">MIT</a>, documentacion <a href="https://creativecommons.org/licenses/by/3.0/" target="_blank" rel="license noopener">CC BY 3.0</a>.</li>
                </ul>
            </div>
            <div class="col-6 col-lg-2 offset-lg-1 mb-3" style="color: rgb(75, 75, 75);">
                <h5>Aurora Studios</h5>
                <hr class="hr-bw2" style="margin-top: 1rem;">
                <ul class="list-unstyled">
                <li class="mb-2"><a href="https://zairdeluque.carrd.co/">ZairDeLuque</a></li>
                <li class="mb-2"><a href="https://apocalix.carrd.co/">ApocalixDeLuque</a></li>
                <li class="mb-2"><a href="https://www.youtube.com/@RJCodeAdvance">RJCodeAdvance</a></li>
                <li class="mb-2"><a href="https://slashrichie.dev/">DevSlashRichie</a></li>
                <li class="mb-2"><a>MariaSantana</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2 mb-3" style="color: rgb(75, 75, 75);">
                <h5>Terceros:</h5>
                <hr class="hr-bw2" style="margin-top: 1rem;">
                <ul class="list-unstyled">
                <li class="mb-2"><a href="https://getbootstrap.com/">Bootstrap 5</a></li>
                <li class="mb-2"><a href="https://icons.getbootstrap.com/">Bootstrap Icons</a></li>
                <li class="mb-2"><a href="https://michalsnik.github.io/aos/">AOS Library</a></li>
                <li class="mb-2"><a href="https://www.mysql.com/">MySQL</a></li>
                <li class="mb-2"><a href="https://code.visualstudio.com/">Visual Studio Code</a></li>
                <li class="mb-2"><a href="https://github.com/">GitHub</a></li>
                </ul>
            </div>
            </div>
        </div>
    </footer>

    

</body>
</html>