<!DOCTYPE html>
<html>
<head>
 <title>Soma simples</title>
</head>
<body>

<form action="controller.php" method="post">
        <label>Base</label> 
        <input type="number" name="base" value="<?php echo  $base;?>">
        <label>Expoente</label>
        <input type="number" name="expo" value="<?php echo  $expo;?>">
        <input type="submit" name="submit" value="Calculate" />
</form>

</body>
</html>
