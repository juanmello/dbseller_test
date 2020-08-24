<?php

namespace DAO;

include_once('Database.php');

class Area extends Database
{

    const TABLE = 'area';
    protected static $oInstance;

    function atualizaArea($descricao, $id)
    {

        $dbst = $this->db->prepare(" UPDATE " . static::TABLE . " set descricao = :descricao WHERE ID = :id");
        $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);
        $dbst->bindValue(':id', $id, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }


    function adicionaArea($descricao)
    {
        if ($descricao != null) {

            $dbst = $this->db->prepare(" SELECT * FROM " . static::TABLE . " WHERE descricao = :descricao");
            $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);

            $result = $this->execute($dbst);

            if ($result == null) {
                $dbst = $this->db->prepare(" INSERT INTO " . static::TABLE . "(descricao) values (:descricao)");
                $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);
                $this->execute($dbst);
                return 1;
            }
            return 0;            
        }
    }

    function deleteArea($idArea)
    {
        $dbst = $this->db->prepare(" DELETE FROM " . static::TABLE . " WHERE ID = :id ");
        $dbst->bindValue(':id', $idArea, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }


    function findArea($id)
    {
        $dbst = $this->db->prepare(" SELECT * FROM " . static::TABLE . " WHERE id = :id ");
        $dbst->bindValue(':id', $id, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }


    function findAreaDescricao($desc)
    {
        $dbst = $this->db->prepare(" SELECT * FROM " . static::TABLE . " WHERE descricao = :desc ");
        $dbst->bindValue(':desc', $desc, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }
}
