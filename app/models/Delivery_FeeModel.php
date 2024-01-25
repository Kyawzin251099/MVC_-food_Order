<?php

class Delivery_FeeModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $city_id;
    private $township_id;
    private $street_id;
    private $delivery_company_id;
    private $deliveryPrice_id;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCityId($city_id)
    {
        $this->city_id = $city_id;
    }
    public function getCityId()
    {
        return $this->city_id;
    }

    public function setTownshipId($township_id)
    {
        $this->township_id = $township_id;
    }
    public function getTownshipId()
    {
        return $this->township_id;
    }

    public function setStreetId($street_id)
    {
        $this->street_id = $street_id;
    }
    public function getStreetId()
    {
        return $this->street_id;
    }

    public function setDeliveryCompanyId($delivery_company_id)
    {
        $this->delivery_company_id = $delivery_company_id;
    }
    public function getDeliveryCompanyId()
    {
        return $this->delivery_company_id;
    }

    public function setDeliveryPriceId($deliveryPrice_id)
    {
        $this->deliveryPrice_id = $deliveryPrice_id;
    }
    public function getDeliveryPriceId()
    {
        return $this->deliveryPrice_id;
    }

    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            "city_id" => $this->getCityId(),
            "township_id" => $this->getTownshipId(),
            "street_id" => $this->getStreetId(),
            "deliveryCompany_id" => $this->getDeliveryCompanyId(),
            "deliveryPrice_id" => $this->getDeliveryPriceId()
        ];
    }
}
