<?php

class Pages extends Controller
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        $this->view('pages/login');
    }

    public function home()
    {
        $food = $this->db->readAll('food');

        $category = $this->db->readAll('category');
        $data = [
            'food' => $food,
            'category' => $category
        ];
        $this->view('pages/home', $data);
    }

    public function categories()
    {
        $category = $this->db->readAll('category');
        $data = [

            'category' => $category
        ];
        $this->view('pages/categories', $data);
    }


    public function foods()
    {
        $food = $this->db->readAll('food');

        $data = [

            'food' => $food
        ];
        $this->view('pages/foods', $data);
    }


    public function view_order()
    {

        $this->view('pages/view_order');
    }


    public function profile()
    {

        $this->view('pages/profile');
    }

    public function login()
    {
        $this->view('pages/home');
    }


    public function register()
    {
        $this->view('pages/register');
    }


    public function township()
    {
        $this->view('pages/township_list');
    }

    public function edit_profile()
    {
        $this->view('pages/edit_profile');
    }


    public function street()
    {
        $this->view('pages/street_name_list');
    }

    public function address()
    {
        $this->view('pages/address_list');
    }

    public function price()
    {
        $this->view('pages/price_list');
    }
}
