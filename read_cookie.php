<?php

//Inclui as bibliotecas necessárias
require ('./lib/Browser/Browser.php');

if (isset($_COOKIE['remember_me'])) {
	$cookie = base64_decode($_COOKIE['remember_me']);
	
	$cookieArray = unserialize($cookie);
	
	$userName = $cookieArray[0];
	$signature = $cookieArray[1];
//=============================================
//Impressão dos dados
?>
<table border="1"> 
	<tr> 
		<td>Username:</td> 
		<td><?= $userName ?></td> 
	</tr> 
	<tr> 
		<td>Assinatura:</td> 
		<td><?= $signature ?></td> 
	</tr> 
</table>
<?php
}
