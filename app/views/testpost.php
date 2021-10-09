<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main {
            box-shadow: 0 0 10px rgba(0,0,0,.15);
            border-radius: 5px;
        }
        .main h1 {
            padding: 5px 15px;
            margin: 0;
            border-radius: 5px 5px 0 0;
            border-bottom: solid 1px #C1c1c1;
        }
        form {
            padding: 15px;
        }
        .input {
            width: 350px;
            height: 35px;
        }
        .input:not(:last-child) {
            margin-bottom: 10px;
        }

        .input input {
            width: 100%;
            height: 100%;
            padding: 10px 15px;
            border-radius: 3px;
            border: solid 1px black;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Форма</h1>
        <form action="<?=$view->name('test_post2');?>" method="post">
            <div class="input">
                <input type="text" placeholder="Логин" name="username">
            </div>
            <div class="input">
                <input type="password" placeholder="Пароль" name="password">
            </div>
            <div class="input">
                <input type="submit">
            </div>
        </form>
    </div>
</body>
</html>