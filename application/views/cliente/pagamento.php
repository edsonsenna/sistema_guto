<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');

?>
<script>
    $(document).ready(function() {
        $('.cliente_modal').select2();
    });
</script>
<div class="container">
    <div class="row">
    <?php $this->load->view('commons/side_menu'); ?>
        <div class="col-md-8">
            <h3><?php if(isset($message_error)) { echo $message_error;} ?></h3>
            <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;} ?></h3>
            <form action="<?php echo base_url()?>index.php/Cliente/lancar_pagamento" method="POST">
                    <h3>Lançamento de Pagamento</h3>
                    <div class="row py-5">
                        <div class="col-md-4 form-group control">
                            <label for="cliente">Cliente:</label>
                            <select class="cliente_modal" name="cliente">
                            <?php foreach($clientes as $c){
                                echo "<option value=".$c->id_cliente.">".$c->nome_cliente."</option>";
                            }?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group control">
                            <label for="data">Data:</label>
                            <input class=""type="datetime" name="data" id="data" value="<?php 
                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                            date_default_timezone_set('America/Sao_Paulo');
                            echo date("d-m-Y H:i"); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="valor">Valor:</label>
                            <input type="number" name="valor" id="valor">
                        </div>
                        <div class="col-md-8">
                            <label for="desc">Descrição (Tipo Pagamento):</label>
                            <input type="text" name="desc" id="desc">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Lançar Pagamento</button>
                        </div>                        
                    </div>
                    
                    
                
                   
                    
                </div>
            </form>   

        </div>


        <script>
            $('.alert').alert();
        </script>

    </div>
</div>

<?php $this->load->view('commons/footer'); ?>