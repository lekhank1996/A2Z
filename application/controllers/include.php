<?php

include("$_SERVER[DOCUMENT_ROOT]/empdash/src/main/php/Logger.php");
Logger::configure("$_SERVER[DOCUMENT_ROOT]/empdash/src/config.xml");

$session_data = $this->session->userdata('userdata');
//$empdash_id = $session_data['empdash_id'];
?>