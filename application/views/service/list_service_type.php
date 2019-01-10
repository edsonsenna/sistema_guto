<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');

?>

<script src='<?php echo base_url(); ?>/assets/js/comandos.js'></script>
<div class="container">
 <?php $this->load->view('commons/side_menu'); ?>
 <div class="col-md-8">
    <h2>Listar Clientes</h2>
    <div class="row">
        <div class="col-md-3">
            <form action="#" method="get">
                <div class="input-group">
                    <input class="form-control" id="system-search" name="q" placeholder="Procurar por" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        </br></br></br></br>
        <div class="col-md-9">
            <table class="table table-list-search">
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Valor Unitário</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($service_type as $ts){ ?>
                            <tr class="bg-success">
                                <td><?php echo $ts->service_type_id?></td>
                                <td><?php echo $ts->service_type_description?></td>
                                <td>R$ <?php echo $ts->service_type_value?>,00</td>
                                <td><a href="<?php echo base_url()?>index.php/Service/edit_service_type/<?php echo $ts->service_type_id?>">Editar</a></td>
                                <td><a href=""
                                onclick="confirm_delete(<?php echo '\'Service\', \'delete_service_type\', '.$ts->service_type_id?>);">Excluir</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>

</div>

<?php $this->load->view('commons/footer'); ?>