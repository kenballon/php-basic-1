<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {

        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();

        if ($user) {

            if (password_verify($password, $user['password'])) {

                $this->login([
                    'email' => $user['email'],
                ]);

                return true;
            }
        }
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $this->getUserIdByEmail($user['email']),
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();

        header('Location: /login');
        exit();
    } 
    
    public function getUserIdByEmail($email) {
        $db = App::resolve(Database::class);
        return $db->query('select * from users where email = :email', [
            'email' => $email,
        ])->find()['id'];
    }
}
