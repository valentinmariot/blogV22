<?php

namespace App\models;

class User extends Model
{
    public function findAllUsers() : array
    {
        $resultats = $this->pdo->query("SELECT * FROM `users` ORDER BY `id` DESC");
        $users = $resultats->fetchAll();

        return $users;
    }

    public function findUser(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM `users` WHERE id = :id");
        $query->execute(['user_id' => $id]);
        $user = $query->fetch();
        
        return $user;
    }

    public function deleteUser(int $id) : void
    {
        $query = $this->pdo->prepare("DELETE FROM `users` WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}