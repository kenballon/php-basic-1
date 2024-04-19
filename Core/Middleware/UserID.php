<?php
namespace Core\Middleware;

use Core\App;
use Core\Authenticator;

class UserID
{
    public function handle()
    {
        if (isset($_SESSION['user']) && isset($_SESSION['user']['email'])) {
            $authenticator = App::resolve(Authenticator::class);
            $userID = $authenticator->getUserIdByEmail($_SESSION['user']['email']);
            $_SESSION['user']['id'] = $userID;
        }
    }   
}