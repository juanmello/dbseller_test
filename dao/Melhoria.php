<?php

namespace DAO;

include_once('Database.php');

class Melhoria extends Database
{

    const TABLE = 'melhorias';
    protected static $oInstance;

    public function findArea($idArea)
    {
        $dbst = $this->db->prepare(" SELECT * FROM " . static::TABLE . " WHERE area = :id");
        $dbst->bindValue(':id', $idArea, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }

    public function filtrarPorUrgencia($urgencia, $fields = null)
    {
        if (is_array($urgencia)) {
            return $this->filtrar('urgencia IN (' . implode(', ', $urgencia) . ')', null, $fields);
        }

        $whereValues = [];

        $where                   = 'urgencia = :urgencia';
        $whereValues['urgencia'] = $urgencia;

        return $this->filtrar($where, $whereValues, $fields);
    }


    public function getFull()
    {
        $dbst = $this->db->prepare("select m.area , m.demanda_legal , m.descricao , m.gravidade , m.id, m.prazo_acordado ,
                                    m.prazo_legal ,m.tarefa ,m.tendencia ,m.urgencia 
                                    , a.descricao descArea , a.id idArea
                                    , g.descricao descGravidade , g.id idGravidade
                                    , u.descricao descUrgencia , u.id idUrgencia
                                    , t.descricao descTendencia , t.id idTendencia
                                    from melhorias m left join area a on m.area = a.id
                                    left join config.gravidade g on g.id = m.gravidade
                                    left join config.tendencia t on t.id = m.tendencia 
                                    left join config.urgencia u on u.id = m.urgencia ");

        return $this->execute($dbst);
    }



    function atualizaMelhoria($tarefa, $descricao, $demanda_legal, $prazo_acordado, $prazo_legal, $gravidade, $urgencia, $tendencia, $area, $id)
    {
        try {
            $dbst = $this->db->prepare("UPDATE " . static::TABLE . " set 
                                        tarefa = :tarefa,
                                        descricao = :descricao,
                                        demanda_legal = :demanda_legal, 
                                        prazo_acordado = :prazo_acordado, 
                                        prazo_legal = :prazo_legal, 
                                        gravidade = :gravidade, 
                                        urgencia = :urgencia, 
                                        tendencia = :tendencia, 
                                        area = :area 
                                        WHERE ID = :id");

            $dbst->bindValue(':tarefa', $tarefa, \PDO::PARAM_STR);
            $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);
            $dbst->bindValue(':demanda_legal', $demanda_legal, \PDO::PARAM_STR);
            $dbst->bindValue(':prazo_acordado', $prazo_acordado, \PDO::PARAM_STR);
            $dbst->bindValue(':prazo_legal', $prazo_legal, \PDO::PARAM_STR);
            $dbst->bindValue(':gravidade', $gravidade, \PDO::PARAM_STR);
            $dbst->bindValue(':urgencia', $urgencia, \PDO::PARAM_STR);
            $dbst->bindValue(':tendencia', $tendencia, \PDO::PARAM_STR);
            $dbst->bindValue(':area', $area, \PDO::PARAM_STR);
            $dbst->bindValue(':id', $id, \PDO::PARAM_STR);

            return $this->execute($dbst);
            return 1;
        } catch (\Throwable $th) {
            //throw $th;
            echo 0;
        }
    }



    function adicionaMelhoria($tarefa, $descricao, $demanda_legal, $prazo_acordado, $prazo_legal, $gravidade, $urgencia, $tendencia, $area)
    {
        try {
            $dbst = $this->db->prepare(" INSERT INTO " . static::TABLE .
                "(tarefa, descricao, demanda_legal, prazo_acordado, prazo_legal, gravidade, urgencia, tendencia, area) 
        values 
        (:tarefa, :descricao, :demanda_legal, :prazo_acordado, :prazo_legal, :gravidade, :urgencia, :tendencia, :area)");

            $dbst->bindValue(':tarefa', $tarefa, \PDO::PARAM_STR);
            $dbst->bindValue(':descricao', $descricao, \PDO::PARAM_STR);
            $dbst->bindValue(':demanda_legal', $demanda_legal, \PDO::PARAM_STR);
            $dbst->bindValue(':prazo_acordado', $prazo_acordado, \PDO::PARAM_STR);
            $dbst->bindValue(':prazo_legal', $prazo_legal, \PDO::PARAM_STR);
            $dbst->bindValue(':gravidade', $gravidade, \PDO::PARAM_STR);
            $dbst->bindValue(':urgencia', $urgencia, \PDO::PARAM_STR);
            $dbst->bindValue(':tendencia', $tendencia, \PDO::PARAM_STR);
            $dbst->bindValue(':area', $area, \PDO::PARAM_STR);

            return $this->execute($dbst);
            return 1;
        } catch (\Throwable $th) {
            //throw $th;
            echo 0;
        }
    }



    function deleteMelhoria($idItem)
    {
        $dbst = $this->db->prepare(" DELETE FROM " . static::TABLE . " WHERE ID = :id ");
        $dbst->bindValue(':id', $idItem, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }


    function findMelhoria($idItem)
    {
        $dbst = $this->db->prepare(" SELECT * FROM " . static::TABLE . " WHERE id = :id ");
        $dbst->bindValue(':id', $idItem, \PDO::PARAM_STR);

        return $this->execute($dbst);
    }
}
