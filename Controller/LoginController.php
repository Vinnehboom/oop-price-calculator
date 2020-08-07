<?php
declare(strict_types = 1);
class LoginController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        if(empty($POST)){
            $message = "Log in now! If you're not a member, you can't sign up yet because we're junior developers, that sh*t's too complicated for us";
            require 'View/login.php';
            die();
        }
        $database = new DatabaseHandler();
        $database->openConnection();
        $pdo = $database->getPdo();
        $statement = $pdo->prepare( 'SELECT * from customer where firstname = :firstname and lastname = :lastname');
        $statement->bindValue("firstname", $POST['first_name']);
        $statement->bindValue("lastname", $POST['last_name']);
        $statement->execute();
        $login_result = $statement->fetch();

        if(!$login_result){
            $message = "Login failed";
            require 'View/login.php';
        } else {
            $_SESSION['loggedIn'] = true;
            if(!isset($_SESSION['currentUser'])){
                $_SESSION['currentUser'] = new Customer($login_result['firstname'], $login_result['lastname'], (int)$login_result['id'], (int)$login_result['group_id'], $pdo);
            }
            $controller = new IndexController();
            $controller->render($GET, $POST);
        }
    }
}
