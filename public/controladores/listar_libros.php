<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listar Libros</title>
    <link href=../css/reglas.css rel="stylesheet" />
    <link href=../css/estilos.css rel="stylesheet" />
</head>

<body>

    <center>
        <h1>LISTAR LIBROS ALMACENADOS</h1>
    </center>

    
        <?php
        include '../../config/conexionBD.php';
        $sql = "SELECT * FROM libro";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
               echo "<table style='width:90%'>";
        echo"<tr>";
           echo "<center><h3>LIBRO</h3></center>";
            echo"<th>Nombre Libro</th>";
            echo "<th>ISBN Libro</th>";
            echo "<th>Numero Paginas</th>";
        echo"</tr>";
                echo "<tr>";
                echo " <td>" . $row["lib_nombre"] . "</td>";
                echo " <td>" . $row['lib_ISBN'] . "</td>";
                echo " <td>" . $row['lib_num_paginas'] . "</td>";
                echo "</tr>";
                $codCap=$row['lib_codigo'];
            
                
                echo"<table style='width:80%'>";
                echo"<tr>";
                echo "<center><h3>CAPITULOS</h3></center>";
                    echo"<th>Numero Capitulo</th>";
                    echo"<th>Titulo Capitulo</th>";
                    echo"<th>Autor Capitulo</th>";
                echo"</tr>";
                $sql1 = "SELECT * FROM capitulo WHERE cap_lib_codigo=$codCap";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {

            while ($row1 = $result1->fetch_assoc()) {
                echo "<tr>";
                echo " <td>" . $row1["cap_numero"] . "</td>";
                echo " <td>" . $row1['cap_titulo'] . "</td>";
                $auto = $row1['cap_aut_codigo'];
                $sql2 = "SELECT aut_nombre FROM autor WHERE aut_codigo='$auto'";
                //echo($sql1);
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    
                    $autor=$row2['aut_nombre'];
                } else {
                    echo " No existe autor";
                }
                echo " <td>" . $autor . "</td>";
                
                echo "</tr>";
            }
            }else {
                echo "<tr>";
                echo " <td colspan='7'> No existen Capitulos en este libro </td>";
                echo "</tr>";
            }
        
                
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen libros </td>";
            echo "</tr>";
        }
         echo "</table>";
        $conn->close();
        ?>

        
        <br>   <br>
        
        <input type="button" value="Inicio" onclick="location.href='../vista/index.html'">
    </table>
    
</body>

</html>