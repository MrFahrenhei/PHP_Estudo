<?php 

    $var = $_POST['mult'];

    $mod = ($var % 5);

    if(isset($_POST['submit'])){
        if($mod == 0){
            echo '<h1>'.$var." é multiplo de 5 </h1>";
        }else{
            echo '<h1>'.$var." não é multiplo de 5 </h1>";
        }
    }

    header("refresh: 2; index.php");
    echo "<h1>Você será redirecionado em alguns segundos para a página anterior</h1>";

?>