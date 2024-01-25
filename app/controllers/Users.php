<?php
session_start();
class Users extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('AddressModel');
        $this->model('UserModel');
        $this->db = new Database();
    }

    public function formRegister()
    {
        if (
            $_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['email_check']) &&
            $_POST['email_check'] == 1
        ) {
            $email = $_POST['email'];
            // call columnFilter Method from Database.php
            $isUserExist = $this->db->columnFilter('users', 'email', $email);
            if ($isUserExist) {
                echo 'Sorry! email has already taken. Please try another.';
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check user exist
            $email = $_POST['email'];
            // call columnFilter Method from Database.php
            $isUserExist = $this->db->columnFilter('users', 'email', $email);


            if ($isUserExist) {
                setMessage('error', 'This email is already registered !');
                redirect('pages/register');
            } else {
                // Validate entries
                $validation = new UserValidator($_POST);
                $data = $validation->validateForm();
                if (count($data) > 0) {
                    $this->view('pages/register', $data);
                } else {
                    $name = $_POST['name'];
                    $phone_number = $_POST['phone_number'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];


                    $password = base64_encode($password);

                    $user = new UserModel();
                    $user->setName($name);
                    $user->setPhoneNumber($phone_number);
                    $user->setEmail($email);
                    $user->setPassword($password);


                    $userCreated = $this->db->create('users', $user->toArray());
                    //$userCreated="true";

                    redirect('pages/index');
                } // end of validation check
            } // end of user-exist
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];

                $password = base64_encode($_POST['password']);


                $isLogin = $this->db->loginCheck($email, $password);
                // print_r($isLogin);
                // exit;
                if ($isLogin) {
                    $_SESSION['email'] = $email;
                    if ($isLogin['role'] == 1) {
                        redirect('dashboard/home');
                    } else {
                        redirect('pages/home');
                    }
                    if ($isLogin == null) {
                        redirect('pages/index');
                    }
                    redirect('pages/home');
                }
                // if ($isLogin) {
                //     setMessage('id', base64_encode($isLogin['id']));
                //     $id = $isLogin['id'];
                //     $setLogin = $this->db->setLogin($id);
                //     redirect('pages/dashboard');
                // } else {
                //     setMessage('error', 'Login Fail!');
                //    redirect('pages/login');


                // $isEmailExist = $this->db->columnFilter('users', 'email', $email);
                // // print_r($isEmailExist);
                // exit;
                // $isPasswordExist = $this->db->columnFilter('users', 'password', $password);

                // if ($isEmailExist && $isPasswordExist) {
                //     echo "Login success";
                // } else {
                //     echo "login fail";
                // }
                // // print_r($email);
                // // print_r($password);
            }
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['user_id'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['phone_number'];
            $street_id = $_POST['street'];


            $address = new AddressModel();
            $address->setId("");
            $address->setStreetId($street_id);
            $address->setUserId($id);


            $isAddressExist = $this->db->getAddressId('address', $street_id);
            if ($isAddressExist) {
                $addressId = $isAddressExist['id'];
            } else {
                $addressCreate = $this->db->create('address', $address->toArray());
                $addressId = (int)$addressCreate;
            }


            $user = new UserModel();
            $user->setId($id);
            $user->setPassword($password);
            $user->setName($name);
            $user->setEmail($email);
            $user->setPhoneNumber($contact);



            $isUpdated = $this->db->update('users', $user->getId(), $user->toArray());
            // echo $isUpdated;
            setMessage('success', 'Update successful!');
            redirect('pages/profile');
        }
    }

    function logout($id)
    {
        // session_start();
        // $this->db->unsetLogin(base64_decode($_SESSION['id']));

        //$this->db->unsetLogin($this->auth->getAuthId());
        $this->db->unsetLogin($id);
        redirect('pages/login');
    }




    public function destroy($id)
    {
        $id = base64_decode($id);

        $user = new UserModel();
        $user->setId($id);

        $isdestroy = $this->db->delete('users', $user->getId());
        redirect('dashboard/admin');
    }
}
