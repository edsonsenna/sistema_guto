<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('commons/header');

?>

<div class="container">
    <div class="row">
    <?php $this->load->view('commons/side_menu'); ?>
        <div class="col-md-8">
            <h3><?php if(isset($message_error)) { echo $message_error;} ?></h3>
            <h3><?php if(isset($message_fdbd)) { echo $message_fdbd;} ?></h3>
            <form action="<?php echo base_url()?>index.php/Cliente/<?php if(isset($cliente)) { echo 'atualizar_cliente'; } else { echo 'cria_cliente';} ?>" method="POST">
                    <h3>Cadastro de Motorista</h3>
                    <?php
                        if(isset($cliente)){
                            echo '<input type="text" id="id" name="id" value="'.$cliente->id_cliente.'" style="display:none;">';
                        }
                    ?>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente" value="<?php if(isset($cliente)){
                            echo $cliente->nome_cliente;
                        } ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="tel">Telefone de Contato</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="(XX) X XXXX-XXXX" value="<?php if(isset($cliente)){
                            echo $cliente->tel_cliente;
                        } ?>">
                    </div>
                    <button type="submit" class="btn btn-default"><?php if(isset($cliente)){
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