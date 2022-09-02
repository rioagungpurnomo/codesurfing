<?php

class Session
{
    public function set_flashdata($message, $tag_open = false, $tag_close = false)
    {
        $_SESSION['flashdata'] = [
            'message' => $message,
            'tag_open' => $tag_open,
            'tag_close' => $tag_close
        ];
    }

    public function flashdata()
    {
        if (isset($_SESSION['flashdata'])) {
            return $_SESSION['flashdata']['tag_open'] . $_SESSION['flashdata']['message'] . $_SESSION['flashdata']['tag_close'];
            unset($_SESSION['flashdata']);
        }
    }

    public function set_userdata($session_data = [])
    {
        $_SESSION['cs_session'] = $session_data;
    }

    public function userdata($session_id)
    {
        return $_SESSION['cs_session'][$session_id];
    }

    public function unset_userdata($session_id)
    {
        unset($_SESSION['cs_session'][$session_id]);
    }

    public function destroy()
    {
        session_destroy();
    }

    public function destroy_all()
    {
        session_destroy();
        session_unset();
    }
}
