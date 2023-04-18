<?php

function getTotalWorkers() {
    return "none";
}

function getName() {
    return "none";
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
    <!--Navbar-->
    <nav class="navbar navbar-dark fixed-top border-bottom border-dark" style="position:relative; background-color: #101010;">
        <div class="container-fluid">
            <i data-aos="fade-down" data-aos-duration="1500" class="bi-shop" style="font-size: 1.8rem; margin-right: .8rem; color:#ffc107;"></i>
            <a data-aos="fade-down" data-aos-duration="1500" class="navbar-brand" style="color:#ffc107; user-select:none;">EmpreGest</a>
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
                    </ul>
                    <hr class="hr-bw-2">
                    <h5 style="color: gray;">Cuenta:</h5>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi-gear-fill" style="font-size: 1rem; color:gray;"></i> Configuración de cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi-door-open-fill" style="font-size: 1rem; color: gray;"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!--Div Container-->

    <div class="container w-auto mt-4 border border-warning" style="border-radius: 15px; color: white;">

        <h4 class="mt-2" style="color:#ffc107" data-aos="fade-up" data-aos-duration="1000"><?php echo messageHour();?></h4>
        <h5 class="mt-1" style="color: gray;" data-aos="fade-up" data-aos-duration="1200">Bienvenido <?php echo getName();?></h5>

        <hr class="hr-bw-2" data-aos="fade-up" data-aos-duration="1200">

        <div class="row" style="font-size:18px; color:gray;">
            <div class="col" data-aos="fade-up" data-aos-duration="1400">
                <label>Numero de trabajadores: <br><?php echo getTotalWorkers()?></label>
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="1600">
                <label>Presupuesto total: <br><?php echo getTotalWorkers()?></label>
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="1800">
                <label>Total de ventas: <br><?php echo getTotalWorkers()?></label>
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="2000">
                <label>Estado de la cuenta: <br><?php echo getTotalWorkers()?></label>
            </div>
        </div>

        <hr class="hr-bw-2" data-aos="fade-up" data-aos-duration="2200">

        <h5 data-aos="fade-up" data-aos-duration="2200">Lista de trabajadores actual:</h5>

        <table data-aos="fade-up" data-aos-duration="2400" class="table mt-3" style="color: white">
            <thead class="sticky-top">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>


    <!--Scripts-->
    <script src="../../vendor/aos/dist/aos.js"></script>

    <script>

        AOS.init();

    </script>

    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>