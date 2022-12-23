<?php
declare(strict_types=1);

class TagsController
{
    private Tags $tagsModel;

    public function __construct() {
        $this->tagsModel = new Tags();
    }

    public function listAllTags(string $id): void {
        $tags = $this->tagsModel->findAll($id);
    }
}