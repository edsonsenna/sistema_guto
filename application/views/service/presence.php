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
                        <?php foreach($services as $s){ 
                            $final_balance = $s->client_balance - $s->service_type_value;
                            ?>
                            <tr class="<?php if($s->client_balance - $s->service_type_value > 0) {echo 'bg-success';} else { echo 'bg-danger';} ?>">
                                <td><?php echo $s->service_id?></td>
                                <td><?php echo $s->client_name?></td>
                                <td><?php echo $s->service_name?></td>
                                <td><?php echo $s->service_start_date?></td>
                                <td><?php echo $s->service_end_date?></td>
                                <td><?php echo $s->service_creation_date?></td>
                                <td>R$ <?php echo $s->service_type_value?>,00</td>
                                <td><?php if($final_balance < 0 && $s->has_presence == '0'){ echo 'Saldo Insuficiente!'; } else if($s->has_presence == '0'){ echo 'Em aberto!';} else{ echo 'Presente!';}?></td>
                                <td><input class="btn btn-success"  type="button" value="Presença" id="presenca" onclick="ajax_presence(<?php echo $s->service_id; ?>)"
                                <?php if($s->has_presence == '1' || $final_balance < 0){ echo 'disabled';}?>></td>    
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>   
        </div>
    </div>

</div>

</div>

<?php $this->load->view('commons/footer'); ?>

