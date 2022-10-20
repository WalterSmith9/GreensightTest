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

function isPwdEqual($pwd, $pwd2)
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

$response = 0;

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
        $log = date('Y-m-d H:i:s') . ' ' . $newUser->getEmail() . ' успешно зарегистрирован';
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
    }
    else{
        $log = date('Y-m-d H:i:s') . ' ' . $newUser->getEmail() . ' уже существует. В регистрации отказано';
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
        $response = $response + 4;

    }
}

if (isEmailValid($_POST['email'])){
    $response = $response + 1;
}

if (isPwdEqual($_POST['pwd'],$_POST['pwd2'])){
    $response = $response + 2;
}

echo ($response);


