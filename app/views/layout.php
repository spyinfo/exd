<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->e($title);?></title>
</head>
<body>
    <header>
        <strong>HEADER</strong>
    </header>

    <?=$this->section('content');?>

    <footer>
        <strong>FOOTER</strong>
    </footer>
</body>
</html>