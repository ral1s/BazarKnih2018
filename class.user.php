<?php

class USER
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }


    public function register($umail, $upass)
    {
        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);   // šifrování hesla

            $stmt = $this->db->prepare("INSERT INTO users(user_email,user_pass) 
                                                       VALUES(:umail, :upass)");


            $stmt->bindparam(":umail", $umail);
            $stmt->bindparam(":upass", $new_password);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function login($umail, $upass)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE user_email=:umail LIMIT 1");
            $stmt->execute(array(':umail' => $umail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($upass, $userRow['user_pass'])) {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}

?>