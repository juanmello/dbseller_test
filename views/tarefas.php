<?php

use DAO\Area;
use DAO\Gravidade;
use DAO\Urgencia;
use DAO\Tendencia;
use DAO\Melhoria;

$areas = Area::getInstance()->order('descricao')->getAll();
$gravidades = Gravidade::getInstance()->order('descricao')->getAll();
$urgencias = Urgencia::getInstance()->order('descricao')->getAll();
$tendencias = Tendencia::getInstance()->order('descricao')->getAll();
$tarefas = Melhoria::getInstance()->order('tarefa')->getFull();

?>
<style>
.badge-pill{
    padding: 10px;
}
</style>

<div class="container" id="agenda">
    <form class="col-sm-12 col-md-12">
        <div class="form-row">
            <div class="form-group col-sm-12 col-md-12">
                <div style="margin-bottom: 10px;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tarefaModal">
                        <i class="fas fa-plus"></i>
                        Cadastrar Tarefa
                    </a>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tarefa</th>
                            <th scope="col">Prazo Acordado</th>
                            <th scope="col">Gravidade</th>
                            <th scope="col">Urgência</th>
                            <th scope="col">Tendência</th>
                            <th scope="col">Área</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($tarefas)) {
                            foreach ($tarefas as $tarefa) :
                        ?>

                                <tr>
                                    <th scope="row"><?php echo $tarefa->id; ?></th>
                                    <th scope="row"><?php echo $tarefa->tarefa; ?></th>
                                    <td><?php echo $tarefa->prazo_acordado; ?></td>
                                    <td><?php if ($tarefa->idgravidade == 5) {
                                            echo '<span class="badge badge-pill badge-danger">' . $tarefa->descgravidade . '</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-warning">' . $tarefa->descgravidade . '</span>';
                                        } ?></td>
                                    <td><?php if ($tarefa->idurgencia == 5) {
                                            echo '<span class="badge badge-pill badge-danger">' . $tarefa->descurgencia . '</span>';
                                        } else {
                                            echo '<span class="badge badge-pill badge-warning">' . $tarefa->descurgencia . '</span>';
                                        } ?></td>
                                    <td><?php echo $tarefa->desctendencia; ?></td>
                                    <td><?php echo $tarefa->descarea; ?></td>
                                    <td style="width: 230px;">
                                        <a href="#" class="btn btn-primary editItem" data-id="<?php echo $tarefa->id; ?>">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="#" class="btn btn-primary deleteItem" onclick="return confirm(' Confirma a exclusão?');" data-id="<?php echo $tarefa->id; ?>">
                                            <i class="fas fa-trash"></i>
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                        <?php endforeach;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>


<!-- Modal Inicio -->
<div class="modal fade" id="tarefaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form1" name="form1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-new-area">Cadastro/Edição de Tarefas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="" for="tarefa">Titulo</label>
                        <input type="text" class="form-control" id="tarefa" name="tarefa">
                        </input>
                    </div>
                    <div class="form-group">
                        <label class="" for="area_cmb">Área</label>
                        <select class="form-control" id="area_cmb" name="area_cmb">
                            <?php
                            if (!empty($areas)) {
                                foreach ($areas as $area) : ?>
                                    <option value="<?php echo $area->id; ?>">
                                        <?php echo $area->descricao; ?>
                                    </option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="gravidade_cmb">Gravidade</label>
                        <select class="form-control" id="gravidade_cmb" name="gravidade_cmb">
                            <?php
                            if (!empty($gravidades)) {
                                foreach ($gravidades as $gravidade) : ?>
                                    <option value="<?php echo $gravidade->id; ?>">
                                        <?php echo $gravidade->descricao; ?>
                                    </option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="urgencia_cmb">Urgência</label>
                        <select class="form-control" id="urgencia_cmb" name="urgencia_cmb">
                            <?php
                            if (!empty($urgencias)) {
                                foreach ($urgencias as $obj) : ?>
                                    <option value="<?php echo $obj->id; ?>">
                                        <?php echo $obj->descricao; ?>
                                    </option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="tendencia_cmb">Tendência</label>
                        <select class="form-control" id="tendencia_cmb" name="tendencia_cmb">
                            <?php
                            if (!empty($tendencias)) {
                                foreach ($tendencias as $obj) : ?>
                                    <option value="<?php echo $obj->id; ?>">
                                        <?php echo $obj->descricao; ?>
                                    </option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="" for="prazo_acordado">Prazo Acordado</label>
                        <input type="text" class="form-control" id="prazo_acordado" name="prazo_acordado">
                        </input>
                    </div>
                    <div class="form-group">
                        <label class="" for="prazo_legal">Prazo Legal</label>
                        <input type="text" class="form-control" id="prazo_legal" name="prazo_legal">
                        </input>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="tarefaModal-id" id="tarefaModal-id" value=""></input>
                        <label class="" for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="tarefaModal-descricao" name="tarefaModal-descricao" placeholder="Descrição Tarefa">
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" id="tag-form-submit" name="tag-form-submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal Fim -->

<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-new-area">Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="textResult"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default sucessoFechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        //datepickers!!!
        $('#prazo_acordado').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            todayHighlight: true
        });
        $('#prazo_legal').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            todayHighlight: true
        });

        $('.editItem').click(function() {
            var idItem = $(this).attr('data-id');

            $.ajax({
                url: 'controllers/tarefaController.php',
                method: 'post',
                dataType: 'JSON',
                data: {
                    tarefa_id: idItem,
                    method: 'find',
                },
                success: function(response) {
                    $('#tarefaModal').modal('show');

                    $('#tarefa').val(response.tarefa);
                    $('#prazo_acordado').val(response.prazo_acordado);
                    $('#prazo_legal').val(response.prazo_legal);

                    $('#area_cmb').val(response.area);
                    $('#gravidade_cmb').val(response.gravidade);
                    $('#urgencia_cmb').val(response.urgencia);
                    $('#tendencia_cmb').val(response.tendencia);

                    $('#tarefaModal-descricao').val(response.descricao);
                    $('#tarefaModal-id').val(response.id);
                }
            });
        });


        $('.deleteItem').click(function() {
            var itemId = $(this).attr('data-id');

            $.ajax({
                url: 'controllers/tarefaController.php',
                method: 'post',
                data: {
                    tarefa_id: itemId,
                    method: 'delete',
                },
                success: function(response) {

                    if (response == 1) {
                        $('#info').modal('show');
                        $('#textResult').text('Operação realizada com sucesso!!!');
                    } else {
                        $('#info').modal('show');
                        $('#textResult').text('Operação não realizada! Tarefa não pode ser excluída!!!');
                    }
                }
            });
        });



        ///salvar dados            
        $('#tag-form-submit').click(function() {

            var method_ = 'save';
            var id_ = '';
            var descricao_ = $('#tarefaModal-descricao').val();
            var tarefa_ = $('#tarefa').val();

            var prazo_acordado_ = $('#prazo_acordado').val();
            var prazo_legal_ = $('#prazo_legal').val() ? $('#prazo_legal').val() : '2020-12-31';

            var demanda_legal_ = $('#demanda_legal').val() ? $('#demanda_legal').val() : 0;
            var area_ = $('#area_cmb').val();
            var gravidade_ = $('#gravidade_cmb').val();
            var urgencia_ = $('#urgencia_cmb').val();
            var tendencia_ = $('#tendencia_cmb').val();

            if ($('#tarefaModal-id').val() != '') {
                id_ = $('#tarefaModal-id').val();
                method_ = 'edit';
            }
            $('#tarefaModal').modal('hide');

            $.ajax({
                url: 'controllers/tarefaController.php',
                method: 'post',
                data: {
                    id: id_,
                    area: area_,
                    tarefa: tarefa_,
                    descricao: descricao_,
                    demanda_legal: demanda_legal_,
                    prazo_acordado: prazo_acordado_,
                    prazo_legal: prazo_legal_,
                    gravidade: gravidade_,
                    urgencia: urgencia_,
                    tendencia: tendencia_,
                    method: method_
                },
                success: function(response) {
                    if (response == 1) {
                        $('#info').modal('show');
                        $('#textResult').text('Operação realizada com sucesso!!!');
                    } else if (response == 2) {
                        $('#info').modal('show');
                        $('#textResult').text('Operação não realizada a data está fora do intervalo!!!');
                    } else {
                        $('#info').modal('show');
                        $('#textResult').text('Operação não realizada!!!!');
                    }
                }
            });
        });


        $('.sucessoFechar').click(function() {
            location.reload();
        })

    });
</script>