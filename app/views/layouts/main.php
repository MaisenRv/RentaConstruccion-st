<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?PHP echo isset($title) ?  $title : 'Document' ?></title>
    <link rel="stylesheet" href= "assets/css/main.css">
    <link rel="stylesheet" href= "assets/css/home.css">
    <link rel="stylesheet" href= "assets/css/nav.css">
    <link rel="stylesheet" href= "assets/css/products.css">
</head>
<body>
    <?PHP if(!(session_status() == PHP_SESSION_NONE) && isset($_SESSION['correo']) && $title !='Login'){?>
        <header>
            <?PHP require_once 'nav.php';?>
        </header>
    <?PHP } ?>
    <main >
        <?PHP if (isset($view)) { include($view); } ?>
    </main>
    <script src="assets/js/login.js"></script>
</body>
</html>