<?php

class AddressModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $streetId;
    private $user_id;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setStreetId($streetId)
    {
        $this->streetId = $streetId;
    }
    public function getStreetId()
    {
        return $this->streetId;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }




    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            "street_id" => $this->getStreetId(),
            "user_id" => $this->getUserId()

        ];
    }
}
