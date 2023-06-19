<table class="form-table">
    <tr>
        <th><label for="token_url">URL do token:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="token_url" name="token_url" value="<?= PIACS\Settings::get('token_url') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="client_id">Client ID:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="client_id" name="client_id" value="<?= PIACS\Settings::get('client_id') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="client_secret">Client Secret:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="client_secret" name="client_secret" value="<?= PIACS\Settings::get('client_secret') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="scope">Scope:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="scope" name="scope" value="<?= PIACS\Settings::get('scope') ?>">
        </td>
    </tr>

    <tr>
        <th><label for="establishment">Código do Estabelecimento:</label></th>
        <td>
            <input type = 'text' class="regular-text" id="establishment" name="establishment" value="<?= PIACS\Settings::get('establishment') ?>">
        </td>
    </tr>    
</table>