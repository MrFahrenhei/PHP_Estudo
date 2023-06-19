<table class="form-table">

    <tr>
        <th><label for="get_url">URL de Obtenção dos produtos do WebService:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="get_url" name="get_url" value="<?= PIACS\Settings::get('get_url') ?>">
        </td>
    </tr>

    <tr>
        <th><label>Campos do webservice que NÃO serão atualizados:<br>(Desativados são itens naturalmente ignorados pela integração)</label></th>
        <td>
            <?php 
                $list = json_decode(PIACS\Settings::get('campos_ignore_get'));
                if($list === null)
                    $list = array(); 
            ?>
            <?php foreach (PIACS\Settings::getListFieldsWS() as $field): ?>

                <input type = 'checkbox' class="regular-text" id="<?= $field->text ?>" name="campos_ignore_get[]" value="<?= $field->text ?>" <?= $field->checked ?> <?= (!in_array($field->text, $list))? '' : 'checked' ?> <?= $field->disabled ?>>
                <label style="margin: 0;" for="<?= $field->text ?>"><?= $field->text ?><?= ($field->obs === null) ? '' : ' ('. $field->obs .')' ?></label>
                <br>

            <?php endforeach ?>
        </td>
    </tr>  
</table>