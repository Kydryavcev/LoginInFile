<?php
session_start();
# class connection
require_once 'vendor/liv/UserInsert.php';
require_once 'vendor/liv/UserLogin.php';
require_once 'vendor/liv/GetUsers.php';
require_once 'vendor/liv/UserDelete.php';

use vendor\liv\UserInsert;
use vendor\liv\UserLogin;
use vendor\liv\GetUsers;
use vendor\liv\UserDelete;

# display user information
if (isset($_REQUEST['static'])) 
{
    $getUsers = new GetUsers();
    $content = $getUsers -> getAll(); 
    unset($_REQUEST['static']);
}
# exit from account
if (isset($_REQUEST['exet'])) 
{
    unset($_SESSION['login']);
    setcookie ("id", "", time() - 3600);
    unset($_REQUEST['exet']);
    header("Location: ".$_SERVER["REQUEST_URI"]);
}
# user search
if (isset($_REQUEST['find'])) 
{
    $getUsers = new GetUsers();
    $infoUserFind = $getUsers->findByID($_REQUEST['ID_User']);
    unset($_REQUEST['find']);
}
# user delete
if (isset($_REQUEST['delete'])) 
{
    new UserDelete($_REQUEST['ID_User_del']);
    unset($_REQUEST['delete']);
}
# user registration
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
                new UserInsert($login, $password);
                header("Location: ".$_SERVER["REQUEST_URI"]);
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
# login to account
if (isset($_POST['login'])) 
{
    if (!empty($_REQUEST['nameUser'])) {
        if (!empty($_REQUEST['passwordUser'])) 
        {
            new UserLogin($_REQUEST['nameUser'], $_REQUEST['passwordUser']);
            header("Location: ".$_SERVER["REQUEST_URI"]);
        }else {
            echo 'Введите пароль в поле для вход';
        }
    }else {
        echo 'Введите логин в поле для вход';
    }

}
# connecting templates
if ($_SESSION['login']||$_COOKIE['id']) 
{
    require_once 'view_info.php'; # if logged in
}else {
    require_once 'view.php'; # if not logged in
}

