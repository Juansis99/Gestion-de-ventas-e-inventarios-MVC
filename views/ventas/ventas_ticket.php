
<?php 
    include_once "views/layout/ticket/ticket_style.php";
?>
<body>
    <div class="ticket">
        <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="Logotipo">
        <p class="centrado">TICKET DE VENTA
            <br><?php echo $venta->fecha; ?>
            <br>-------------------------------------------
            <br><?php echo $venta->idCli; ?>
            <br><?php echo $venta->Cliente; ?>
            <br><?php echo $venta->Ciudad; ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($productos["productos"] as $producto) {
                    $subtotal = $producto->precioVenta * $producto->cantidad;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td class="cantidad"><?php echo $producto->cantidad;  ?></td>
                        <td class="producto"><?php echo $producto->descripcion;  ?> <strong>$<?php echo number_format($producto->precioVenta, 2) ?></strong></td>
                        <td class="precio">$<?php echo number_format($subtotal, 2)  ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td class="precio">
                        <strong>$<?php echo number_format($total, 2) ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
        </p>
    </div>
</body>
<?php 
    include_once "views/layout/ticket/ticket_script.php";
?>