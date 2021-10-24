<!DOCTYPE html>
<html>
    <head>
    <title>Verificar se é positivo ou não</title>
    </head>
<body>

<form action="controller.php" method="post">
        <h3>Verificar se o número é positivo ou negativo</h3>
        <label>Digite algum número</label> 
        <input type="number" name="num" value="<?php echo  $num1;?>">
        <input type="submit" name="submit" value="verificar">
</form>
</body>
</html>
