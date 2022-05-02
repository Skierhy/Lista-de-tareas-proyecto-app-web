<?php
include 'inc/funciones/sesiones.php';
include 'inc/funciones/funciones.php';  


//Obtener el ID de la URL
    $id_proyecto ="";
    if(isset($_GET['id_proyecto'])){
        $id_proyecto = $_GET['id_proyecto'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UpTask</title>
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="<?php echo obtenerPaginaActual(); ?>">

<div class="barra">
    <h1>UpTask - Administración de Proyectos</h1>
    <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
</div>
<div class="contenedor">
    
<aside class="contenedor-proyectos">
        <div class="panel crear-proyecto">
            <a href="#" class="boton">Nuevo Proyecto <i class="fas fa-plus"></i> </a>
        </div>
    
        <div class="panel lista-proyectos">
            <h2>Proyectos</h2>
            <ul id="proyectos">
                <?php
                    $proyectos = obtenerProyectos();
                    if($proyectos){
                        foreach($proyectos as $proyecto){ ?>
                            <li>
                                <a href="index.php?id_proyecto=<?php echo $proyecto['id'];?>" id="proyecto:<?php echo $proyecto['id'];?>">
                                    <?php echo $proyecto['nombre']; ?>
                                </a>
                            </li>
                    <?php } //Fin foreach
                    }//Fin if ?>
            </ul>
        </div>
</aside>

    <main class="contenido-principal">
        <?php 
            $proyecto = obtenerNombreProyecto($id_proyecto);
            if($proyecto){ ?>
        <h1>Proyecto Actual:
                <?php foreach($proyecto as $nombre){ ?>
                    <span><?php echo $nombre['nombre']; ?></span>
                <?php }//Fin for each ?>
        </h1>

        <form action="#" class="agregar-tarea">
            <div class="campo">
                <label for="tarea">Tarea:</label>
                <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
            </div>
            <div class="campo enviar">
                <input type="hidden" id="id_proyecto" value="<?php echo $id_proyecto; ?>" value="id_proyecto">
                <input type="submit" class="boton nueva-tarea" value="Agregar">
            </div>
        </form>
        <?php  
        } else { //Fin del if '$proyecto'
            //Si no hay proyectos seleccionados
            echo "<h1>Selecciona un proyecto a la izquierda</h1>";
        }
        ?>           
        <h2>Listado de tareas:</h2>

        <div class="listado-pendientes">
            <ul>
                <?php 
                    //Obtiene las tareas del proyecto actual
                    $tareas = obtenerTareasProyecto($id_proyecto);
                if($tareas){ //Verificamos si existe tareas primeramente antes de agregar de forma dinamica
                    if($tareas->num_rows > 0 ){
                        //Si hay tareas
                        foreach($tareas as $tarea): ?>
                            <li id="tarea:<?php echo $tarea['id']; ?>" class="tarea">
                            <p><?php echo $tarea['nombre']; ?></p>
                                <div class="acciones">
                                    <i class="far fa-check-circle <?php echo ($tarea['estado']==='1') ? 'completo' : ''; ?>"></i>
                                    <i class="fas fa-trash"></i>
                                </div>
                            </li>  
                        <?php endforeach; 
                    } else {
                        //No hay tareas
                        echo "<p class='lista-vacia'>No hay tareas en este proyecto</p>";
                    }
                } //Fin del if 'isset'
                ?>
                
            </ul>
        </div>
    </main>
</div><!--.contenedor-->

<script src="js/sweetalert2.all.min.js"></script>

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