<?php

namespace MyMovies\Domain;

class Movie 
{
    /**
     * Movie id.
     *
     * @var integer
     */
    private $id;

    /**
     * Article title.
     *
     * @var string
     */
    private $title;

    /**
     * Article content.
     *
     * @var string
     */
    private $descriptionShort;
    private $descriptionLong;
    private $director;
    private $year;
    private $image;
    
    private $category;
    
    public function getCategory() {
        return $this->category;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
    }
    
     public function __toString() {
        return $this->getTitle() .' sorti en ' . $this->getYear();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescriptionShort() {
        return $this->descriptionShort;
    }

    public function setDescriptionShort($descriptionShort) {
        $this->descriptionShort = $descriptionShort;
    }
    
    public function getDescriptionLong() {
        return $this->descriptionLong;
    }

    public function setDescriptionLong($descriptionLong) {
        $this->descriptionLong = $descriptionLong;
    }
     public function getDirector() {
        return $this->director;
    }

    public function setDirector($director) {
        $this->director = $director;
    }
     public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }
     public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
    
}