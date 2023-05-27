<!DOCTYPE html>
<html>
    <head>
        <title>Multiplo</title>
    </head>
    <body> 
        <form action="controller.php" method="post">
            <label>Verificar se o númeor é multiplo de 5</label>
            <input type="number" name="mult" value="<?php echo  $mult;?>">
            <input type="submit" name="submit" value="verificar">
        </form>
    </body>
</html>