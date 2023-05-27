<!DOCTYPE html>
<html>
    <head>
        <title> Tabuada </title>
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
            <label>Monte sua tabuada</label>
            <input type="number" name="variavel" placeholder="Digite algum número">
            <input type="submit" name="tabuada" value="calcular">
        </form>
    </body>
</html>
