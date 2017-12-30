<div class="flash-message" id='flash-message'>	
	<div class="content">
		<div class="close-icon">
			<svg class="icon"><use xlink:href="<?php echo site_url('assets/images/general-icons.svg').'#icon-close' ?>"></use></svg>
		</div>
		<div class="icon-content">
			<svg class="icon"><use xlink:href="<?php echo site_url('assets/images/general-icons.svg').'#icon-warning' ?>"></use></svg>			
		</div>
		<div class="data-content">
			<p class="title">Error inesperado</p>
			<p class="text">Ha ocurrido un error, disculpe las molestias.</p>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(function(){
		/* Oculta o muestra flash message */
		toggleMessage = function (){
			if($("#flash-message").css('display') == 'none'){
				$("#flash-message").fadeIn("fast", function(){
					$("#flash-message").delay(3000).fadeOut("Fast",function(){});
				});
			}else{
				$("#flash-message").fadeOut("fast", function(){});
			}
		}
		

		$option = <?php echo isset($flashMessage) ? 'true' : 'false' ?>;
		if($option){
			toggleMessage();
		}
		/* Funcionalidad del botón cerrar  */
		$('#flash-message .content .close-icon').on('click', function(){			
			$('#flash-message').hide();
		});

		

	});
</script>
