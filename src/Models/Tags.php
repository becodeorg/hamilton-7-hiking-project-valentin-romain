<?php
declare(strict_types=1);
class Tags extends Database
{
    public function findAll(string $id):array|false {
        try {
            $stmt = $this->query('SELECT t.name FROM tags t JOIN hikes_tags ht ON t.id = ht.id_tags JOIN hikes h ON h.id = ht.id_hikes WHERE h.id = ?',
            [
                $id
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
        return $stmt->fetchAll();
    }
}