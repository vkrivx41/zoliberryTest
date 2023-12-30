<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Author</title>

    <link rel="stylesheet" href="/sass/Login.css">
</head>
<body>
    <div class="page-container">
        <div class="login-header">
            <h1>Login as the Author</h1>
        </div>
        <form action="" method="post">
            <div>
                <span class="error <?= $this->name ? 'on': 'off'?>">An author with that username doesn't exist.</span>
                <input type="text" name="username" id="username" placeholder="Enter your username.">
            </div>
            <div>
                <span class="error <?= $this->password ? 'on': 'off'?>">The password you entered is incorrect.</span>
                <input type="password" name="password" id="password" placeholder="Enter your password.">
            </div>
            <div>
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>