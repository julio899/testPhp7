<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App</title>
	<link rel="stylesheet" href="<?php echo URL_HOST; ?>src/assets/css/bootstrap.min2.css">
<?php
/**
 * Condicionados
 */
if (isset($_SESSION['log']) && $_SESSION['log'] === 0)
{
    echo '<link rel="stylesheet" href="' . URL_HOST . 'src/assets/css/login.css">';
}

if ($_SESSION['page'] === '/' || $_SESSION['page'] === 'home')
{
    echo '<link rel="stylesheet" href="' . URL_HOST . 'src/assets/css/heroic-features.css" rel="stylesheet">';
}
?>
	<link rel="stylesheet" href="<?php echo URL_HOST; ?>src/assets/css/custom.css">
	<!--favicon-->
	<link rel="shortcut icon" href="<?php echo URL_HOST; ?>src/assets/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo URL_HOST; ?>src/assets/favicon.ico" type="image/x-icon">
</head>
<body>
