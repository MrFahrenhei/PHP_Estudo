<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div style="display: flex;justify-content: center;">

    </div>

<div class="wrap">
    <h2>Custom Plugin Setting Page Heading</h2>
<br><br><br>


<button id="processa" class="button button-secondary" onclick="aOrder(this)"><span>Processa todas ordens </span></button>
<button id="processa" class="button button-primary" onclick="selectOrders(this)"><span>Processa Ordens Marcadas</span></button>
<br><br><br>

<?php
    $orders = wc_get_orders(array(
        'limit'=>-1,
        'type'=> 'shop_order',
        'status'=> PIACS\Settings::get('cat_sub_order'),
        )
    );
?>

<table class='table table-striped table-sm w-75'>
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Nome</th>
            <th>Valor</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><input type="checkbox" name="checked" value="<?= $order->get_id() ?>"></td>
                <td><?= $order->get_id() ?></td>
                <td><?= $order->get_billing_first_name() ?> <?= $order->get_billing_last_name() ?></td>
                <td><?= $order->get_data()['total'] ?></td>
                <td><a href="<?= $order->get_edit_order_url() ?>" target="_blank" class="button button-secondary">Ver</a></td>
                <td><button class="btProc button button-primary" onclick="aOrder(this, <?= $order->get_id() ?>)"><span>Processar </span></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>
</div>

<script type="text/javascript">

var i = 0;


function orders(element) {

    var load = jQuery('<span class="spin spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="spin sr-only">Loading...</span>');

    jQuery(element).prop("disabled",true).find('span').append(load);

    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_orders',
            type: 'all'
        },
        success: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            window.location.reload();
        },

        error: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            window.location.reload();

        }
    });

};



function selectOrders(element) {

    var load = jQuery('<span class="spin spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="spin sr-only">Loading...</span>');

    jQuery(element).prop("disabled",true).find('span').append(load);

    var ids = jQuery('input[name="checked"]:checked').map(function() {
        return this.value;
    }).get()

    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_orders',
            orderId: ids,
        },
        success: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            window.location.reload();
        },

        error: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            window.location.reload();

        }
    });

};





function aOrder(element, id){
    i++;

    jQuery('#processa').prop("disabled",true);

    var load = jQuery('<span class="spin spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="spin sr-only">Loading...</span>');

    jQuery(element).prop("disabled",true).find('span').append(load);

    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_orders',
            orderId: [id],
        },

        success: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            if(--i == 0){
                window.location.reload();
            }
        },

        error: function (output) {
            jQuery(element).prop("disabled",false).find('.spin').remove();
            if(--i == 0){
                window.location.reload();
            }
        }
    });
}





</script>