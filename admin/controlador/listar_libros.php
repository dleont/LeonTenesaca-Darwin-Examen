<?php
    include "../../config/conexionBD.php";

    $tarjeta_numero = $_GET['tarjeta'];
    $comida_nombre = $_GET['comida'] ? mb_strtoupper(trim($_GET['comida'])):null;
    
    if($tarjeta_numero!=''){
        $sqlTarjeta = "SELECT * FROM tarjetas WHERE tar_numero='$tarjeta_numero'";
        $varT = $conn->query($sqlTarjeta);
        $senial = false;

        while($rowT=$varT->fetch_assoc()){
            $tarjeta_id = $rowT["tar_codigo"];
            $tarjeta_nombre = $rowT["tar_nombre"];
        }

        $sqlPedido = "SELECT * FROM pedidos WHERE tar_codigo=$tarjeta_id and ped_total IS NOT NULL";
        $result = $conn->query($sqlPedido); 

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<aside>";
                echo "
                    <table class=pedido>
                    <tr>
                        <th>Num. Pedido</th>
                        <th>Fecha Pedido</th>
                        <th>Cliente</th>
                        <th>Observacion</th>
                        <th>Num. Tarjeta</th>
                        <th>Nom. Tarjeta</th>
                        <th>Total</th>
                    </tr>
                ";
                echo "<tr>";
                echo "<td>".$row["ped_numero"]."</td>";
                echo "<td>".$row["ped_fecha"]."</td>";
                echo "<td>".$row["ped_cliente"]."</td>";
                echo "<td>".$row["ped_observaciones"]."</td>";
                echo "<td>". $tarjeta_numero ."</td>";
                echo "<td>". $tarjeta_nombre ."</td>";
                echo "<td>".$row["ped_total"]."</td>";
                echo "</tr>";
                echo "</table>";

                $sql2 = "SELECT * FROM comidas WHERE ped_codigo=". $row['ped_codigo'];
                $resultado2 = $conn->query($sql2);

                if($resultado2->num_rows > 0){
                    echo "
                        <table class=comida>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                        </tr>
                        ";
                    while($row2 = $resultado2->fetch_assoc()){
                        echo "<tr >";
                        echo "<td class=comida>". $row2["com_nombre"]."</td>";
                        echo "<td>".$row2["com_precio_unitario"]."</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
            }
            echo "</aside>";
        } else {
           echo "<p>No existen pedidos</p>";
        }
    }elseif($comida_nombre!=''){
        $sqlComida = "SELECT * FROM comidas WHERE com_nombre='$comida_nombre'";
        echo  $comida_nombre;
        $varC = $conn->query($sqlComida);
        echo $varC;
        $senial = false;

        if($varC === TRUE){
            while($rowC=$varC->fetch_assoc()){
                $pedido_id = $rowC["ped_codigo"];
            }
    
            $sqlPedido = "SELECT * FROM pedidos WHERE ped_codigo=$pedido_id and ped_total IS NOT NULL";
            $result = $conn->query($sqlPedido); 
    
            while($rowP=$result->fetch_assoc()){
                $tarjeta_id = $rowP["tar_codigo"];
            }
    
            if ($result->num_rows > 0) {
                $sqlTarjeta = "SELECT * FROM tarjetas WHERE tar_codigo=$tarjeta_id";
                $varT = $conn->query($sqlTarjeta);
    
                while($rowT=$varT->fetch_assoc()){
                    $tarjeta_numero = $rowT["tar_numero"];
                    $tarjeta_nombre = $rowT["tar_nombre"];
                }
    
                $sqlPed = "SELECT * FROM pedidos WHERE ped_codigo=$pedido_id and ped_total IS NOT NULL";
                $resu = $conn->query($sqlPed); 
    
                while($row = $resu->fetch_assoc()) {
                    echo "<aside>";
                    echo "
                        <table class=pedido>
                        <tr>
                            <th>Num. Pedido</th>
                            <th>Fecha Pedido</th>
                            <th>Cliente</th>
                            <th>Observacion</th>
                            <th>Num. Tarjeta</th>
                            <th>Num. Tarjeta</th>
                            <th>Total</th>
                        </tr>
                    ";
    
                    echo "<tr>";
                    echo "<td>".$row["ped_numero"]."</td>";
                    echo "<td>".$row["ped_fecha"]."</td>";
                    echo "<td>".$row["ped_cliente"]."</td>";
                    echo "<td>".$row["ped_observaciones"]."</td>";
                    echo "<td>". $tarjeta_numero ."</td>";
                    echo "<td>". $tarjeta_nombre ."</td>";
                    echo "<td>".$row["ped_total"]."</td>";
                    echo "</tr>";
                    echo "</table>";
                    
                    $sql2 = "SELECT * FROM comidas WHERE ped_codigo=". $row["ped_codigo"];
                    $resultado2 = $conn->query($sql2);
    
                    if($resultado2->num_rows > 0){
                        echo "
                            <table class=comida>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                            </tr>
                            ";
                        while($row2 = $resultado2->fetch_assoc()){
                            echo "<tr >";
                            echo "<td class=comida>". $row2["com_nombre"]."</td>";
                            echo "<td>".$row2["com_precio_unitario"]."</td>";
                            echo "</tr>";
                        }
    
                        echo "</table>";
                    }
                }
                echo "</aside>";
            } else {
                echo "<p>No existen pedidos2</p>";
                $senial = false;
            }

        }else{
            echo "<p>No existen pedidos</p>";
        }
    }

    $conn->close();
?>