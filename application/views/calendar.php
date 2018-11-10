<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');

?>
<div class="container">

  <div class="row">  
    <?php $this->load->view('commons/side_menu'); ?>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <div class="col-md-8" id='calendar'></div>
  </div>
  


<div class="modal fade" id="criarServico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="criarServicoTitle">Cadastrar Serviço</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo base_url()?>index.php/Servico/cria_servico" method="POST">
        <div class="row">    

          <div class="col-md-3 form-group control">
            <label for="dia">Data:</label>
            <input type="text" class="form-control" name="dia" id="dia" readonly/>
          </div>
          <div class="col-md-3 form-group control">
            <label for="saida">Horário Inicio:</label>
            <input type="time" class="form-control" id="inicio" name="inicio" value="08:00"
                  required />
          </div>
          <div class="col-md-3 form-group control">
            <label for="chegada">Horário Final:</label>
            <input type="time" class="form-control" id="final" name="final" value="12:00"
                  required />
          </div>
          
        </div>


        <div class="row">
          <div class="col-md-4 form-group control">
            <label for="busca">Cliente:</label>
            <select class="cliente_modal" name="cliente">
              <?php foreach($clientes as $c){
                echo '<option value=\"'.$c->id_cliente.'\">'.$c->nome_cliente.'</option>';
              }?>
            </select>
          </div>

          <div class="col-md-3 form-group control">
            <label for="busca">Tipo Servico:</label>
            <select class="tipo_servico_modal" name="tipo_servico">
              <?php foreach($tipo_servico as $tp){
                echo '<option value=\"'.$tp->id_tip_servico.'\">'.$tp->desc_tipo_servico.' R$ '.$tp->valor_tipo_servico.'</option>';
              }?>
            </select>
          </div>
          <div class="col-md-3 form-group control">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
         
          
        </div>
  



  
      
      </form>   

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Cadastrar" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>
 
<?php
$this->load->view('commons/footer');
?>