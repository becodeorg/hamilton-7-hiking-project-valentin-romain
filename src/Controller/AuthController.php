<?php
declare(strict_types=1);

class AuthController
{
    private Auth $authModel;
    public function __construct() {
        $this->authModel = new Auth();
    }
    public function register(array $input): void
    {
        try {
            if (empty($input['first_name']) || empty($input['last_name']) || empty($input['nick_name']) || empty($input['email']) || empty($input['password'])) {
                throw new Exception('Form data not validated.');
            }
            $firstName = htmlspecialchars($input['first_name']);
            $lastName = htmlspecialchars($input['last_name']);
            $nickName = htmlspecialchars($input['nick_name']);
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            $password = password_hash($input['password'], PASSWORD_DEFAULT);

            $this->authModel->create($firstName, $lastName, $nickName, $email, $password);

            $id = $this->authModel->getLastInsertId();

            $_SESSION['user'] = [
                "id" => $id,
                'username' => $nickName,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
                'admin' => false
            ];

            http_response_code(302);
            header('location: /');
        }
        catch (Exception $e) {
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
        }
    }

    public function showRegistrationForm(): void
    {
        include 'View/includes/header.view.php';
        include 'View/Sub.php';
        include 'View/includes/footer.view.php';
    }

    public function login(array $input)
    {
        try {
            if (empty($input) || empty($input['login']) || empty($input['password'])) {
                throw new Exception('Form data not validated.');
            }

            // Sanitize/validate input
            $login = htmlspecialchars($input['login']);
            $password = htmlspecialchars($input['password']);

            $user = $this->authModel->find($login);

            if (!password_verify($password, $user['password'])) {
                throw new Exception("Failed login attempt : wrong password");
            }

            $_SESSION['user'] = [
                "id" => $user['id'],
                'username' => $user['nick_name'],
                'firstname' => $user['first_name'],
                'lastname' => $user['last_name'],
                'email' => $user['email'],
                'admin' => $user['is_admin']
            ];

            // Then, we redirect to the home page
            http_response_code(302);
            if (!empty($_GET)) {
                header('location: /hike?id='.$_GET['id']);
            }
            header('location: /');
        }
        catch (Exception $e) {
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
            include 'View/Login.php';
        }
    }

    public function showLoginForm():void
    {
        include 'View/includes/header.view.php';
        include 'View/Login.php';
        include 'View/includes/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);

        header('location: /');
    }
}