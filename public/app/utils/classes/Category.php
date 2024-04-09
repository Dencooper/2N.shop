<?php

namespace CT275\Project;

use PDO;

class Category
{
    private ?PDO $db;

    private int $id = -1;
    public $name;
    public $created_at;
    public $updated_at;
    private array $errors = [];

    public function getId(): int
    {
        return $this->id;
    }
    public function getDb(): ?PDO
    {
        return $this->db;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Category
    {
        $this->name = $data['name'] ?? '';
        return $this;
    }

    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $name = trim($this->name);
        if (!$name) {
            $this->errors['name'] = 'Tên danh mục không hợp lệ!';
        }

        return empty($this->errors);
    }

    public function all(): array
    {
        $categories = [];
        $statement = $this->db->prepare('select * from categories');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $category = new Category($this->db);
            $category->fillFromDB($row);
            $categories[] = $category;
        }

        return $categories;
    }
    protected function fillFromDB(array $row): Category
    {
        [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ] = $row;
        return $this;
    }
    public function countProduct($category_id): int
    {
        $statement = $this->db->prepare('select count(*) from products where category_id = :category_id');
        $statement->execute(['category_id'=> $category_id]);
        return $statement->fetchColumn();
    }
    public function save(): bool
    {
        $result = false;
        if ($this->id >= 0) {
            $statement = $this->db->prepare(
            'update categories set name = :name,
            updated_at = now() where id = :id'
            );
            $result = $statement->execute([
                'name' => $this->name,
                'id' => $this->id]);
        } else {
            $statement = $this->db->prepare(
                'insert into categories (name, created_at, updated_at)
                values (:name, now(), now())'
            );
            $result = $statement->execute([
                'name' => $this->name,
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
                }
            }
        return $result;
    }

    public function find(int $id): ?Category
    {
        $statement = $this->db->prepare('select * from categories where id = :id');
        $statement->execute(['id' => $id]);
        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }

        return null;
    }
    public function update(array $data): bool
    {
        $this->fill($data);
        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
    public function delete(): bool
    {
        $statement = $this->db->prepare('delete from categories where id = :id');
        return $statement->execute(['id' => $this->id]);
    }
}