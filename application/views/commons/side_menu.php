<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="col-md-4 nav-side-menu">
			<div class="brand">Sistema Guto</div>
			<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
				<div class="menu-list">
					<ul id="menu-content" class="menu-content collapse out">
						<li  data-toggle="collapse" data-target="#home" class="collapsed active">
						  <a href="<?php echo base_url()?>index.php/"><i class="fa fa-gift fa-lg"></i> Inicio <span class="arrow"></span></a>
						</li>
						<?php #if($this->session->userdata('permissao') == 1){?>
						<li  data-toggle="collapse" data-target="#administrador" class="collapsed active">
						  <a href="#"><i class="fa fa-gift fa-lg"></i> Administrador <span class="arrow"></span></a>
						</li>
						<ul class="sub-menu collapse" id="administrador">
							<li data-toggle="collapse" data-target="#servico" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Servicos <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="servico">
								<a href="<?php echo base_url()?>index.php/Service"><li>Cadastrar</li></a>
								<a href="<?php echo base_url()?>index.php/Service/search_type"><li>Buscar/Alterar</li></a>
								<a href="<?php echo base_url()?>index.php/Service/new_presence"><li>Presenca</li></a>
							</ul>
							<li data-toggle="collapse" data-target="#admCliente" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Clientes <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admCliente">
								<a href="<?php echo base_url()?>index.php/Client/new_client"><li>Cadastrar</li></a>
								<a href="<?php echo base_url()?>index.php/Client/list_clients"><li>Buscar/Alterar</li></a>
								<a href="<?php echo base_url()?>index.php/Client/new_payment"><li>Lançar Pagamento</li></a>
							</ul>
							
							<li data-toggle="collapse" data-target="#admVeiculos" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Teste <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admVeiculos">
								<a href="<?php echo base_url()?>index.php/Veiculo/cadastrar_veiculo"><li>Teste</li></a>
								<li>Teste</li>
								<a href="<?php echo base_url()?>index.php/Veiculo"><li>Teste/Teste</li></a>
							</ul>
							
							<li data-toggle="collapse" data-target="#admMotorista" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Motoristas <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admMotorista">
								<a href="<?php echo base_url()?>index.php/Motorista/criar_motorista"><li>Cadastrar</li></a>
								<a href="<?php echo base_url()?>index.php/Motorista"><li>Buscar/Alterar</li></a>
							</ul>
							
						
						</ul>

						<?php #}?>

						<li  data-toggle="collapse" data-target="#servidor" class="collapsed active">
							<i class="fa fa-gift fa-lg"></i> Servidor <span class="arrow"></span>
						</li>
						<ul class="sub-menu collapse" id="servidor">
							<li data-toggle="collapse" data-target="#servServicos" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Serviços <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="servServicos">
								<a href="<?php echo base_url()?>index.php/Transporte/requisitar_transporte"><li>Requisitar Transporte</li></a>
								<a href="<?php echo base_url()?>index.php/System/requisitar_viagem"><li>Requisitar Viagem</li></a>
								<a href="<?php echo base_url()?>index.php/System/gerar_relatorio"><li>Gerar relatório</li></a>
							</ul>
						</ul>

						<li  data-toggle="collapse" data-target="#exit" class="collapsed active">
						  <a href="<?php echo base_url()?>index.php/System/sair"><i class="fa fa-gift fa-lg"></i> Sair <span class="arrow"></span></a>
						</li>
						

					</ul>
             </div>
                        </div>