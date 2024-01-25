<?php

class dashboard extends Controller
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
        $this->view('backend/dashboard');
    }

    public function admin()
    {
        $user = $this->db->readAll('users');
        $data = [
            'user' => $user
        ];

        $this->view('backend/admin', $data);
    }

    public function categories()
    {
        $category = $this->db->readAll('category');
        $data = [
            'category' => $category,
        ];
        $this->view('category/table', $data);
    }

    public function addCategories()
    {
        $this->view('category/create');
    }



    public function food()
    {
        $food = $this->db->readAll('food');
        $data = [
            'food' => $food,
        ];
        $this->view('food/table', $data);
    }

    public function updateFood()
    {
        $this->view('food/edit');
    }

    public function addFood()
    {
        $categoryFood = $this->db->readAll('category');
        $data = [
            'categoryFood' => $categoryFood,
        ];
        $this->view('food/create', $data);
    }

    public function order()
    {
        $this->view('order/table');
    }

    public function orderupdate()
    {
        $this->view('order/edit');
    }

    public function company()
    {
        $company = $this->db->readAll('delivery_company');
        $data = [
            'company' => $company
        ];
        $this->view('company/table', $data);
    }

    public function delivery_company()
    {
        $this->view('company/create');
    }

    public function delivery_fee()
    {
        $this->view('delivery_fee/table');
    }

    public function add_delivery_fee()
    {
        $this->view('delivery_fee/create');
    }
    public function update_delivery_fee()
    {
        $this->view('delivery_fee/edit');
    }

    public function logout()
    {
        $this->view('backend/logout');
    }
}
