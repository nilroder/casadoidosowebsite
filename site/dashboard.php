<?php
    session_cache_expire(10);
	session_start();

	require_once "classes/User.class.php";

	if(isset($_GET['logout'])):
		if($_GET['logout'] == 'confirmar'):
			User::logout();
		endif;
    endif;
    
    if ( isset($_POST['ok']) ):

        $y = filter_input(INPUT_POST, "years", FILTER_SANITIZE_MAGIC_QUOTES);
        
        if($y == ''):
            $msg = 'Mês ou ano, não selecionados';
        else:
            $uploaddir = 'upload/'.$y.'/';
            
            if (!file_exists($uploaddir)):
                mkdir($uploaddir, 0777, true);
            endif;

            $uploadfile = $uploaddir.'casadoidoso-pardinho-transparencia-'.$y.'.pdf';

            if (move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)):
                $msg = 'Upload realizado com sucesso';
            else:
                $msg = 'Erro ao fazer upload. Tente novamente';
            endif;
        endif;
        echo '<script> alert("'.$msg.'");</script>';
    endif;

    if ( isset($_POST['okPass']) ):
        $o = filter_input(INPUT_POST, "oldPass", FILTER_SANITIZE_MAGIC_QUOTES);
        $n = filter_input(INPUT_POST, "newPass", FILTER_SANITIZE_MAGIC_QUOTES);
        if($o == '' || $n == ''):
            $msg = 'Preencha os campos';
        else:
             if(User::writePass($o, $n)):
                $msg = 'Senha alterada com sucesso';
             else:
                $msg = 'Erro ao alterar senha';
             endif;
        endif;
        echo '<script> alert("'.$msg.'");</script>';
    endif;
    
    if(isset($_SESSION['login'])):
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
                width: 500px;
                padding: 8% 0 0;
                margin: auto;
            }
            .form {
                display: inline-block;
                position: relative;
                z-index: 1;
                background: #FFFFFF;
                max-width: 500px;
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
                <!-- Nav Tabs -->
                <ul class="nav nav-tabs" role="tablist" id="myTabs">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li role="presentation"><a href="?logout=confirmar">Logout</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <label for="fileForm">Envie o arquivo</label>
                        <form action="" enctype="multipart/form-data" method="POST" class="form-horizontal" id="fileForm">
                            <div class="form-group">
                                <label for="years" class="col-md-2">Ano</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="years" name="years">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="file" id="files" name="files" accept="application/pdf"/>
                                </div>
                            </div>
                            <input type="submit" name="ok" class="button" value="Enviar"/>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <label for="fileForm">Alterar Senha</label>
                        <form action="" method="POST" class="form-horizontal" id="fileForm">
                            <div class="form-group">
                                <label for="years" class="col-sm-2">Senha antiga</label>
                                <div class="col-sm-10">
                                    <input type="password" id="oldPass" name="oldPass"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="years" class="col-sm-2">Senha nova</label>
                                <div class="col-sm-10">
                                    <input type="password" id="newPass" name="newPass"/>
                                </div>
                            </div>

                            <input type="submit" name="okPass" class="button" value="Enviar"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <?php
        else:
            User::logout();
        endif;
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</body>
</html>