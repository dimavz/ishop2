<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
</head>
<body>
<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $err_number ?></p>
<p><b>Текст ошибки:</b><?= $err_str?></p>
<p><b>Файл в котором произошла ошибка:</b><?= $err_file ?></p>
<p><b>Строка в которой произошла ошибка:</b><?= $err_line ?></p>
</body>
</html>