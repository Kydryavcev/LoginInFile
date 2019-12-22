<?php
session_start();
require_once 'vendor/liv/User.php';

use vendor\liv\User;

$user = new User();

if (isset($_REQUEST['static'])) 
{
    $content = $user->getAll(); 
    unset($_REQUEST['static']);
}

if (isset($_REQUEST['exet'])) 
{
    unset($_SESSION['login']);
    setcookie ("id", "", time() - 3600);
    unset($_REQUEST['exet']);
}

if (isset($_REQUEST['find'])) 
{
    $infoUserFind = $user->findByID($_REQUEST['ID_User']);
    unset($_REQUEST['find']);
}

if (isset($_REQUEST['delete'])) 
{
    echo $user->delete($_REQUEST['ID_User_del']);
    unset($_REQUEST['delete']);
}

if (isset($_POST['registr'])) 
{

    if (!empty($_REQUEST['nameNewUser'])) 
    { 

        if (!empty($_REQUEST['passwordUser1'])) 
        {

            if ($_REQUEST['passwordUser1'] == $_REQUEST['passwordUser2']) 
            {
                $login = $_REQUEST['nameNewUser'];
                $password = trim($_REQUEST['passwordUser1']);
                echo $user->insert($login, $password);
            }else {
                echo 'Пароли не совпадают.'; 
            }  
        }else {
            echo 'Введите пароль в поле для регистрации';
        }

     
    }else {
        echo 'Введите логин в поле для регистрации';
    }    
}

if (isset($_POST['login'])) 
{
    if (!empty($_REQUEST['nameUser'])) {
        if (!empty($_REQUEST['passwordUser'])) 
        {
            echo $user->login($_REQUEST['nameUser'], $_REQUEST['passwordUser']);
        }else {
            echo 'Введите пароль в поле для вход';
        }
    }else {
        echo 'Введите логин в поле для вход';
    }

}

if ($_SESSION['login']||$_COOKIE['id']) 
{
    require_once 'view_info.php';
}else {
    require_once 'view.php';
}

