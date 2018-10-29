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
							<li data-toggle="collapse" data-target="#admViagem" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Viagens <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admViagem">
								<a href="<?php echo base_url()?>index.php/System/testePDF"><li>Consultar</li></a>
							</ul>
							
							<li data-toggle="collapse" data-target="#admVeiculos" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Veículos <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admVeiculos">
								<a href="<?php echo base_url()?>index.php/Veiculo/cadastrar_veiculo"><li>Cadastrar</li></a>
								<li>Manutenção</li>
								<a href="<?php echo base_url()?>index.php/Veiculo"><li>Buscar/Alterar</li></a>
							</ul>

						
							
							<li data-toggle="collapse" data-target="#admCliente" class="collapsed">
							  <i class="fa fa-car fa-lg"></i> Clientes <span class="arrow"></span>
							</li>
							<ul class="sub-menu collapse" id="admCliente">
								<a href="<?php echo base_url()?>index.php/Cliente/cadastrar_cliente"><li>Cadastrar</li></a>
								<a href="<?php echo base_url()?>index.php/Cliente/listar_clientes"><li>Buscar/Alterar</li></a>
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