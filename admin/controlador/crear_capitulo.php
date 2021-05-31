<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';

    $codigoPed = $_GET["pedido"];
    $nombreCom = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
    $precioCom = isset($_POST["precio"]) ? trim($_POST["precio"]):null;

    $sql = "INSERT INTO comidas VALUES (0,'$nombreCom',$precioCom,$codigoPed)";

    if ($conn->query($sql) === TRUE) {

        $precio_total = "SELECT SUM(com_precio_unitario) as ptotal FROM comidas WHERE ped_codigo=$codigoPed";
        $ver = $conn->query($precio_total);
        echo "<p>Actualizado</p>";

        while($row = $ver->fetch_assoc()) {
            $resultado_total =  $row["ptotal"];
        }

        echo "<p>Resultado: $resultado_total</p>";

        if($resultado_total !== 0){
            $sqlPedido = "UPDATE pedidos SET ped_total=$resultado_total WHERE ped_codigo=$codigoPed"; 
            $valPedido = $conn->query($sqlPedido);
            
            if($valPedido === TRUE){
                header ("Location: ../vista/crear_comida.php?pedido=$codigoPed");
            }else{
                echo "<p>Error al modificar</p>";
            }
        }else{
            echo "<p>No hace la sumatoria</p>";
        }
        
    } else {
        echo "<p>Algo pasa error al ingresar</p>";
        #header ("Location: ../vista/crear_comida.html");

        if($conn->errno == 1062){
            echo "<p Algo error </p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    $conn->close();
 
?>