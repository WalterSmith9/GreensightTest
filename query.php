<?php

class user
{
    private static $curr_id =2;

    private $user_id;
    private $name;
    private $email;

    public function __construct(string $name, string $email)
    {
        $this->user_id = user::$curr_id;
        user::$curr_id = user::$curr_id + 1;
        $this->name = $name;
        $this->email = $email;
    }

    public function setID(int $newID)
    {
        $this->user_id = $newID;
    }

    public function getID()
    {
        return $this->user_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isEmailEqual(string $newEmail)
    {
        if ($newEmail === $this->email){
            return true;
        }
        else{
            return false;
        }
    }
}

function isPwdEqual(string $pwd, string $pwd2)
{
    {
        if ($pwd === $pwd2) {
            return true;
        } else {
            return false;
        }
    }
}

function isEmailValid($email)
{
    if (strpos($email, "@")===false) {
        return false;
    }
    else{
        return true;
    }
}

$allUsers = [
    ['id'=>1, 'name'=>'Walter', 'email'=>'Walt@rtvi.ru'],
    ['id'=>2, 'name'=>'Anthony', 'email'=>'Tony@rtvi.ru'],
    ['id'=>3, 'name'=>'Robert', 'email'=>'Rob@rtvi.ru']
];

if (isEmailValid($_POST['email']) and isPwdEqual($_POST['pwd'],$_POST['pwd2'])){
    $newUser = new user($_POST['name'], $_POST['email']);
    $emailMatch = false;
    foreach ($allUsers as $currUser){
        if ($newUser->isEmailEqual($currUser['email'])){
            $emailMatch = true;
            break;
        }
    }
    if ($emailMatch == false){
        array_push($allUsers, ['id'=>count($allUsers)+1, 'name'=>$newUser->getName(), 'email'=>$newUser->getEmail()]);
        var_dump($allUsers);
    }
}
