<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;

class Movies
{
    private Explorer $database;

    public function __construct(Explorer $database)
    {
        $this->database = $database;

    }

    public function fetchAll(): array
    {
        return $this->database->table('movies')->fetchAll();
    }

    public function fetch(int $id)
    {
        return $this->database->table('movies')->get($id);
    }

    public function create(array $data): void
    {
        $this->database->table('movies')->insert($data);
    }

    public function update(int $id, array $data): void
    {
        $this->database->table('movies')->where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        $this->database->table('movies')->where('id', $id)->delete();
    }

    public function toArray(): array
    {
        return $this->database->table('movies')->fetchPairs('id', 'name');
    }
}