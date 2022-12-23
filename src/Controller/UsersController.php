<?php

class UsersController
{
    private Users $usersModel;
    public function __construct() {
        $this->usersModel = new Users();
    }
    public function showOwnProfile() {
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/userProfile.view.php';
        include 'View/includes/footer.view.php';
    }

    public function showEditOwnProfile():void {
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/editProfile.view.php';
        include 'View/includes/footer.view.php';
    }

    public function sendEditOwnProfile(array $input): void {
        try {
            if (empty($input['first_name']) || empty($input['last_name']) || empty($input['nick_name']) || empty($input['email'])) {
                throw new Exception('Form data not validated.');
            }
            $firstName = htmlspecialchars($input['first_name']);
            $lastName = htmlspecialchars($input['last_name']);
            $userName = htmlspecialchars($input['nick_name']);
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            $id = $_SESSION['user']['id'];

            $this->usersModel->update($firstName, $lastName, $userName, $email, $id);

            $_SESSION['user'] = [
                "id" => $id,
                'username' => $userName,
                'firstname' => $firstName,
                'lastname' => $lastName,
                'email' => $email,
            ];

            http_response_code(302);
            header('location: /');
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
        }
    }
}