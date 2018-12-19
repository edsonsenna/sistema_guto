<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');
$message_fdbd = $this->session->flashdata('message_fdbd');
//var_dump($equipamentos);
//var_dump($clientes);
?>

<div class="container">
    <div class="row">
    <?php $this->load->view('commons/side_menu'); ?>
        <div class="col-md-8">
            <h3><?php if(isset($message_error)) { echo $message_error;} ?></h3>
            <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;} ?></h3>
            <form action="<?php echo base_url()?>index.php/Servico/<?php if(isset($cliente)) { echo 'atualizar_tipo_servico'; } else { echo 'cria_tipo_servico';} ?>" method="POST">
                    <h3>Cadastro de Tipos de Serviços</h3>
                    <div class="form-group">
                        <label for="desc">Descrição do Serviço</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Digite a descrição" value="<?php if(isset($tipo_servico)){
                            echo $tipo_servico->desc_tipo_servico;
                        } ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="valor">Valor Unitário do Servico</label>
                        <input type="number" class="form-control" id="valor" name="valor" placeholder="R$ 0,00" value="<?php if(isset($tipo_servico)){
                            echo $tipo_servico->valor_tipo_servico;
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