<?php
    session_start();

    require_once "classes/User.class.php";

    if (isset($_POST['ok'])):

        $login = filter_input(INPUT_POST, "user", FILTER_SANITIZE_MAGIC_QUOTES);
        $senha = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_MAGIC_QUOTES);

        $l = new User;
        $l->setUser($login);
        $l->setPass($senha);

        if($l->login()):
            header("Location: dashboard.php");
        else:
            $erro = '<span for="" class="label label-danger"> Erro no Login </span>';
        endif;
    endif;


    if(isset($_SESSION['login'])):
        header("Location: dashboard.php");
    else:
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <title>Login</title>
        <style>
            .login-page {
                width: 360px;
                padding: 8% 0 0;
                margin: auto;
            }
            .form {
                position: relative;
                z-index: 1;
                background: #FFFFFF;
                max-width: 360px;
                margin: 0 auto 100px;
                padding: 45px;
                text-align: center;
                box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
                font-family: "Montserrat", sans-serif;
                outline: 0;
                background: #f2f2f2;
                width: 100%;
                border: 0;
                margin: 0 0 15px;
                padding: 15px;
                box-sizing: border-box;
                font-size: 14px;
            }
            .form .button {
                font-family: "Montserrat", sans-serif;
                text-transform: uppercase;
                outline: 0;
                background: #474e5d;
                width: 100%;
                border: 0;
                padding: 15px;
                color: #FFFFFF;
                font-size: 14px;
                -webkit-transition: all 0.3 ease;
                transition: all 0.3 ease;
                cursor: pointer;
            }

            .btn{
                border:0px solid transparent; /* this was 1px earlier */
            }   
        
            body {
                background: #474e5d;
                font-family: "Montserrat", sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;      
            }
        </style>
    </head>
    <body>

        <div class="login-page">
                <div class="form">
                    <form action="" method="POST" class="login-form">
                        <?php echo isset($erro) ? $erro : ''; ?>
                        <input type="text" name="user" placeholder="username"/>
                        <input type="password" name="pass" placeholder="password"/>
                        <input type="submit" name="ok" class="button" value="Login"/>
                    </form>

                    <a href="index.html" style="display: inline-block;text-decoration: none;" class="button">SITE</a>     
                </div>
        </div>
        <?php
            endif;
        ?>
    </body>
</html>