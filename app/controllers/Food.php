<?php
require_once APPROOT . '../config/config.php';
class Food extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('FoodModel');

        $this->db = new Database();
    }

    public function create()
    {
        $food = $this->db->readAll('food');

        $data = [
            'food' => $food,
        ];
        $this->view('food/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $categoryId = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            $msg = "";
            $image = $_FILES['image']['name'];
            $target = "food_images/" . basename($image);

            if (!file_exists('food_images/')) {
                mkdir('food_images/', 0777, true);
            }


            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }


            $food = new FoodModel();

            $food->setTitle($title);

            $food->setDescription($description);

            $food->setPrice($price);

            $food->setcategoryId($categoryId);

            $food->setImage($image);

            $food->setFeatured($featured);

            $food->setActive($active);

            $foodCreated = $this->db->create('food', $food->toArray());

            setMessage('success', 'Create successful!');
            redirect('dashboard/food');
        }
    }

    public function edit($id)
    {
        $category = $this->db->readAll('category');
        // print_r($types);

        $food = $this->db->getById('food', $id);
        // print_r($category);

        $data = [
            'category' => $category,
            'food' => $food
        ];

        $this->view('food/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $currentImage = $_POST['image'];

            $msg = "";
            $image = $_FILES['image']['name'];

            if ($image) {
                if (!file_exists('food_images/')) {
                    mkdir('food_images/', 0777, true);
                }
                $target = "food_images/" . basename($image);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                } else {
                    $msg = "Failed to upload image";
                }

                if ($currentImage) {
                    $removePath = "food_images/" . $currentImage;
                    if (file_exists($removePath)) {
                        unlink($removePath);
                    }
                }
            } else {
                $image = $currentImage;
            }

            $categoryId = $_POST['category'];

            if (isset($_POST['featured'])) {
                //get the value from form radio
                $featured = $_POST['featured'];
            } else {
                //default valuse
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }


            // echo $name;

            $food = new FoodModel();
            $food->setId($id);
            $food->setTitle($title);
            $food->setDescription($description);
            $food->setPrice($price);
            $food->setImage($image);
            $food->setcategoryId($categoryId);

            $food->setFeatured($featured);
            $food->setActive($active);

            $isUpdated = $this->db->update('food', $food->getId(), $food->toArray());

            setMessage('success', 'Update successful!');
            redirect('dashboard/food');
        }
    }

    public function destroy($id)
    {
        $id = base64_decode($id);

        $food = new FoodModel();
        $food->setId($id);

        $isdestroy = $this->db->delete('food', $food->getId());
        redirect('dashboard/food');
    }
}
