<table class="form-table">
<?php 
   $size = PIACS\Database::getTableSize('logs'); 
?>
    <?php if(!is_null($size)): ?>
        <tr>
            <th><label for="log_size">Tamanho da tabela de Logs:</label></th>
            <td>
                <?= $size ?> MB
            </td>
        </tr>
    <?php endif; ?>


    <tr>
        <th><label for="live_to_log">Dias de Vida do Log:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="live_to_log" name="live_to_log" value="<?= PIACS\Settings::get('live_to_log') ?>">
        </td>
    </tr>
</table>