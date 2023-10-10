<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="<?= HTTP ?>/assets/images/favicon.svg" type="image/x-icon" />
	<title><?= PAGE_TITLE ?></title>
	<?= LINKS ?>
	<link rel="stylesheet" href="<?= HTTP ?>/assets/styles/website.css?v=<?= CACHE ?>" />
</head>

<body>
	<?php $this->loadViewInTemplate($viewName, $viewData) ?>
</body>

</html>