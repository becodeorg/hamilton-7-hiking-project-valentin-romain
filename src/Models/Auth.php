<?php
declare(strict_types=1);

class Auth extends Database
{
    public function create(string $first_name, string $last_name, string $nick_name, string $email, $password):void {
        if (!$this->query(
            "INSERT INTO users(first_name, last_name, nick_name, email, password, is_admin) VALUES (?, ?, ?, ?, ?, 0)",
            [
                $first_name,
                $last_name,
                $nick_name,
                $email,
                $password,
            ]
        )) {
            throw new Exception('Error during registration.');
        }
    }

    public function find(string $login):array {
        if (!$login = $this->query(
            "SELECT * FROM users WHERE ? IN (email, nick_name)",
            [
                $login,
            ]
        )->fetch()) {
            throw new Exception('Failed login attempt : connection error.');
        }
        return $login;
    }
}