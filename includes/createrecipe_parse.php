<?php
	require_once("database.php");
	require_once("user.php");
	require_once("setup.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);

	if (!isset($_SESSION['username'])) {
		header("Location: ../login.php");
		exit();
	}
	if(!$_SESSION['user']->isSuperUser() && !$_SESSION['user']->isMaterialUser()){
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
	header("Location: ../create_recipe.php?success");
?>