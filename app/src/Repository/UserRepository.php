<?php

namespace App\Repository;

use App\Config\Database;
use App\Entity\User;
use PDO;

class UserRepository {
    
    public function findById(string $id): ?User {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new User();
        $user->id = $data['id'];
        $user->userName = $data['username'];
        $user->email = $data['email'];

        return $user;
    }
}
