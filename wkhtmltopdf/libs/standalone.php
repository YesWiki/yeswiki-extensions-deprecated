<?php

if (isset($_GET['sourceurl']) && isset($_GET['fullFilename']) ) {
	exec("./wkhtmltopdf-i386 '".$_GET['sourceurl']."' ".$_GET['fullFilename']);
}