<?php
class Delivery_Fee extends Controller
{
    private $db;
    public function __construct()
    {
        $this->model('Delivery_FeeModel');

        $this->db = new Database();
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $city_id = $_POST['city'];
            $township_id = $_POST['township'];
            $street_id = $_POST['street'];
            $company_id = $_POST['company_id'];
            $price_id = $_POST['price_id'];

            $delivery_fee = new Delivery_FeeModel();
            $delivery_fee->setCityId($city_id);
            $delivery_fee->setTownshipId($township_id);
            $delivery_fee->setStreetId($street_id);
            $delivery_fee->setDeliveryCompanyId($company_id);
            $delivery_fee->setDeliveryPriceId($price_id);

            $companyCreated = $this->db->create('delivery_price', $delivery_fee->toArray());
            // print_r($companyCreated);
            // exit;
            redirect('dashboard/delivery_fee');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['deliveryPrice_id'];
            $street_id = $_POST['street_id'];
            $township_id = $_POST['township_id'];
            $city_id = $_POST['city_id'];
            $company_id = $_POST['deliveryCompany_id'];
            $price_id = $_POST['price'];
            // echo $price_id;
            // exit;

            $delivery_fee = new Delivery_FeeModel();
            $delivery_fee->setId($id);
            $delivery_fee->setStreetId($street_id);
            $delivery_fee->setTownshipId($township_id);
            $delivery_fee->setCityId($city_id);
            $delivery_fee->setDeliveryCompanyId($company_id);
            $delivery_fee->setDeliveryPriceId($price_id);

            $companyCreated = $this->db->update('delivery_price', $delivery_fee->getId(), $delivery_fee->toArray());
            // print_r($companyCreated);
            // exit;
            redirect('dashboard/delivery_fee');
        }
    }

    public function deliverfee_Edit($id)
    {
        $delivery_price = $this->db->getByPriceId('vw_deliveryprice', $id);

        $data = [
            'delivery_price' => $delivery_price,
        ];
        $this->view('delivery_fee/edit', $data);
    }
}
