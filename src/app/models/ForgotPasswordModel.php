<?php
include_once './app/database/connect.php';
class ForgotPasswordModel extends connect
{
    public function CheckExistEmail($email) {
        $query = "SELECT * FROM customer WHERE email = '$email'";
        $result = mysqli_query($this->con, $query);
        $check = false;
        if ($row = mysqli_fetch_assoc($result)) {
            $check = true;
        }
        return $check;
    }
    function UpdatePassword($email, $password) {
        $pass = md5($password);
        $sql = "UPDATE `customer` SET `password` = '$pass' WHERE `email` = '$email'";
        $result = mysqli_query($this->con, $sql);
        return $result;
        
    }
}