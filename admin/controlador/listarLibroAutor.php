<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';
    //echo 'Entro a la base';
    $libro = $_GET["libro"];
    //echo "$cedula";
    //echo "Hola " . $cedula;

    $sql = "SELECT p.codigo, p.ped_numero, p.ped_fecha, p.ped_cliente, p.ped_total, p.ped_observaciones, c.com_nombre, t.tar_nombre
            FROM libro p, capitulo c, autor t 
            WHERE (c.com_nombre = '$libro') AND ((t.tar_codigo = p.tar_codigo) AND (p.ped_codigo = c.ped_codigo))";
    //cambiar la consulta para puede buscar por ocurrencias de letras
    $result = $conn->query($sql);
     echo " <table style='width:100%' border=1>
        <tr>
            <th>Libro Codigo</th>
            <th>Libro Numero</th>
            <th>Libro Fecha</th>
            <th>Libro Cliente</th>
            <th>Libro Total</th>
            <th>Libro Observaciones</th>
            <th>Capitulo Nombre</th>
            <th>Autor Nombre</th>
        </tr>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo " <td>" . $row['ped_codigo'] . "</td>";
            echo " <td>" . $row['ped_numero'] ."</td>";
            echo " <td>" . $row['ped_fecha'] . "</td>";
            echo " <td>" . $row['ped_cliente'] . "</td>";
            echo " <td>" . $row['ped_total'] . "</td>";
            echo " <td>" . $row['ped_observaciones'] . "</td>";
            echo " <td>" . $row['com_nombre'] ."</td>";
            echo " <td>" . $row['tar_nombre'] . "</td>";
            echo "</tr>";
        }
    } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
            echo "</tr>";
    }
    echo "</table>";
    $conn->close();

?>