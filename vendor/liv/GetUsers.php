<?php 
namespace vendor\liv;

class GetUsers
{
    public $fname = "usersInfo.txt";
    
    public function getAll()
    {
        return @file($this->fname);
    }

    public function findByID($id)
    {
        $data = @file($this->fname);
        for ($i=0; $i < count($data); $i++) 
        { 
            $result = explode ('|', $data[$i]);
            if ($result[0] == $id) 
            {
                $info = "Пользователь найден!<br>Id пользователя: ".$result[0]."<br>Логин пользователя: ".$result[1];
                return $info;
            }           
        }
        return 'Пользователь не найден<br>';
    }

}
