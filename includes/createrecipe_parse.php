<?php
	require_once("setup.php");
	require_once("database.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);
	$db->openConnection();

	if (!$db->isConnected()) {
		header("Location: ../login.php?connect_error");
		exit();
	}
	if (!isset($_SESSION['username'])) {
		header("Location: ../login.php");
		exit();
	}
	if(!($db->checkSuperUser($_SESSION['username']) == "1" || $db->checkMaterialUser($_SESSION['username']) == '1')) {
		header("Location: ../index.php");
		exit();
	}
	
	$recipe = str_replace(' ', '_', $_POST['recipename']);
	$amount = 0;
	$ingredients = $db->getIngredients();
	
	if(isset($recipe)) {
		$db->addRecipe($recipe);
		foreach($ingredients as $ingredient) {
			if(isset($_POST[$ingredient['name']])) { $amount = $_POST[$ingredient['name']]; }
			$db->addRecipeIngredient($recipe, $ingredient['name'], $amount);
		}
	}
	$db->closeConnection();
	header("Location: ../create_recipe.php?success");
?>