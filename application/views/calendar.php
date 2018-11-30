<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');
//var_dump($servicos);
?>
<div class="container">

  <div class="row">  
    <?php $this->load->view('commons/side_menu'); ?>
    <h3><?php if(isset($message_error)) { echo $message_error;} ?></h3>
    <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;} ?></h3>
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
        <form id="novo_servico" action="<?php echo base_url()?>index.php/Servico/novo_servico" method="POST">
        <div class="row">    

          <div class="col-md-3 form-group control">
            <label for="dia">Data:</label>
            <input type="text" class="form-control" name="dia" id="dia" readonly/>
          </div>
          <div class="col-md-3 form-group control">
            <label for="inicio">Horário Inicio:</label>
            <input type="time" class="form-control" id="inicio" name="inicio" value="08:00"
                  required />
          </div>
          <div class="col-md-3 form-group control">
            <label for="fim">Horário Final:</label>
            <input type="time" class="form-control" id="fim" name="fim" value="12:00"
                  required />
          </div>
          
        </div>


        <div class="row">
          <div class="col-md-4 form-group control">
            <label for="cliente">Cliente:</label>
            <select class="cliente_modal" name="cliente">
              <?php foreach($clientes as $c){
                echo "<option value=".$c->id_cliente.">".$c->nome_cliente."</option>";
              }?>
            </select>
          </div>

          <div class="col-md-3 form-group control">
            <label for="servico">Tipo Servico:</label>
            <select class="tipo_servico_modal" name="tipo_servico">
              <?php foreach($tipo_servico as $tp){
                echo "<option value=".$tp->id_tipo_servico.">".$tp->desc_tipo_servico." R$ ".$tp->valor_tipo_servico."</option>";
              }?>
            </select>
          </div>
          <div class="col-md-3 form-group control">
            <label for="desconto">Desconto: (%)</label>
            <input type="number" class="form-control" name="desconto" id="desconto" value="0.0" class="form-group">
          </div>
         
        </div>

        <div class="row">
          <div class="col-md-4 form-group control">
            <label for="equip">Equipamento:</label>
            <select class="equip form-control" name="equip">
              <?php foreach($equipamentos as $eq){
                echo "<option value=".$eq->id_equipamento.">".$eq->nome_equipamento." => ".$eq->desc_equipamento."</option>";
              }?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 form-group control">
              <label for="dias_semana">Dias da Semana</label><br>
              <input type="radio" name="dias_semana" id="dias_1" value="1" checked> Dia único <br>
              <input type="radio" name="dias_semana" id="dias_2" value="2"> Dois Dias <br>
              <input type="radio" name="dias_semana" id="dias_3" value="3"> Três Dias <br>
          </div>
          <div class="col-md-4 form-group control" id="dias_semana" style="display:none">
            <label for="dias_name">Informe os dias da Semana</label>
            <input type="checkbox" name="dia_seg" id="dia_seg" value="Mon"> SEG <br>
            <input type="checkbox" name="dia_ter" id="dia_ter" value="Tue"> TER <br>
            <input type="checkbox" name="dia_qua" id="dia_qua" value="Wed"> QUA <br>
            <input type="checkbox" name="dia_qui" id="dia_qui" value="Thu"> QUI <br>
            <input type="checkbox" name="dia_sex" id="dia_sex" value="Fri"> SEX <br>
            <input type="checkbox" name="dia_sab" id="dia_sab" value="Sat"> SAB <br>
            <input type="checkbox" name="dia_dom" id="dia_dom" value="Sun"> DOM <br>
          </div>
          <div class="col-md-4 form-group control">
            <label for="desc">Descrição do Serviço:</label>
            <input type="text" class="form-control" name="desc" id="desc">
          </div>

        </div>
      </form>   

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" form="novo_servico" value="Cadastrar" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>
 
<?php
$this->load->view('commons/footer');
?>