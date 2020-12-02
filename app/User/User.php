<?php

namespace Test\user;

use mysqli;

/**
 * This is the model class for table "user".
 *
 * @property mysqli $mysqli
 */
class User
{
    public $mysqli;

    function __construct()
    {
        // подключаемся к серверу
        $this->mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    /**
     * Creates a new User.
     * @param $arr array
     * @return mixed
     * @throws \Exception
     */
    public function createUser($arr)
    {
        if ($this->validate($arr)) {

            $insertQuery = "
            INSERT INTO user
            (`nick`, `password`, `role`, `additional_data`)
            VALUES (
              '" . $this->mysqli->real_escape_string($arr['nick']) ."',
              '" . $this->mysqli->real_escape_string($arr['password']) ."',
              " .array_search($arr['role'], Role::statuses()) . ",
              '" . $this->mysqli->real_escape_string($arr['additional_data']) ."'
              )";

            $res = $this->mysqli->query($insertQuery);
            if ($res === false) {
                throw new \Exception('Error in SQL query!');
            }else
                echo $res;
        }else{
            throw new \Exception('Data validation error!');
        }
    }

    /**
     * update User.
     * the user is updated by id
     * @param $arr array
     * @return mixed
     * @throws \Exception
     */
    public function updateUser($arr)
    {
        if ($this->validate($arr)) {

            $Query = "
            UPDATE `user`
            SET
            `nick` ='" . $this->mysqli->real_escape_string($arr['nick']) ."',
            `password` ='" . $this->mysqli->real_escape_string($arr['password']) ."',
            `role` =" .array_search($arr['role'], Role::statuses()) . ",
            `additional_data` ='" . $this->mysqli->real_escape_string($arr['additional_data']) ."'
           WHERE `id` = '". $arr['id'] ."'";

            $res = $this->mysqli->query($Query);
            if ($res === false) {
                throw new \Exception('Error in SQL query!');
            }else
                echo "Record updated successfully";;
        }else{
            throw new \Exception('Data validation error!');
        }
    }

    /**
     * Delete a User.
     * @param $id integer
     * @return mixed
     */
    public function deleteUser($id)
    {
        $res = $this->mysqli->query("DELETE FROM user WHERE id = $id");
        echo $res;
    }

    /**
     * returns the nickname of all users
     * @return mixed
     */
    public function listUsers()
    {
        $res = $this->mysqli->query("SELECT * FROM user");
        echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
    }

    /**
     * returns a ListUsers of all users.
     * @param $id integer
     * @return mixed
     */
    public function getUsers($id)
    {
        $res = $this->mysqli->query("SELECT * FROM user WHERE id = $id");
        echo json_encode($res->fetch_assoc());
    }

    /**
     * @param $params array
     * @return true|false
     */
    private function validate($params)
    {
        if ((isset($params['nick']) && !empty($params['nick'])) &&
        (isset($params['password']) && !empty($params['password'])) &&
        (isset($params['role']) && !empty($params['role']))) {
            //checking the length of the nickname and password
        if (strlen($params['nick']) < 3 || strlen($params['password']) < 3)
            return false;
            //checking the role for availability
        if (!array_search($params['role'], Role::statuses()))
            return false;

        return true;
    }
        return false;
    }
}