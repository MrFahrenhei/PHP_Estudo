<?php
    $num = $_POST['num'];

    if(isset($_POST['submit'])){
        if($num >= 1){
            print '<h1>O número '.$num.' é positivo</h1>';
        } elseif($num == 0){
            print '<h1>0 não é nem negativo e nem positivo</h1>';
        }else{
            print $num.'<h1> é negativo</h1>';
        }
    }
    header("refresh: 2; index.php");
    echo "<h1>Você será redirecionado em alguns segundos para a página anterior</h1>";
?>  