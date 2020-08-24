<?php


include_once('../dao/Melhoria.php');

use DAO\Melhoria;



if (isset($_POST['method']) && $_POST['method'] == 'find') {

    try {
        //code...
        if (isset($_POST['tarefa_id'])) {
            $result = Melhoria::getInstance()->findMelhoria($_POST['tarefa_id']);
            $ret_json = array(
                'id' => $result->id,
                'tarefa' => $result->tarefa,
                'descricao' => $result->descricao,
                'demanda_legal' => $result->demanda_legal,
                'prazo_acordado' => $result->prazo_acordado,
                'prazo_legal' => $result->prazo_legal,
                'gravidade' => $result->gravidade,
                'urgencia' => $result->urgencia,
                'tendencia' => $result->tendencia,
                'area' => $result->area
            );
            echo json_encode($ret_json);
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
    }
}


if (isset($_POST['method']) && $_POST['method'] == 'edit') {

    try {
        //code...
        $retDatePrazoAcordado = $retDatePrazoLegal = 0;

        if (isset($_POST['prazo_acordado'])) {
            $retDatePrazoAcordado = validaRangeData($_POST['prazo_acordado']);
        }

        if (isset($_POST['prazo_legal'])) {
            $retDatePrazoLegal = validaRangeData($_POST['prazo_legal']);
        }

        if ($retDatePrazoAcordado == 1 && $retDatePrazoLegal == 1  &&  isset($_POST['id'])) {
            $ret = Melhoria::getInstance()->atualizaMelhoria(
                $_POST['tarefa'],
                $_POST['descricao'],
                $_POST['demanda_legal'],
                $_POST['prazo_acordado'],
                $_POST['prazo_legal'],
                $_POST['gravidade'],
                $_POST['urgencia'],
                $_POST['tendencia'],
                $_POST['area'],
                $_POST['id']
            );
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo 0;
    }
}


if (isset($_POST['method']) && $_POST['method'] == 'delete' && isset($_POST['tarefa_id'])) {
    try {
        //code...
        $retMelhoria = Melhoria::getInstance()->findMelhoria($_POST['tarefa_id']);
        if (isset(($retMelhoria))) {
            $ret = Melhoria::getInstance()->deleteMelhoria($_POST['tarefa_id']);
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo 0;
    }
}


if (isset($_POST['method']) && $_POST['method'] == 'save') {
    try {
        //code...

        $retDatePrazoAcordado = $retDatePrazoLegal = 0;

        if (isset($_POST['prazo_acordado'])) {
            $retDatePrazoAcordado = validaRangeData($_POST['prazo_acordado']);
        }

        if (isset($_POST['prazo_legal'])) {
            $retDatePrazoLegal = validaRangeData($_POST['prazo_legal']);
        }

        if ($retDatePrazoAcordado == 1 && $retDatePrazoLegal == 1) {
            $ret = Melhoria::getInstance()->adicionaMelhoria(
                $_POST['tarefa'],
                $_POST['descricao'],
                $_POST['demanda_legal'],
                $_POST['prazo_acordado'],
                $_POST['prazo_legal'],
                $_POST['gravidade'],
                $_POST['urgencia'],
                $_POST['tendencia'],
                $_POST['area']
            );
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2;
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo 0;
    }
}


function validaRangeData($date)
{
    $CONTRACT_START = date('Y-m-d');
    $CONTRACT_END = date('Y') . '-12-31';

    if ($date >= $CONTRACT_START && $date <= $CONTRACT_END) {
        return 1;
    }
    return 0;
}
