<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?PHP echo isset($title) ?  $title : 'Document' ?></title>
    <link rel="stylesheet" href= "assets/css/main.css">
</head>
<body>
    <main class="h">
        <?PHP if (isset($view)) { include($view); } ?>
    </main>
</body>
</html>