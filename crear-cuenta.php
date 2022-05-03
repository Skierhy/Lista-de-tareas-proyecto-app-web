<?php
include 'inc/funciones/funciones.php';  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="<?php echo obtenerPaginaActual(); ?>">

        <div class="container w-75 bg-primary mt-5 rounded shadow">
            <div class="row aligm-items-stretch">
                <!-- uso de breakpoint -->
                <div class="col bg2 d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded"></div>
                <div class="col bg-white p-5 rounded-end">
                    <div class="text-end">
                        <img src="../img/crearlogogratis_1024x1024_01.png" width="48" alt="" />
                        <h2 class="fw-bold text-center py-5">Crea una cuenta con nosotros</h2>
                        <!-- Login -->
                        <form id="formulario" method="post">
                        <div class="mb-4">
                            <label for="usuario" class="form-label">Usuario:            </label>
                            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario"
                                required />
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña:            </label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password"
                                required />
                        </div>
                        <div class="my-3">
                            <span>Ya tienes cuenta?
                                <a href="login.php">Inicia sesión</a></span>
                        </div>
                        <div class="d-grid">

                            <input type="hidden" id="tipo" value="crear">
                            <input type="submit" class="btn btn-primary" value="Crear cuenta">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php 
    $actual = obtenerPaginaActual();
    if($actual === 'crear-cuenta' || $actual === 'login'){
        echo '<script src="js/formulario.js"></script>';
    } else {
        echo '<script src="js/scripts.js"></script>';
    }
?>

</body>
</html>
