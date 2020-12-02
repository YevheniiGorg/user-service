<?php

namespace Test\request;

use Exception;
use Test\user\User;

/**
 * Model for processing requests
 */
class Request
{
    /**
     * @return mixed
     * @throws Exception
     */
    public function processingRequests()
    {
        if(isset($_SERVER['HTTP_COMMAND']) && !empty($_SERVER['HTTP_COMMAND'])){
            $user = new User();
            switch ($_SERVER['HTTP_COMMAND']) {
                case "CREATE":
                    $user->createUser($this->parseRequest());
                    break;
                case "UPDATE":
                    $user->updateUser($this->parseRequest());
                    break;
                case "GET":
                    $user->getUsers($this->parseRequest()['id']);
                    break;
                case "DELETE":
                    $user->deleteUser($this->parseRequest()['id']);
                    break;
                case "LIST":
                    $user->listUsers();
                    break;
                default:
                    throw new Exception('There is no such command!', 404);
            }
        }else{
            throw new Exception('No expected parameter!', 404);
        }

        return true;
    }

    /**
     * @return array || Exception
     */
    private function parseRequest(){
        $name = json_decode(file_get_contents("php://input"),1);
        return $name;
    }
}