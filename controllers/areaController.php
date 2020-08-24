<?php

include_once('../dao/Area.php');
include_once('../dao/Melhoria.php');

use DAO\Area;
use DAO\Melhoria;



if (isset($_POST['method']) && $_POST['method'] == 'find') {

    try {
        //code...
        if (isset($_POST['area_id'])) {
            $result = Area::getInstance()->findArea($_POST['area_id']);
            $ret_json = array('id' => $result->id, 'descricao' => $result->descricao);
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
        if (isset($_POST['descricao']) && isset($_POST['area_id'])) {
            $ret = Area::getInstance()->atualizaArea($_POST['descricao'], $_POST['area_id']);
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo 0;
    }
}


if (isset($_POST['method']) && $_POST['method'] == 'delete' && isset($_POST['area_id'])) {
    try {
        //code...
        $retArea = Melhoria::getInstance()->findArea($_POST['area_id']);
        if (!isset(($retArea))) {
            $ret = Area::getInstance()->deleteArea($_POST['area_id']);
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        }
        else{
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
        if (isset($_POST['descricao'])) {
            $ret = Area::getInstance()->adicionaArea($_POST['descricao']);
            if (isset($ret)) {
                echo 1;
            } else {
                echo 0;
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo 0;
    }
}
