<?php 
require_once './bootstrap.php';

/*
 * Start point for web interaction.
*/
$phpself = htmlspecialchars($_SERVER["PHP_SELF"]);
$convertor = new Convertor();
$convertor->start($_POST['submitedData']);
?>

<!DOCTYPE html>
  <html>
   <head>
    <title>Test - Currency Rates</title>
   </head>
   <body>
   <h1>Currency Conversion</h1>
   <?php echo $convertor->output?>
   <br /> 
   <br />
   
   <form action="<?php $phpself?>" method="post">
   <input name="submitedData" type="text" size="45"/>	
   <input type="submit" value="Convert"/>
   </form>
   	<p>Example: CONVERT 5 EUR to USD</p>
  </body>
</html>