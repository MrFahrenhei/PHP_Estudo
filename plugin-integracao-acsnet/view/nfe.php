<?php
    $Orders = new PIACS\OrdersAcs();
?>




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div style="display: flex;justify-content: center;">

    </div>

<div class="wrap">
    <h2>Lista de status de cache de NFe</h2>
<br><br><br>

    <button id='getCategorias' class="button button-primary" onclick="getCategorias(this)"><span>Consultar Todas NFe </span></button>
<br><br><br>

<table class='table table-striped table-sm w-75'>
    <thead>
        <tr>
            <th scope="col-4">Pedido</th>
            <th scope="col-4">Cliente</th>
            <th scope="col-1">Valor</th>
            <th scope="col-1">Cache</th>
            <th scope="col-1">NFe</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Orders->getOrders() as $order): ?>
            <tr>
                <td><?= $order->order_id ?></td>
                <td><?= $order->order->get_formatted_shipping_full_name() ?></td>
                <td><?= $order->order->get_formatted_order_total() ?></td>
                <?php if($order->Nfe->hasCache()): ?>
                    <td><button class="button button-secondary" onclick="status(<?= $order->id ?>)">Excluir</button></td>
                <?php else: ?>
                    <td><button class="button button-primary" onclick="status(<?= $order->id ?>)">Baixar</button></td>
                <?php endif; ?>

                <td><button class="button button-primary" <?= ($order->Nfe->hasCache()) ? : 'disabled' ?> onclick="status(<?= $order->id ?>)">Ver</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>



</table>


</div>


<script type="text/javascript">
// jQuery(#)
function status(id) {
    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_changeStatus',
            id: id
        },
        success: function (output) {
            window.location.reload();
        }
    });
}

    
function getCategorias(element){
    

    var load = jQuery('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');

    jQuery('#getCategorias').prop("disabled",true).find('span').append(load);

    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_getCats'
        },
        success: function (output) {
            window.location.reload();
        }
    });
};

</script>    