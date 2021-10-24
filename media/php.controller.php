<?PHP
  $notas = array(
    $var1 = $_POST['var1'],
    $var2 = $_POST['var2'],
    $var3 = $_POST['var3'],
  );
  

  if (isset($_POST['submit'])) { //verifica se foi cliclado
    $soma = ($var1 + $var2 + $var3);
    //$length = count($notas);
    //$length = sizeof($notas);
    $media = ($soma / count($notas));
    print '<h1> Sua média aritimética (arrendodada) é: '.round($media).'</h1>';
    print '<h1> Sua média aritimética Real é: '.$media.'</h1>';
 }
 header("refresh: 4; index.php");
 echo "<h1>Você será redirecionado em alguns segundos para a página anterior</h1>";

?>