<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Capitulos</title>
        <link rel="stylesheet" type="text/css" href="../css/crear_capitulo.css">
        <script type="text/javascript" src="../javascript/buscar_autor.js"></script>
        
    </head>
    <body id="cuerpo">
        <div class="contenedor">
            <?php
                $codigo = $_GET["codigo"];
            ?>
            <form  class="formu "id="formulario01" method="POST"action="../controladores/agregar_capitulo.php"> 
             
                    <input type="hidden" id="nombre" name="nombre" value="<?php echo $codigo ?>"  />     
                    <label for="cap_numero">Numero Capitulo (*)</label>
                    <input type="text" id="cap_numero" name="cap_numero" value="" placeholder="Ingrese el numero de capítulo"/>
                    <br><br>
                    <label for="cap_titulo">Titulo (*)</label>
                    <input type="text" id="cap_titulo" name="cap_titulo" value="" placeholder="Ingrese el titulo del capítulo"/>
                        <br><br>
                    <label for="autor">Autor (*)</label>
            
                    <select class="select" id="autor" name="autor" onchange='buscarPorAutor()'>
                        <?php
                        include '../../config/conexionBD.php';
                        $sql = "SELECT aut_nombre FROM autor ";
                        $result = $conn->query($sql);   
                        if ($result->num_rows > 0) {
                
                            while ($row = $result->fetch_assoc()) {
                                echo " <option>".$row['aut_nombre']." </option>";
                            }
                        } else {
                            echo " <option>".'sin registros'." </option>";
                        }
                
                        $conn->close();
                        ?>
                    </select>
                    <br><br>
                    <div id="informacion"><b></b></div>
                    <br><br>
                    <input class="boton" type="submit" id="crear" name="crear" value="Agregar Capitulo" />
                    <input class="boton" type="reset" id="cancelar" name="cancelar" value="Cancelar" />
                    <br><br>
                    </form>
                    </html>