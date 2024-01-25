<?php

class Order extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('OrderModel');
        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $food_id = $_POST['food_id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "3";
            $user_id = $_POST['user_id'];
            $address_id = $_POST['user_address'];
            $company_id = $_POST['company'];
            $delivery_fees = $_POST['delivery_fee'];

            $user_addressId = $this->db->getByUserAddress('vw_userprofileupdate', $address_id);
            $user_address = $user_addressId['address_id'];

            // print_r($user_addressId);
            // exit;
            $order = new OrderModel();

            $order->setFoodId($food_id);
            $order->setQty($qty);
            $order->setTotal($total);
            $order->setOrderDate($order_date);
            $order->setStatusId($status);
            $order->setUserId($user_id);
            $order->setAddressId($user_address);
            $order->setCompanyId($company_id);
            $order->setFoodPriceId($delivery_fees);


            $iscreated = $this->db->create('order', $order->toArray());

            redirect('pages/view_order');
        }
    }

    public function edit($id)
    {

        $food_id = $this->db->getById('food', $id);
        $orderDetails = $this->db->readAll('users');
        $data = [
            'food' => $food_id,
            'users' => $orderDetails
        ];
        $this->view('pages/orders', $data);
    }

    public function orderEdit($id)
    {
        $order = $this->db->getByIdView('vw_orderall', $id);

        $data = [
            'order' => $order,
        ];
        $this->view('order/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['order_id'];
            $food_id = $_POST['food_id'];
            $qty = $_POST['qty'];
            $total = $_POST['total'];
            $order_date = $_POST['date'];
            $status = $_POST['status'];
            $user_id = $_POST['user_id'];
            $address_id = $_POST['address_id'];
            $company_id = $_POST['deliveryCompany_id'];
            $delivery_fees = $_POST['fee'];


            $order = new OrderModel();

            $order->setId($id);
            $order->setFoodId($food_id);
            $order->setQty($qty);
            $order->setTotal($total);
            $order->setOrderDate($order_date);
            $order->setStatusId($status);
            $order->setUserId($user_id);
            $order->setAddressId($address_id);
            $order->setCompanyId($company_id);
            $order->setFoodPriceId($delivery_fees);


            $isUpdated = $this->db->update('`order`', $order->getId(), $order->toArray());

            // print_r($isUpdated);
            // exit;
            redirect('dashboard/order');
        }
    }

    public function destroy($id)
    {
        $id = base64_decode($id);

        $order = new OrderModel();
        $order->setId($id);

        $isdestroy = $this->db->delete('`order`', $order->getId());
        // print_r($isdestroy);
        // exit;
        redirect('dashboard/order');
    }
}
