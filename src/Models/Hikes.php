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
    public function findAllBy(string $user):array|false {
        try {
            return $this->query('SELECT * FROM hikes WHERE created_by = ? LIMIT 20',
            [
                $user
            ])->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
    public function findAllByTag(string $tag):array|false {
        try {
            return $this->query('SELECT h.* FROM tags t JOIN hikes_tags ht ON t.id = ht.id_tags JOIN hikes h ON h.id = ht.id_hikes WHERE ht.id_tags = ? LIMIT 20',
                [
                    $tag
                ])->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
    public function find(string $id):array|false {
        try {
            return $this->query(
                "SELECT h.name, h.creation_date, h.distance, h.duration, h.elevation_gain, h.description, h.updated_at, h.created_by FROM hikes h WHERE h.id = ?",
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
    public function findAllTags(string $id):array|false {
        try {
            $stmt = $this->query('SELECT t.name, t.id FROM tags t JOIN hikes_tags ht ON t.id = ht.id_tags JOIN hikes h ON h.id = ht.id_hikes WHERE h.id = ?',
                [
                    $id
                ]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
        return $stmt->fetchAll();
    }
    public function printAllTags():array {
        try {
            $stmt = $this->query('SELECT name, id FROM tags');
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
        return $stmt->fetchAll();
    }

    public function create(string $name, string $creation_date, float $distance, float $duration, float $elevation_gain, string $description, int $userid):void {
        if (!$this->query(
            "INSERT INTO hikes(name, creation_date, distance, duration, elevation_gain, description, created_by) VALUES (?, ?, ?, ?, ?, ?, (SELECT nick_name FROM users WHERE id = ?))",
            [
                $name,
                $creation_date,
                $duration,
                $distance,
                $elevation_gain,
                $description,
                $userid
            ]
        )) {
            throw new Exception('Error during creation.');
        }
    }

    public function linkHikes(string $idHike, string $idTag): void {
        if (!$this->query("INSERT INTO hikes_tags (id_hikes, id_tags) VALUES (?, ?)", [
            $idHike,
            $idTag
        ])) {
            throw new Exception ('Something went wrong with your tags.');
        }
    }

    public function updateLinkHikes(string $idHike, string $idTag): void {
        if (!$this->query("INSERT INTO hikes_tags (id_hikes, id_tags) VALUES (?, ?)", [
            $idHike,
            $idTag
        ])) {
            throw new Exception ('Something went wrong with your tags.');
        }
    }

    public function update(string $name, float $distance, float $duration, float $elevation_gain, string $description, string $updated_at, int $id):void {
        $this->query("DELETE FROM hikes_tags WHERE id_hikes = ?", [
            $id
        ]);
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
            throw new Exception('Error during edition.');
        }
    }

    public function delete(string $id) {
        $this->query("DELETE FROM hikes_tags WHERE id = ?", [
            $id
        ]);
        $this->query("DELETE FROM hikes WHERE id = ?",
        [
            $id
        ]);
    }
}