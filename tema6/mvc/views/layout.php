<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="submit" value="home" name="home">
    </form>
    <header>
        <h1>pagina web</h1>
    </header>
    <nav>
        <div>
            <form action="" method="post">
                <input type="submit" value="Login" name="login">
            </form>
        </div>
    </nav>
    <main>
        <?
        if (!isset($_SESSION['vista'])) {
            echo 'bienvenidos al login';
            require VIEW . 'home.php';
        } else
            require $_SESSION['vista'];
        ?>
    </main>
    <footer>
        copyrigth
    </footer>
</body>

</html>