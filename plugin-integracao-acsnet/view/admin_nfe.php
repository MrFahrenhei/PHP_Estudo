<table class="form-table">
<?php 
   $size = PIACS\Database::getTableSize('nfe'); 
?>
    <?php if(!is_null($size)): ?>
        <tr>
            <th><label for="log_size">Tamanho da tabela de cache de NFe:</label></th>
            <td>
                <?= $size ?> MB
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <th><label for="nfe_url">URL de busca da NFe no WebService:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="nfe_url" name="nfe_url" value="<?= PIACS\Settings::get('nfe_url') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="live_cache_nfe">Dias de Vida do Cache das NFes:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="live_cache_nfe" name="live_cache_nfe" value="<?= PIACS\Settings::get('live_cache_nfe') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="max_cache_nfe">Máximo de registros de Cache das NFes:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="max_cache_nfe" name="max_cache_nfe" value="<?= PIACS\Settings::get('max_cache_nfe') ?>">
        </td>
    </tr>
</table>