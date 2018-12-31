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
            <form action="<?php echo base_url()?>index.php/Client/<?php if(isset($client)) { echo 'update_client'; } else { echo 'create_client';} ?>" method="POST">
                    <h3>Cadastro de Cliente</h3>
                    <?php
                        if(isset($client)){
                            echo '<input type="text" id="id" name="id" value="'.$client->client_id.'" style="display:none;">';
                        }
                    ?>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente" value="<?php if(isset($client)){
                            echo $client->client_name;
                        } ?>">
                    </div>
                
                    <div class="form-group">
                        <label for="tel">Telefone de Contato</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="(XX) X XXXX-XXXX" value="<?php if(isset($client)){
                            echo $client->client_telephone;
                        } ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="fulano@detal.com.br" value="<?php if(isset($client)){
                            echo $client->client_email;
                        } ?>">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Data de Nascimento</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php if(isset($client)){
                            echo substr($client->client_birthday,0,10);
                        } ?>">
                    </div>
                    <button type="submit" class="btn btn-default"><?php if(isset($client)){
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