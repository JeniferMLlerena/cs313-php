<?php

	require_once 'library/connections.php';
	require_once 'model/car-model.php';

	$suppliers = getSuppliers();

	/*$navlist = '<ul>';
	$navlist .= "<li><a href='.' title='View the SpeedX Homepage'>Home</a></li>";
	foreach ($suppliers as $supplier) {
		$navlist .= "<li><a href='.?action=$supplier[companyName]' title='View our $supplier[companyName] product line'>$supplier[companyName]</a></li>";
	}
	$navlist .= '</ul>';*/
$navlist = "<li><a href='.' title='View the Car Homepage'>Home</a></li>";
foreach ($suppliers as $supplier) {
 /*   $navlist .= '<li><a href="/PROYECT/products/index.php?action=category&type= ' . $supplier["companyname"] . ' " title=View our ' . $supplier["companyname"] . 'product line>' .$supplier["companyname"] . '</a></li>'; */
    $navlist .= '<li><a href="/PROYECT/products/index.php?action=category&type=' . $supplier["companyname"] . '" title=View our ' . $supplier["companyname"] . 'product line>' .$supplier["companyname"] . '</a></li>'; 
}

	$action = filter_input(INPUT_POST, 'action');
	if ($action == NULL){
		$action = filter_input(INPUT_GET, 'action');
		if( $action == NULL){
			$action = 'home';
		}

		switch ($action) {
			case 'home':
				include 'view/home.php';
                break;
                
			case 'login':
				include 'view/login.php';
                break;
                
            case 'registration':
				include 'view/registration.php';
                break;

			case 'error':
				include 'errordocs/500.php';
				break;
		}
	}
?>
