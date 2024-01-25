<?php
class Category extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('CategoryModel');

        $this->db = new Database();
    }

    public function index()
    {
        $category = $this->db->readAll('category');
        $data = [
            'category' => $category,
        ];
        $this->view('category/table', $data);
    }

    public function create()
    {
        $category = $this->db->readAll('category');
        // print_r($category);
        $data = [
            'category' => $category,
            'index' => 'category'
        ];
        // print_r($data);
        $this->view('category/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];

            $msg = "";
            $image = $_FILES['image']['name'];
            $target = "category_images/" . basename($image);
            // echo $target;
            // die();

            if (!file_exists('category_images/')) {
                mkdir('category_images/', 0777, true);
            }


            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            }

            // $featured = $_POST['featured'];

            // $active = $_POST['active'];

            $category = new CategoryModel();

            $category->setTitle($title);

            $category->setImage($image);

            $category->setActive($active);

            $categoryCreated = $this->db->create('category', $category->toArray());

            setMessage('success', 'Create successful!');
            redirect('dashboard/categories');
        }
    }

    public function edit($id)
    {
        $category = $this->db->readAll('category');
        // print_r($category);
        // exit;

        $category = $this->db->getById('category', $id);
        // print_r($category);

        $data = [
            'category' => $category,

        ];

        $this->view('category/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            $title = $_POST['title'];
            $currentImage = $_POST['image'];
            // echo $currentImage;
            // exit;

            $msg = "";
            $image = $_FILES['image']['name'];


            if ($image) {
                if (!file_exists('category_images/')) {
                    mkdir('category_images/', 0777, true);
                }
                $target = "category_images/" . basename($image);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                } else {
                    $msg = "Failed to upload image";
                }

                if ($currentImage) {
                    $removePath = "category_images/" . $currentImage;
                    if (file_exists($removePath)) {
                        unlink($removePath);
                    }
                }
            } else {
                $image = $currentImage;
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            $category = new CategoryModel();
            $category->setId($id);
            $category->setTitle($title);
            $category->setImage($image);
            $category->setActive($active);

            $isUpdated = $this->db->update('category', $category->getId(), $category->toArray());
            // echo $isUpdated;
            setMessage('success', 'Update successful!');
            redirect('dashboard/categories');
        }
    }



    public function destroy($id)
    {
        $id = base64_decode($id);

        $category = new CategoryModel();
        $category->setId($id);


        $isdestroy = $this->db->delete('category', $category->getId());
        redirect('dashboard/categories');
    }
}
