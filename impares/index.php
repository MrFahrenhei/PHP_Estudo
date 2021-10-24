<!DOCTYPE html>
<html>
    <head>
        <title> NÚMEROS IMPARES E IMPARES </title>
    </head> 
    <style>
        body{
            margin:0;
            padding:0;
        }
        form{
            padding: 10%;
        }
        label{
            padding-left: 35%;
        }
    </style>
    <body>
        <form action="controller.php" method="post">
            <label>Os números impares de 1 até 100</label>
            <input type="submit" name="submit_odd" value="mostrar">
            <br><hr><br>
            <label>Os números pares de 1 até 100</label>
            <input type="submit" name="submit_even" value="mostrar">

        </form>
    </body>
</html>
