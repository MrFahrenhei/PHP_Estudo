<?PHP

  $var1 = $_POST['var1'];
  $var2 = $_POST['var2'];

  if (isset($_POST['submit'])) { //verifica se foi cliclado
  $soma = ($var1 + $var2);
  print $soma;
 }
 header("refresh: 1.5; index.php")

?>