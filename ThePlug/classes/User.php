<?php

class User
{
    private $pdo;

    private $id;
    private $email;
    private $password;
    private $fullName;
    private $isAdmin;
    private $createdAt;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setId($id) { $this->id = $id; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setFullName($name) { $this->fullName = $name; }
    public function setIsAdmin($isAdmin) { $this->isAdmin = $isAdmin; }
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }


    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getFullName() { return $this->fullName; }
    public function isAdmin() { return $this->isAdmin == 1; }
    public function getCreatedAt() { return $this->createdAt; }

    // creates a user
    public function create($email, $password, $isAdmin = 0)
    {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)");
        return $stmt->execute([$email, $hashed, $isAdmin]);
    }

    // gets a user by ID
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Gets all users
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // update users
    public function update($id, $fullName, $isAdmin)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET full_name = ?, is_admin = ? WHERE id = ?");
        return $stmt->execute([$fullName, $isAdmin, $id]);
    }

    // delete user
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // authenticate login
    public function authenticate($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    // Get only admins
    public function getAdmins()
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE is_admin = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
