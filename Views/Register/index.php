<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Manager</title>

    <link rel="stylesheet" href="/sass/Login.css">
    <style>
        div.error{
            background-color: red;
            color: white;
            padding: 10px;
            margin: 10px auto;
            border-radius: 4px;
        }

        div.error.off{
            display: none;
        }
        div.error.one{
            display: flex;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="error <?= $this->error ? 'on' : 'off' ?>">
            An error occurred processing your request try again later.
        </div>
        <div class="login-header">
            <h1>Register as the Manager</h1>

        </div>
        <form action="" method="post">
            <div>
                <span class="error <?= $this->name ? "on" : 'off'?>">
                    The username must be 6 or more characters long.
                </span>
                <input type="text" name="username" id="username" placeholder="Register your username.">
            </div>
            <div>
                <span class="error <?= $this->email ? "on" : 'off'?>">That email is incorrectly typed.</span>
                <input type="email" name="email" id="email" placeholder="Register your email.">
            </div>
            <div>
                <span class="error <?= $this->password ? "on" : 'off'?>">The password must be 8 or more characters long.</span>
                <input type="password" name="password" id="password" placeholder="Register your password.">
            </div>
            <div>
                <span class="error <?= $this->rePassword ? "on" : 'off'?>">The password must be the same as the first.</span>
                <input type="password" name="re-password" id="re-password" placeholder="Re-enter your password to confirm.">
            </div>
            <div>
                <input type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>