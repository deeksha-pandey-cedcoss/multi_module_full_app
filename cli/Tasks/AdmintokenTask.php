<?php

declare(strict_types=1);

namespace MyApp\Tasks;

use Phalcon\Cli\Task;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;

class AdmintokenTask extends Task
{
    public function mainAction()
    {

        echo 'This is the default task and the default action' . PHP_EOL;
    }
    public function tokenAction($name, $email, $pass, $role)
    {

        $signer  = new Hmac();
        $builder = new Builder($signer);
        $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';
        $builder
        ->setSubject($role)
        ->setPassphrase($passphrase);
        $tokenObject = $builder->getToken();
        
        echo 'This is the token for role is ' . PHP_EOL;
        echo $tokenObject->getToken();
        $token=$tokenObject->getToken();

        $collection = $this->mongo->Users;
    
        $arr = [
            "name" => $name,
            "email" => $email,
            "password" => $pass,
            "role" => $role,
            "token" => $token,
        ];
    
        $status = $collection->insertOne($arr);

        
    }
}
