<?php

if(isset($_POST['website'])) {
	
	$purpose = @file_get_contents($_POST['website']);
	if ($purpose === FALSE) {
		echo "fail";
	}
	else {
		echo $purpose;
	}
}

?>