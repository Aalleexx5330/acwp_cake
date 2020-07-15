<?php

namespace App\Controller;

class SiteController extends AppController
{
    public function index()
    {
     $hello = 'Hallo';
    }

    public function view($slug = null)
{
    $site = $this->user->findBySlug($slug)->firstOrFail();
    $this->set(compact('site'));
}
}