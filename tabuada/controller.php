<?php

    $num = $_POST['variavel'];

    if(isset($_POST['tabuada'])){
        for($i = 0; $i <=10; $i++){
            $calc = $num * $i;
            echo "$num X $i = $calc <br>".PHP_EOL;
        }
    }

    header("refresh: 4; index.php");
    echo "<h4>Você será redirecionado em alguns segundos para a página anterior</h4>";

?>