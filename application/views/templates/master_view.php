<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<?php echo link_tag('assets/css/jquery-ui.css'); ?>
	<?php echo link_tag('assets/css/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/css/datatables.css'); ?>
	<?php echo link_tag('assets/css/custom.css'); ?>

	
	<script src=<?php echo site_url('assets/js/jquery.min.js') ?>></script>	
	<script src=<?php echo site_url('assets/js/jquery-ui.min.js') ?>></script>
	<script src=<?php echo site_url('assets/js/datepicker-es.js') ?>></script>		
	<script src=<?php echo site_url('assets/js/bootstrap.min.js') ?>></script>
	<script src=<?php echo site_url('assets/js/datatables.min.js') ?>></script>	
	<script src=<?php echo site_url('assets/js/chart.min.js') ?>></script>	
	<title>		
		<?php 
			if(isset($webTitle)){ 
				echo 'Prueba Técnica CCS - '.$webTitle;
			}else{
				echo 'Prueba Técnica CCS';
			}
		?>		
	</title>
</head>
<body>
	<div class="container">
		<div class="row">			
			<div class="col-md-12">
				
			</div>				
		</div>
	</div>	
	<?php echo $content; ?>	
	<?php echo $flashMessage; ?>
	<script type="text/javascript">
		$(function(){
			 $("input.date").datepicker();
		});
	</script>
</body>
</html>
