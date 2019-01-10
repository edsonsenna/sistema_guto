<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');
$message_fdbd = $this->session->flashdata('message_fdbd');
//var_dump($equipamentos);
//var_dump($clientes);

//Falta colocar id oculta e implementar func att no banco.
?>

<div class="container">
    <div class="row">
    <?php $this->load->view('commons/side_menu'); ?>
        <div class="col-md-8">
            <h3><?php if(isset($message_error)) { echo $message_error;} ?></h3>
            <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;} ?></h3>
            <form action="<?php echo base_url()?>index.php/Service/<?php if(isset($cliente)) { echo 'update_service_type'; } else { echo 'new_service_type';} ?>" method="POST">
                    <h3>Cadastro de Tipos de Serviços</h3>
                    <input style="display:none;" type="text" class="form-control" id="id" name="id" value="<?php if(isset($service_type)){
                            echo $service_type->service_type_id;
                        } ?>">

                    <div class="form-group">
                        <label for="desc">Descrição do Serviço</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Digite a descrição" value="<?php if(isset($service_type)){
                            echo $service_type->service_type_description;
                        } ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="valor">Valor Unitário do Servico</label>
                        <input type="number" class="form-control" id="value" name="value" placeholder="R$ 0,00" value="<?php if(isset($service_type)){
                            echo $service_type->service_type_value;
                        } ?>">
                    </div>
                    <button type="submit" class="btn btn-default"><?php if(isset($tipo_servico)){
                            echo 'Atualizar';
                        }else { echo 'Cadastrar'; } ?></button>
                </div>
            </form>   

        </div>


        <script>
            $('.alert').alert();
        </script>

    </div>
</div>

<?php $this->load->view('commons/footer'); ?>