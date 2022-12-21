<?php
declare(strict_types=1);
class Hikes extends Database
{
    public function findAll():array|false {
        try {
            return $this->query('SELECT * FROM hikes LIMIT 20')->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public function find(string $id):array|false {
        try {
            return $this->query(
                "SELECT name, creation_date, distance, duration, elevation_gain, description, updated_at FROM hikes WHERE id = ?",
                [
                    $id
                ]
            )->fetch();
        }
        catch (Exception $e) {
            echo $e->getMessage() . "<br><a href='/'>Get back home</a>, <a href='login?id=" . $code . "'>log in</a> or <a href='register?id=" . $code . "''>register</a>.";
            return [];
        }
    }

    public function create(string $name, string $creation_date, float $distance, float $duration, float $elevation_gain, string $description):void {
        if (!$this->query(
            "INSERT INTO hikes(name, creation_date, distance, duration, elevation_gain, description) VALUES (?, ?, ?, ?, ?, ?)",
            [
                $name,
                $creation_date,
                $duration,
                $distance,
                $elevation_gain,
                $description,
            ]
        )) {
            throw new Exception('Error during creation.');
        }
    }

    public function update(string $name, float $distance, float $duration, float $elevation_gain, string $description, string $updated_at, int $id):void {
        if (!$this->query(
            "UPDATE hikes SET name = ?, duration = ?, distance = ?, elevation_gain = ?, description = ?, updated_at = ? WHERE id = ?",
            [
                $name,
                $duration,
                $distance,
                $elevation_gain,
                $description,
                $updated_at,
                $id
            ]
        )) {
            throw new Exception('Error during registration.');
        }
    }

    public function delete(string $id) {
        $this->query("DELETE FROM hikes WHERE id = ?",
        [
            $id
        ]);
    }
}