<?php

    $base = $_POST['base'];
    $expo = $_POST['expo'];

    if(isset($_POST["submit"])){
        $poten = pow($base, $expo);
        print '<h1> A potênciação de base '.$base.' elevada a '.$expo.' é: '.$poten.'</h1>';
    }

    header("refresh: 4; index.php");
    echo "<h1>Você será redirecionado em alguns segundos para a página anterior</h1>";

?>