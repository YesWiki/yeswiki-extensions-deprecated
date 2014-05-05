<?php

if (isset($_GET['sourceurl']) && isset($_GET['fullFilename']) ) {
	//test if sourceurl is a valid url
	if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_GET['sourceurl'])) {
		exec(escapeshellcmd("./wkhtmltopdf-i386 '".$_GET['sourceurl']."' ".$_GET['fullFilename']));
	}
}