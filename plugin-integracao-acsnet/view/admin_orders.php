<?php $methods = WC()->payment_gateways()->payment_gateways() ?>
<?php //echo '<pre>'; var_dump($methods);die; ?>

<table class="form-table">

    <tr>
        <th><label for="order_url">URL de submissão da Ordem do WebService:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="order_url" name="order_url" value="<?= PIACS\Settings::get('order_url') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="cat_sub_order">Status dos pedidos para enviar ao ACSnet:</label></th>
        <td>
            <select id="cat_sub_order" name="cat_sub_order">
                <?php $cat = PIACS\Settings::get('cat_sub_order'); ?>
                <?php foreach (wc_get_order_statuses() as $key => $value): ?>
                    <option value="<?= $key ?>" <?= ($key != $cat) ? : 'selected' ?>><?= $value ?></option>
                <?php endforeach; ?>

            </select>
        </td>
    </tr>

    <tr>
        <th><label for="cat_dest_order">Status dos pedidos enviados mas em processamento no ACSnet:</label></th>
        <td>
            <select id="cat_dest_order" name="cat_dest_order">
                <?php $cat = PIACS\Settings::get('cat_dest_order'); ?>
                <?php foreach (wc_get_order_statuses() as $key => $value): ?>
                    <option value="<?= $key ?>" <?= ($key != $cat) ? : 'selected' ?>><?= $value ?></option>
                <?php endforeach; ?>

            </select>
        </td>
    </tr>

    <tr>
        <th><label for="cat_fim_order">Status final do pedido (NFe disponível para download):</label></th>
        <td>
            <select id="cat_fim_order" name="cat_fim_order">
                <?php $cat = PIACS\Settings::get('cat_fim_order'); ?>
                <?php foreach (wc_get_order_statuses() as $key => $value): ?>
                    <option value="<?= $key ?>" <?= ($key != $cat) ? : 'selected' ?>><?= $value ?></option>
                <?php endforeach; ?>

            </select>
        </td>
    </tr>


    <tr>
        <th><label for="cnpj_transp">CNPJ da Transportadora:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="cnpj_transp" name="cnpj_transp" value="<?= PIACS\Settings::get('cnpj_transp') ?>">
        </td>
    </tr>    


    <tr>
        <th><label>Métodos de pagamento que enviam CNPJ</label></th>
        <td>
            <?php 
                $list = json_decode(PIACS\Settings::get('payment_send_cnpj'));
                if($list === null)
                    $list = array(); 
            ?>
            <?php foreach ($methods as $key => $method): ?>

                <input type = 'checkbox' class="regular-text" id="<?= $key ?>" name="payment_send_cnpj[]" value="<?= $key ?>" <?= (!in_array($key, $list)) ? : 'checked' ?>>
                <label style="margin: 0;" for="<?= $key ?>"><?= $method->title ?></label>
                <br>

            <?php endforeach ?>
        </td>
    </tr>  


    <tr>
        <th><label for="cnpj_payment">CNPJ do meio de pagamento que envia CNPJ:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="cnpj_payment" name="cnpj_payment" value="<?= PIACS\Settings::get('cnpj_payment') ?>">
        </td>
    </tr>            

</table>