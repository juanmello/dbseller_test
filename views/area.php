<?php

use DAO\Area;

$areas = Area::getInstance()->order('descricao')->getAll();

?>

<div class="container" id="agenda">
    <form class="col-sm-12 col-md-12">
        <div class="form-row">
            <div class="form-group col-sm-12 col-md-12">
                <div style="margin-bottom: 10px;">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#areaModal">
                        <i class="fas fa-plus"></i>
                        Cadastrar Área
                    </a>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Área - ID</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($areas)) {
                            foreach ($areas as $area) :
                        ?>

                                <tr>
                                    <th scope="row"><?php echo $area->id; ?></th>
                                    <td><?php echo $area->descricao; ?></td>
                                    <td style="width: 230px;">
                                        <a href="#" class="btn btn-primary editArea" data-id="<?php echo $area->id; ?>">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="#" class="btn btn-primary deleteArea" onclick="return confirm(' Confirma a exclusão?');" data-id="<?php echo $area->id; ?>">
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
<div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form1" name="form1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-new-area">Cadastro/Edição de Áreas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="areaModal-id" id="areaModal-id" value=""></input>
                        <label class="" for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="areaModal-descricao" name="areaModal-descricao" placeholder="Nome/Descrição área">
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
                <h5 class="modal-title" id="modal-title-new-area">Cadastro/Edição de Áreas</h5>
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
        $('.editArea').click(function() {
            var areaId = $(this).attr('data-id');

            $.ajax({
                url: 'controllers/areaController.php',
                method: 'post',
                dataType: 'JSON',
                data: {
                    area_id: areaId,
                    method: 'find',
                },
                success: function(response) {
                    $('#areaModal').modal('show');
                    $('#areaModal-descricao').val(response.descricao);
                    $('#areaModal-id').val(response.id);
                }
            });
        });


        $('.deleteArea').click(function() {
            var areaId = $(this).attr('data-id');

            $.ajax({
                url: 'controllers/areaController.php',
                method: 'post',
                data: {
                    area_id: areaId,
                    method: 'delete',
                },
                success: function(response) {
                    
                    if (response == 1) {                        
                        $('#info').modal('show');
                        $('#textResult').text('Operação realizada com sucesso!!!');
                    }
                    else{
                        $('#info').modal('show');
                        $('#textResult').text('Operação não realizada! Área não pode ser excluída!!!');
                    }
                }
            });
        });


        $('#tag-form-submit').click(function() {

            var method_ = 'save';
            var areaId = '';
            var areaModal_descricao = $('#areaModal-descricao').val();

            if ($('#areaModal-id').val() != '') {
                areaId = $('#areaModal-id').val();
                method_ = 'edit';
            }
            $('#areaModal').modal('hide');

            $.ajax({
                url: 'controllers/areaController.php',
                method: 'post',
                data: {
                    area_id: areaId,
                    method: method_,
                    descricao: areaModal_descricao,
                },
                success: function(response) {
                    if (response == 1) {                        
                        $('#info').modal('show');
                        $('#textResult').text('Operação realizada com sucesso!!!');
                    }
                    else{
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