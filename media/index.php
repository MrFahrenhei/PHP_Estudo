<html>
<head>
 <title>Soma simples</title>
</head>
<body>

<form action="php.controller.php" method="post">
        <label>Primeiro Numero</label> 
        <input type="number" name="var1" value="<?php echo  $var1;?>">
        <label>Segundo número</label>
        <input type="number" name="var2" value="<?php echo  $var2;?>">
        <label>Terceiro Número</label>
        <input type="number" name="var3" value="<?php echo  $var3;?>">
        <input type="submit" name="submit" value="Calculate" />
</form>




</body>
</html>
