<?php

if (!defined("WIKINI_VERSION")) {
            die ("acc&egrave;s direct interdit");
}

if (!function_exists("wakkaColor")) {

    function wakkaColor($things)
    {  
       return '<span class="wakkaColor" style="color:'.$things[1].'">'.$things[2].'</span>';
    }

}
$plugin_output_new = preg_replace_callback("#~~\(([^~]*)\)([^~]*)~~#", "wakkaColor", $plugin_output_new);

?>