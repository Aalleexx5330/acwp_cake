<?php

namespace App\Controller;

use App\Model\Table\UsersTable;
use Authentication\AuthenticationService;

class SiteController extends AppController
{
    public function index()
    {
        $login_logout = $this->Authentication->getResult();
        if ($login_logout->isValid()) 
        {
            $login_logout = '<li class="nav-right" class="nav"><a href="users/logout">Logout</a></li>';
            $register = '';
        }
        else
        {
            $login_logout = '<li class="nav-right" class="nav"><a href="users/login">Login</a></li>'; 
            $register     = '<li class="nav-right" class="nav"><a href="users/add">Registrieren</a></li>';
        }

        $this->set(compact('login_logout', 'register'));


    }

    public function view($slug = null)
{
    $site = $this->user->findBySlug($slug)->firstOrFail();
    $this->set(compact('site'));
}
}