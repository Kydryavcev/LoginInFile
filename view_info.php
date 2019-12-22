<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User page</title>
</head>
<body>
<form action="index.php" method="POST">
    <input type="submit" name="exet" value="Выход с аккаунта">
    <input type="submit" name="static" value="Списк пользователей">
</form><br>
<form action="index.php" method="POST">
    <input type="text" name="ID_User" placeholder="Введите ID пользователя">
    <input type="submit" name="find" value="Найти пользователя">
</form><br>
<form action="index.php" method="POST">
    <input type="text" name="ID_User_del" placeholder="Введите ID пользователя">
    <input type="submit" name="delete" value="Удалить пользователя">
</form><br>
    <?
    if (isset($content)) 
    {
        foreach ($content as $key => $value) 
        {
            $result = explode ('|', $value);
            echo "ID пользователя: ".$result[0]." | Логин пользователя: ".$result[1]."  <br>";
        }
    }
    if (isset($infoUserFind)) {
      echo $infoUserFind;
    }
    ?>
</body>
</html>
