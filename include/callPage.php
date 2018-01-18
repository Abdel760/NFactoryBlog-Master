<?php

function callPage(){

	if (isset($_GET['page']) && $_GET['page'] != "") { // je verifie si l'attribut de l'url existe et n'est pas vide
		$page = "./include/" . $_GET['page'] . ".inc.php"; 
		$tableauPage = glob("./include/*.inc.php");
		if (in_array($page, $tableauPage)) {
			include($page);
			return true;	
		}	

		else {
			include("./include/default.inc.php");
			return false;
		}

	}

	else {
		include("./include/default.inc.php");
		return false;
	}

	
	
	// var_dump($tableauPage);

}



