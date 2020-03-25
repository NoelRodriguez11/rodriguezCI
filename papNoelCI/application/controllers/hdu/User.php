<?php
class User extends CI_Controller {
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        redirect(base_url());
    }
}