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
            $curentuser = $this->Authentication->get_current_user();

        }
        else
        {
            $login_logout = '<li class="nav-right" class="nav"><a href="users/login">Login</a></li>'; 
            $register     = '<li class="nav-right" class="nav"><a href="users/add">Registrieren</a></li>';
        }

        //Server Abfrage
        $domain =        "www.acwp-community.de";
        $adresse =       gethostbyname($domain);
        $server[0]['name'] = 'Minecraft-Server';
        $server[0]['port'] =     	 25565;
        $server[1]['name']= 'Teamspeak-Server';
        $server[1]['port'] =     	 10011;
        $timeout=        0.00001;
        
        foreach($server as $key )
        {
           $request = @fsockopen($adresse, $key['port'],$errno, $errstr, $timeout);
           if ($request)
           {
               $on_off[] = "<div>Der ". $key['name'] . " ist Online";
           }
           else
           {
               $on_off[] = "<div>Der ". $key['name'] . " ist Offline";  
           }
           
        }

        $this->set(compact('login_logout', 'register', 'on_off'));
    }

    public function view($slug = null)
    {
        $site = $this->user->findBySlug($slug)->firstOrFail();
        $this->set(compact('site'));
    }


}