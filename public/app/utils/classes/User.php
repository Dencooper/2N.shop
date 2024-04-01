<?php

namespace CT275\Project;

use PDO;

class User
{
    private ?PDO $db;

    private int $id = -1;
    public $fullname;
    public $email;
    public $phone_number;
    public $address;
    public $dob;
    public $gender;
    public $password;
    public $role_id;
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

    public function fill(array $data): user
    {
        $this->fullname = $data['fullname'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone_number = $data['phone_number'] ?? '';
        $this->address = $data['address'] ?? '';
        $this->dob = $data['dob'] ?? '';
        $this->gender = $data['gender'] ?? '';
        $this->password = md5($data['password']) ?? '';
        $this->role_id = $data['role_id'] ?? '';
        return $this;
    }


    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $fullname = trim($this->fullname);
        if (!$fullname) {
            $this->errors['fullname'] = 'Invalid fullname.';
        }

        return empty($this->errors);
    }

    public function all(): array
    {
        $users = [];
        $statement = $this->db->prepare('select * from users');
        $statement->execute();
        while ($row = $statement->fetch()) {
            $user = new User($this->db);
            $user->fillFromDB($row);
            $users[] = $user;
        }

        return $users;
    }
    protected function fillFromDB(array $row): user
    {
        [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ] = $row;
        return $this;
    }
    public function count(): int
    {
        $statement = $this->db->prepare('select count(*) from users');
        $statement->execute();
        return $statement->fetchColumn();
    }
    public function paginate(int $offset = 0, int $limit = 10): array
    {
        $users = [];

        $statement = $this->db->prepare('select * from users limit :offset, :limit');
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $user = new user($this->db);
            $user->fillFromDB($row);
            $users[] = $user;
        }
        
        return $users;
    }

    public function save(): bool
    {
        $result = false;
        if ($this->id >= 0) {
            $statement = $this->db->prepare(
            'update users set role_id = :role_id, fullname = :fullname, 
            email = :email, phone_number = :phone_number, address = :address, dob = :dob, gender = :gender, password = :password, updated_at = now() where id = :id'
            );
            $result = $statement->execute([
                'role_id' => $this->role_id,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'dob' => $this->dob,
                'gender' => $this->gender,
                'password' => $this->password,
                'id' => $this->id]);
        } else {
            $statement = $this->db->prepare(
                'insert into users (fullname, email, phone_number, address, dob, gender, password, created_at, updated_at, role_id)
                values (:fullname, :email, :phone_number, :address, :dob, :gender, :password, now(), now(), :role_id)'
            );
            $result = $statement->execute([
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'dob' => $this->dob,
                'gender' => $this->gender,
                'password' => $this->password,
                'role_id' => $this->role_id
            ]);
            if ($result) {
                $this->id = $this->db->lastInsertId();
                }
            }
        return $result;
    }

    public function find(int $id): ?User
    {
        $statement = $this->db->prepare('select * from users where id = :id');
        $statement->execute(['id' => $id]);
        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }

        return null;
    }
    public function checkRegister(string $email): bool
    {
        $statement = $this->db->prepare('select * from users where email = :email');
        $statement->execute(['email' => $email]);
        if ($row = $statement->fetch()) {
            return false;
        }
        return true;
    }

    public function checkLogin(string $email, string $password): int
    {
        $statement = $this->db->prepare('select * from users where email = :email and password = :password');
        $statement->execute(['email' => $email, 'password' => md5($password)]);
        $row = $statement->fetch();
        return $row['role_id'];
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
        $statement = $this->db->prepare('delete from users where id = :id');
        return $statement->execute(['id' => $this->id]);
    }
}