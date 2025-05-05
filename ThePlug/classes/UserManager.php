<?php

require_once 'User.php';

class UserManager {
    // list of all users stored in the database list
    private $users = [];

    // add a new user to the list
    public function addUser(User $user) {
        $this->users[$user->getId()] = $user;
    }

    // remove a user with their ID
    public function removeUser($userId) {
        if (isset($this->users[$userId])) {
            unset($this->users[$userId]);
        }
    }

    // gets a single users ID
    public function getUserById($userId) {
        return $this->users[$userId] ?? null;
    }

    // gets all users in the list
    public function getAllUsers() {
        return array_values($this->users);
    }

    // checks login credentials and return user if matched
    public function authenticate($email, $password) {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email && $user->getPassword() === $password) {
                return $user;
            }
        }
        return null;
    }
    // gets only users that are admins
    public function getAdmins() {
        return array_filter($this->users, fn($user) => $user->isAdmin());
    }
}
