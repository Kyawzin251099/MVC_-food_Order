<?php

class FoodModel
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $categoryId;
    private $image;
    private $featured;
    private $active;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setcategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getcategoryId()
    {
        return $this->categoryId;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    public function getFeatured()
    {
        return $this->featured;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function toArray()
    {
        return [
            'id'    => $this->getId(),
            'title'   => $this->getTitle(),
            'description'   => $this->getDescription(),
            'price'   => $this->getPrice(),
            'category_id'   => $this->getcategoryId(),
            'image'   => $this->getImage(),
            'featured'   => $this->getFeatured(),
            'active'   => $this->getActive()
        ];
    }
}
