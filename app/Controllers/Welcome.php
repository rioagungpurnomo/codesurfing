<?php

class Welcome extends CS_Controller
{
    public function index()
    {
        $this->view('welcome_message');
    }
}
