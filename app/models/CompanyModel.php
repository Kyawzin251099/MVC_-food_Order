<?php

class CompanyModel
{
    // Access Modifier = public, private, protected
    private $id;
    private $name;
    private $image;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            "name" => $this->getName(),
            "image" => $this->getImage()
        ];
    }
}
