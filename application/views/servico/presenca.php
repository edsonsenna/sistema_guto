<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');
//var_dump($servicos);
?>

<script src='<?php echo base_url(); ?>/assets/js/comandos.js'></script>
<div class="container">
 <?php $this->load->view('commons/side_menu'); ?>
 <div class="col-md-8">
    <h2>Lista de Presença - <?php echo date('d-m-Y');?></h2>
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
                            <th>Cliente</th>
                            <th>Descricao</th>
                            <th>Data Inicio</th>
                            <th>Data Fim</th>
                            <th>Data Cadastro</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Presença</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($servicos as $s){ 
                            $saldo_final = $s->saldo_cliente - $s->valor_tipo_servico;
                            ?>
                            <tr class="<?php if($s->saldo_cliente - $s->valor_tipo_servico > 0) {echo 'bg-success';} else { echo 'bg-danger';} ?>">
                                <td><?php echo $s->id_servico?></td>
                                <td><?php echo $s->nome_cliente?></td>
                                <td><?php echo $s->desc_servico?></td>
                                <td><?php echo $s->data_inicio_servico?></td>
                                <td><?php echo $s->data_vencimento_servico?></td>
                                <td><?php echo $s->data_cadastro_servico?></td>
                                <td>R$ <?php echo $s->valor_tipo_servico?>,00</td>
                                <td><?php if($saldo_final < 0){ echo 'Saldo Insuficiente!'; } else if($s->status_presenc == '0'){ echo 'Em aberto!';} else{ echo 'Presente!';}?></td>
                                <td><input class="btn btn-success"  type="button" value="Presença" id="presenca" onclick="dar_presenca(<?php echo $s->id_servico; ?>)"
                                <?php if($s->status_presenc == '1' || $saldo_final < 0){ echo 'disabled';}?>></td>    
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>

</div>

<?php $this->load->view('commons/footer'); ?>