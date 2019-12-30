<?php 
namespace vendor\liv;

class UserDelete
{
    public $fname = "usersInfo.txt";
    
    public function __construct($id)
    {
        $data = @file($this->fname);
        $f = fopen($this->fname, "w");
        $nevData = array();
        $check = 0;
        $count = count($data);
        for ($i=0; $i < $count; $i++) 
        { 
            $result = explode ('|', $data[$i]);
            
            if ($result[0] == $id) 
            {
                unset($data[$i]);
                echo 'Пользователь успешно удалён!<br>';
                $check = 1;
                if ($_SESSION['login'] == $id) {
                    echo 'Вы удалили свой аккаунт, зарегистрируйтесь повторно.';
                    $_SESSION['login'] = false;
                }
                
            }else {
                $nevData[] = $data[$i];
            }  

        }
        
        fputs($f,implode("",$nevData));
        fclose($f);

        if (!$check) 
        {
            return 'Пользователь с указонным id не существует<br>';
        }        
    }
}
