<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../../js/buscar_autor.js"></script>
    <link href=../../css/reglas.css rel="stylesheet" />
    <link href=../../css/estilos.css rel="stylesheet" />
    <title>Agregar Capítulo</title>
</head>

<body>
    <h1>
        <center> Agregar Capítulo</center>
    </h1>
    <?php
    $codigo = $_GET["codigo"];
    ?>
<form  class="formu "id="formulario01" method="POST"action="agregar_capitulo.php"> 
 
        <input type="hidden" id="codLib" name="codlib" value="<?php echo $codigo ?>"  />     
        <label for="num_cap">Numero Capitulo (*)</label>
        <input type="text" id="num_cap" name="num_cap" value="" placeholder="...Ingrese el numero de Capitulo"/>
        <br><br>
        <label for="titulo_cap">Titulo Capitulo (*)</label>
        <input type="text" id="titulo_cap" name="titulo_cap" value=""
            placeholder="... Ingrese el titulo del capitulo"/>
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