<?php
declare(strict_types=1);

class Users extends Database
{
    public function findAll(): array|false
    {
        try {
            return $this->query('SELECT * FROM users LIMIT 20')->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function find(string $code):array|false
    {
        try {
            return $this->query(
                "SELECT * FROM users WHERE id = ?",
                [
                    $code
                ]
            )->fetch();
        } catch (Exception $e) {
            echo $e->getMessage() . "<br><a href='/'>Get back home</a>, <a href='login?id=" . $code . "'>log in</a> or <a href='register?id=" . $code . "''>register</a>.";
            return [];
        }
    }
    public function findOwn():array|false
    {
        try {
            return $this->query(
                "SELECT * FROM users WHERE id = ?",
                [
                    $_SESSION['user']['id']
                ]
            )->fetch();
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
}