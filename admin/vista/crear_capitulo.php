<!DOCTYPE html>
<html>

    <head>
        <title>Capitulos</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../css/crear_capitulo.css">
        
    </head>
    <body id="cuerpo">
        <div class="contenedor">
            <?php
                include '../../config/conexionBD.php'; 

                $capitulo = $_GET["capitulo"];
            ?>
            <header id="cabecera">
                <nav class="menu">
                    <h3 class="titulo_menu">Menu</h3>
                    <ul>
                        <li><a href="index.html">Menu</a></li>
                        <li><a href="listar_pedidos.html">Listar Libros</a></li>
                    </ul>
                </nav>
            </header>
            <div class="logo">
                <img class=img_logo src="../../public/img/librerias.jpg" alt="Logo de libreria">
            </div>
            <div class="separador">
                <h2>Capitulos</h2>
            </div>
            <div class="cont_form">
                <form class="formulario01" method="POST" onsubmit="" action="../controlador/agregar_capitulo.php?capitulo=<?php echo $capitulo ?>">
                    <h2>Agregar Capitulo</h2>
                    <label>&#8226; Número:</label>
                    <input type="text" id="nombre" name="nombre" value="" placeholder="Ingrese el número de capítulos" />
                    <label>&#8226; Título:</label>
                    <input type="text" id="precio" name="precio" value="" placeholder="Ingrese el título del capítulo" />

                    <!-- input id="terminar" type="button" value="Terminar Pedido" onclick="location.href='../../public/vista/listar_pedidos.html'"/> -->
                    <input id="agregar" type="submit" value="Agregar">
                    <input id="cancelar" type="button" value="Cancelar" onclick="location.href='../../public/vista/index.html'"/>
                    <div></div>
                </form>
            </div>
            <?php
                $conn->close(); 
            ?>
            <div></div>
            <div class="imagenes">
                <img class="img_libro1" src="../img/libro1.jpg" alt="libro1">
                <img class="img_libro2" src="../img/libro2.jpg" alt="libro2">
                <img class="img_libro3" src="../img/libro3.jpg" alt="libro3">
                <img class="img_libro4" src="../img/libro4.jpg" alt="libro4">
        </div>
        </div>
    </body>
</html>