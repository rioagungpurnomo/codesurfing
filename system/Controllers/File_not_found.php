<?php

class File_not_found extends CS_Controller
{
    public function index()
    {
        $this->view('error_404');
    }
}
