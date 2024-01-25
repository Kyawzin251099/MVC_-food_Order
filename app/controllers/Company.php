<?php
class Company extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('CompanyModel');

        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            // echo $name;
            // exit;
            $image = $_FILES['image']['name'];
            $target = "company_images/" . basename($image);
            // echo $target;
            // die();

            if (!file_exists('company_images/')) {
                mkdir('company_images/', 0777, true);
            }


            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            $company = new companyModel();
            $company->setName($name);
            $company->setImage($image);

            $companyCreated = $this->db->create('delivery_company', $company->toArray());
            redirect('dashboard/company');
        }
    }
}
