<?php

namespace MyMovies\DAO;

use MyMovies\Domain\Movie;
use MyMovies\Domain\Category;

class MovieDAO extends DAO
{
    /**
     * @var \MyMovie\DAO\CategoryDAO
     */
    private $categoryDAO;

    public function setCategoryDAO(CategoryDAO $categoryDAO) {
        $this->categoryDAO = $categoryDAO;
    }

    /**
     * Renvoie la liste de tous les movies, triés par nom 
     *
     * @return array La liste de tous les movies
     */
    public function findAll() {
        $sql = "select * from movie";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $movies = array();
        foreach ($result as $row) {
            $movieId = $row['mov_id'];
            $movies[$movieId] = $this->buildDomainObject($row);
        }
        return $movies;
    }
    /**
     * Renvoie un movie à partir de son identifiant
     *
     * @param integer $id L'identifiant du movie
     *
     * @return \GSB\Domain\movie|Lève une exception si aucun movie ne correspond
     */
    public function find($id) {
        $sql = "select * from movie where mov_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun film ne correspond à l'identifiant " . $id);
    }
    
    protected function buildDomainObject($row) {
        $movie = new movie();
        $movie->setId($row['mov_id']);
        $movie->setTitle($row['mov_title']);
        $movie->setDescriptionShort($row['mov_description_short']);
        $movie->setDescriptionLong($row['mov_description_long']);
        $movie->setDirector($row['mov_director']);
        $movie->setYear($row['mov_year']);
        $movie->setImage($row['mov_image']);
        
        if (array_key_exists('cat_id', $row)) {
            $categoryId = $row['cat_id'];
            $category = $this->categoryDAO->find($categoryId);
            $movie->setCategory($category);
        }
   
        return $movie;
    }
    
    
}