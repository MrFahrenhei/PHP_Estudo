<?php 

        if(isset($_POST['submit_odd'])){
                    for($i = 1; $i <= 100; $i++){
                        if($i%2 != 0){
                            echo $i.', ';
                        }
                    }
                }

        if(isset($_POST['submit_even'])){
                    for($i = 1; $i <= 100; $i++){
                        if($i%2 == 0){
                           echo $i.', ';
                        }
                    }
                }


                header("refresh: 4; index.php");
                echo "<h4>Você será redirecionado em alguns segundos para a página anterior</h4>";

?>