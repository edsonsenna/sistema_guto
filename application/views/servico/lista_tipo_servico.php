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
                        <?php foreach($tipo_servico as $ts){ ?>
                            <tr class="bg-success">
                                <td><?php echo $ts->id_tipo_servico?></td>
                                <td><?php echo $ts->desc_tipo_servico?></td>
                                <td>R$ <?php echo $ts->valor_tipo_servico?>,00</td>
                                <td><a href="<?php echo base_url()?>index.php/Servico/editar_tipo_servico/<?php echo $ts->id_tipo_servico?>">Editar</a></td>
                                <td><a href="<?php echo base_url()?>index.php/Servico/excluir_tipo_servico/<?php echo $ts->id_tipo_servico?>" onclick="confirm('Deseja excluir o(a) tipo de serviço cadastrado?');">Excluir</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>

</div>

<?php $this->load->view('commons/footer'); ?>