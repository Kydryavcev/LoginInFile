<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User page</title>
</head>
<body>
    <div style="display: flex; ">
        <form action="<?=$_SERVER['SCRIPT_NAME']?>" style="margin-right: 20px;" method="POST">
            <p>Вход:</p><br>
            <p>Ваш логин: <input type="text" name="nameUser"></p><br>
            <p>Ваш пароль: <input type="password" name="passwordUser"></p><br>
            <input type="radio" name="saveUser" id="saveUser"><label for="saveUser">Запомнить меня</label><br><br>
            <input type="submit" name="login" value="Вход">
        </form>
        <form action="index.php" method="POST">
            <p>Регистрация:</p><br>
            <p>Введите логин: <input type="text" name="nameNewUser"></p><br>
            <p>Введите пароль пароль: <input type="password" name="passwordUser1"></p><br>
            <p>Введите пароль ёще раз: <input type="password" name="passwordUser2"></p><br>
            <input type="submit" name="registr" value="Зарегистрироваться">
        </form>        
    </div>
</body>
</html>
