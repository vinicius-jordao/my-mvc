<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

</head>

<body>

    <h1> Este é o topo </h1>

    <a href="<?php echo BASE_URL; ?>">home</a>
    <a href="<?php echo BASE_URL; ?>about">about</a>

    <hr>

    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

</body>

</html>