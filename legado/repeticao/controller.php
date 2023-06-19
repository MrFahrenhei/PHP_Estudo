<?php

    $paisA = 8000;
    $paisB = 20000;

    $anos = 0;

    const CresA = 0.06;
    const CresB = 0.03;

    while($paisA < $paisB){
        $paisA = $paisA+($paisA*CresA);
        $paisB = $paisB+($paisB*CresB);
        $anos++;
    }
    if($paisA >= $paisB){
        echo '
            <style>
                form {
                    padding: 10%;
                    margin: 0;
                    font-size: 20px;
                }
            </style><form>demorará '.$anos.' anos <form>';
    }

    header("refresh: 2; index.php");
    echo "<h4>Você será redirecionado em alguns segundos para a página anterior</h4>";
?>