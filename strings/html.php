<?php
$nome = "campo";
$dede = 'cam" /> <script>alert("test");</script>';
?>
<input type="text" name"<?= $nome ?>/>
<input type="text" name"<?= $dede ?>/>
<input type="text" name"<?= addslashes($dede) ?>/>
<input type="text" name"<?= htmlentities($dede) ?>/>
