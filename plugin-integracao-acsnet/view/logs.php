<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="wrap">
    <h2>Listagem de Logs da Integração com o ACS.net</h2>
<br><br><br>

<?php 
    $Logs = new PIACS\Logs();

    $logs = $Logs->getAll();
?>

<table class='table table table-sm w-65'>
    <thead>
        <tr>
            <th>ID</th>
            <th>data</th>
            <th>Status</th>
            <th>Requisição</th>
            <th>Resposta</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->id ?></td>
                <td><?= $log->ts ?></td>
                <td><?= $log->code ?></td>                
                <td><button class="btProc button button-primary" onclick="show('#req_<?= $log->id ?>')">Ver</button></td>
                <td><button class="btProc button button-secondary" onclick="show('#res_<?= $log->id ?>')">Ver</button></td>
            </tr>
            <tr class="data" id="req_<?= $log->id ?>">
                <td colspan="5"><?= $log->request ?></td>
            </tr>
            <tr class="data" id="res_<?= $log->id ?>">
                <td colspan="5"><?= $log->response ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>
</div>

<style type="text/css">
    .data{
        display: none;
    }
</style>

<script type="text/javascript">

    function show(element) {
        jQuery('.data').fadeOut('fast');
        jQuery(element).fadeIn();
    };
</script>