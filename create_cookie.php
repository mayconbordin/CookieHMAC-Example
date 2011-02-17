<?php

//Inclui as bibliotecas necessárias
require ('./lib/Browser/Browser.php');

//Instancia o objeto para obter os dados do navegador
$browser = new Browser();

//Cria uma hash com a challenge do usuário
//Poderia ser ainda a senha do usuário. Neste caso a challenge é uma chave criada
//através do sistema de login CHAP.
//http://en.wikipedia.org/wiki/Challenge-handshake_authentication_protocol
$userChallenge = hash('sha256', "User challenge hash");

//Nome do usuário
$userName = 'admin';

//Gera a chave que será usada para gerar a assinatura do usuário
$key = $browser->getBrowser().
	   $browser->getVersion().
	   $browser->getUserAgent().
	   $browser->getPlatform();
	   
//Transforma a chave em hash
//Essa chave precisa ser guardada em associação com o usuário para posterior
//verificação de autenticidade
$key = hash('sha256', $key);

//Une os dados do usuário
$data = $userChallenge . $userName;

//Cria a assinatura do usuário que servirá para autenticação
$signature = hash_hmac("sha256", $data, $key);

//Serializa os dados do cookie
$cookie = serialize(array($userName, $signature));

//Codifica o cookie
$cookie = base64_encode($cookie);

//Armazena o cookie
setcookie('remember_me', $cookie, time()+3600);

//=============================================
//Impressão dos dados
?>
<table border="1"> 
	<tr> 
		<td>Mensagem:</td> 
		<td><?= $data ?></td> 
	</tr> 
	<tr> 
		<td>Chave:</td> 
		<td><?= $key ?></td> 
	</tr> 
	<tr> 
		<td>Assinatura:</td> 
		<td><?= $signature ?></td> 
	</tr> 
</table>
