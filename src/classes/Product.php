<?php

namespace CT275\Project;

use PDO;

class Product
{
    private ?PDO $db;

    private int $id = -1;
    public $tittle;
    public $price;
    public $discount;
    public $thumb1;
    public $thumb2;
    public $created_at;
    public $updated_at;
    private array $errors = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Product
    {
        $this->tittle = $data['tittle'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->discount = $data['discount'] ?? '';
        return $this;
    }
    public function fillThumb1(array $data): Product
    {
        $targetDir = "images/";
        $this->thumb1 = $targetDir . $data['thumb1']["name"] ?? '';
        return $this;
    }

    public function fillThumb2(array $data): Product
    {
        $targetDir = "images/";
        $this->thumb2 = $targetDir . $data['thumb2']["name"] ?? '';
        return $this;
    }


    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $tittle = trim($this->tittle);
        if (!$tittle) {
            $this->errors['tittle'] = 'Invalid tittle.';
        }

        return empty($this->errors);
    }

    public function all(): array
    {
        $products = [];
        $statement = $this->db->prepare('select * from products');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }
    protected function fillFromDB(array $row): Product
    {
        [
            'id' => $this->id,
            'tittle' => $this->tittle,
            'price' => $this->price,
            'discount' => $this->discount,
            'thumb1' => $this->thumb1,
            'thumb2' => $this->thumb2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ] = $row;
        return $this;
    }
    public function count(): int
    {
        $statement = $this->db->prepare('select count(*) from products');
        $statement->execute();
        return $statement->fetchColumn();
    }
    public function paginate(int $offset = 0, int $limit = 10): array
    {
        $products = [];

        $statement = $this->db->prepare('select * from products limit :offset, :limit');
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }
        
        return $products;
    }

    public function save(): bool
    {
        $result = false;
        if ($this->id >= 0) {
            $statement = $this->db->prepare(
            'update products set tittle = :tittle, 
            price = :price, discount = :discount, thumb1 = :thumb1, thumb2 = :thumb2,
            updated_at = now() where id = :id'
            );
            $result = $statement->execute([
                'tittle' => $this->tittle,
                'price' => $this->price,
                'discount' => $this->discount,
                'thumb1' => $this->thumb1,
                'thumb2' => $this->thumb2,
                'id' => $this->id]);
        } else {
            $statement = $this->db->prepare(
                'insert into products (tittle, price, discount, thumb1, thumb2, created_at, updated_at)
                values (:tittle, :price, :discount, :thumb1, :thumb2, now(), now())'
            );
            $result = $statement->execute([
                'tittle' => $this->tittle,
                'price' => $this->price,
                'discount' => $this->discount,
                'thumb1' => $this->thumb1,
                'thumb2' => $this->thumb2
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
                }
            }
        return $result;
    }

    public function find(int $id): ?Product
    {
        $statement = $this->db->prepare('select * from products where id = :id');
        $statement->execute(['id' => $id]);
        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }

        return null;
    }
    public function update(array $data, array $file): bool
    {
        $this->fill($data);
        $this->fillthumb1($file);
        $this->fillThumb2($file);
        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
    public function delete(): bool
    {
        $statement = $this->db->prepare('delete from products where id = :id');
        return $statement->execute(['id' => $this->id]);
    }
}