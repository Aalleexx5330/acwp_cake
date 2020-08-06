<?php

namespace App\Controller;

class SiteController extends AppController
{
    public function index()
    {
        $session = $this->request->getSession();
        $login_logout = $this->Authentication->getResult();
        $user = $session->read('Auth.username');
        if ($login_logout->isValid()) {
            $login_logout = '<li class="nav-right" class="nav"><a href="users/logout">Logout</a></li>';
            $register =     '<li class="nav-right" class="nav"><a href="Profiles/index">' . $user. '</a></li>';
       } else {
           $login_logout = '<li class="nav-right" class="nav"><a href="users/login">Login</a></li>';
           $register     = '<li class="nav-right" class="nav"><a href="users/add">Registrieren</a></li>';
       }

        //Server Abfrage
        $domain =        "www.acwp-community.de";
        $adresse =       gethostbyname($domain);
        $server[0]['name'] = 'Minecraft-Server';
        $server[0]['port'] =          25565;
        $server[0]['online']= 'webroot\img\minecraft_online.png';
        $server[0]['offline']= 'webroot\img\minecraft_offline.png';
        $server[1]['name'] = 'Teamspeak-Server';
        $server[1]['port'] =          10011;
        $server[1]['online'] = 'webroot\img\ts_online.png';
        $server[1]['offline'] = 'webroot\img\ts_offline.png';
        $timeout =        1;

        foreach ($server as $key) {
            $request = @fsockopen($adresse, $key['port'], $errno, $errstr, $timeout);
            if ($request) {
                $on_off[] = "<img src=".$key['online'] . " alt= " .$key['name'] . " ist Online>";
            } else {
                $on_off[] = "<img src=".$key['offline'] . " alt= " .$key['name'] . " ist Offline>";
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
