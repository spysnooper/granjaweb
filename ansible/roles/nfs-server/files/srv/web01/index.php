<?php
date_default_timezone_set ('Europe/Madrid');
echo "
	<p>
		IP loadbalancer: " . $_SERVER["REMOTE_ADDR"] . "<br>
		IP webserver: <b>" . $_SERVER['SERVER_ADDR'] . "</b><br>
		webserver Soft: " . $_SERVER["SERVER_SOFTWARE"] . "<br>
		fecha: " . date('d/m/Y') . "
		hora: " . date('h:i:s A') . "
	</p>
";
?>
