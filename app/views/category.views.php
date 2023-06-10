<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $vars['name'] ?? 'Null' ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/assets/css/common.css">
	<script src="<?= BASE_URL ?>/public/assets/js/jquery.js"></script>
</head>
<body>
	<header>
		<h1><?= $vars['name'] ?? 'Null' ?></h1>
	</header>
	<main>
		<h2>Data</h2>
		<?php debugPrint($vars['data']); ?>
	</main>
</body>
</html>