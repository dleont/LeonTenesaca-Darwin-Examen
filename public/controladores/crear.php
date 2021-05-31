<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/reglas.css" />
    <title>Libro </title>
</head>

<body>
    <header>
        <div class="logo">
            <img class=img_logo src="../img/librerias.jpg" alt="Logo de libreria">
        </div>
    </header>
    <h1>
        <center>  Libro</center>
    </h1>

    <?php
    include '../../config/conexionBD.php';

    $nombre = $_GET["nombre"];
    $sql = "SELECT lib_codigo,lib_nombre,lib_ISBN,lib_num_paginas FROM libro WHERE lib_nombre='$nombre'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p><b>NOMBRE : </b>" . $row["lib_nombre"] . "</br></p>";
        echo "<p><b>ISBN: </b>" . $row['lib_ISBN'] . "</br></p>";
        echo "<p><b>NUMERO PAGINAS: </b>" . $row['lib_num_paginas'] . "</br></p>";
        $codigo=$row['lib_codigo'];
    } else {
        echo " No existe libro";
    }

    $conn->close();
    ?>
        <h2>
            <center> Capitulos</center>
        </h2>
        
        <table style="width:100%">
        <tr>
            <th>Numero</th>
            <th>Titulo</th>
            <th>Autor</th>

        </tr>


        <?php
        include '../../config/conexionBD.php';
        $sql = "SELECT * FROM capitulo WHERE cap_lib_codigo='$codigo'";
        //echo($sql);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo " <td>" . $row['cap_numero'] . "</td>";
                echo " <td>" . $row['cap_titulo'] . "</td>";
                $auto = $row['cap_codigo'];
                $sql1 = "SELECT aut_nombre FROM autor WHERE aut_codigo='$auto'";
                //echo($sql1);
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                    $row1 = $result1->fetch_assoc();
                    
                    $autor=$row1['aut_nombre'];
                } else {
                    echo " No existe autor";
                }
                echo " <td>" . $autor . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen capitulos en el libro </td>";
            echo "</tr>";
        }

        $conn->close();
        ?>
    </table>
    <br><br>
        <a href="crear_capitulo.php?codigo=<?php echo $codigo ?>" class="button">Agregar Capitulo</a>
        <br><br>
        <a href="index.html" class="button">Finalizar</a>
        <br><br>
    <br>

</body>

</html>