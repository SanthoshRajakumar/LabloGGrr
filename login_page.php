
<!-- ELSA --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="style.css">
</head>

<header>
    <form action="index.php" method="POST">
        <input type="submit" value="HOME" class="button"/>
    </form>

    <form action="about.php" method="POST">
        <input type="submit" value="ABOUT" class="button"/>
    </form>

    <h1>LabLoGGr</h1>

    <form action="faq.php" method="POST">
        <input type="submit" value="FAQ" class="button"/>
    </form>

    <form action="contact.php" method="POST">
        <input type="submit" value="CONTACT" class="button"/>
    </form>

</header>

<body>
<main>
<h2>Login</h2>
<form action="/login/login.php" method="POST">
    Username: <input type="text" name="username" required/><br />
    Password: <input type="password" name="password" required /><br />
    <input type="submit" value="Login" />
</form>
</main>
</body>



