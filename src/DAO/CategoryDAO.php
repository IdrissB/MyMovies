<?php

namespace MyMovies\DAO;

use MyMovies\Domain\Category;

class CategoryDAO extends DAO
{

    public function findAll() {
        $sql = "select * from category";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $categorys = array();
        foreach ($result as $row) {
            $categoryId = $row['cat_id'];
            $categorys[$categoryId] = $this->buildDomainObject($row);
        }
        return $categorys;
    }

    public function find($id) {
        $sql = "select * from category where cat_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun type ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet Category à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \MyMovie\Domain\Category
     */
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setId($row['cat_id']);
        $category->setName($row['cat_name']);
        return $category;
    }
}