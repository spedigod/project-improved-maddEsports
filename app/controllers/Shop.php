<?php declare(strict_types=1);
class Shop extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {

        $this->view('shop/index');
    }
} 