<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('commons/header');

?>
<div class="container">
  <?php $this->load->view('commons/side_menu'); ?>
  
  <div class="col-md-8" id='calendar'></div>
</div>
 
<?php
$this->load->view('commons/footer');
?>