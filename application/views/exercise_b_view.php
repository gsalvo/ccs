<div class="container">	
	<div class="exercise2">
		<div class="row exercise-title">
			<div class="col-md-12">
				<h4>Ejercicio 2</h4>
			</div>
			<div class="col-md-12">
				<p>Estimado usuario, a continuación se presenta un formulario que deberá completar para generar el gráfico que desee.</p>
			</div>
		</div>
		<?php echo form_open("exerciseb", array("id"=>"form-exercise2", "autocomplete"=>"off")); ?>		  
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Tipo de valor (coordenada Y)', 'value'); ?>
						<?php echo form_dropdown('value', array(''=>'Seleccione el tipo de valor', 'actual'=>'Valor actual', 'previous'=>'Valor anterior', 'major'=>'Valor mayor', 'minor'=>'Valor menor', 'avg'=>'Valor promedio', 'percent'=>'Valor porcentual'), set_value('value', ''), array('class'=>'form-control', 'id'=>'value')); ?>	
						<?php echo form_error('value'); ?>
					</div>						
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Periodo (coordenada X)', 'period'); ?>
						<?php echo form_dropdown('period', array(''=>'Seleccione periodo', 'ME'=>'Mensual', 'AN'=>'Anual'), set_value('period', ''), array('class'=>'form-control', 'id'=>'period')); ?>	
						<?php echo form_error('period'); ?>
					</div>						
				</div>					
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Fecha inicio', 'start-date'); ?>
						<?php echo form_input(array('type'=>'text', 'class'=> 'form-control date', 'id'=>'start-date', 'name'=>'start-date', 'placeholder'=>'Fecha inicio','value'=>set_value('start-date', ''))) ?>						
						<?php echo form_error('start-date'); ?>
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Fecha término', 'end-date'); ?>
						<?php echo form_input(array('type'=>'text', 'class'=> 'form-control date', 'id'=>'end-date', 'name'=>'end-date', 'placeholder'=>'Fecha término', 'value'=>set_value('end-date', ''))) ?>	
						<?php echo form_error('end-date'); ?>					
					</div>						
				</div>	
				<div class="col-md-12">
					<label>Seleccione los índices para graficar</lable>
				</div>
				<div class="col-md-12">
					<div class="form-group">						
						<label class="checkbox-inline">
							<input type="checkbox" id="ipga-option" value="IGPA" name="type[]" <?php echo set_checkbox('type[]', 'IGPA')?>> IGPA
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" id="ipsa-option" value="IPSA" name="type[]" <?php echo set_checkbox('type[]', 'IPSA')?>> IPSA
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" id="inter-option" value="INTER-10" name="type[]" <?php echo set_checkbox('type[]', 'INTER-10')?>> INTER-10
						</label>
						<?php echo form_error('type[]'); ?>
					</div>
				</div>			
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-search" data-loading-text="<div class='spinner'><div class='rect1'></div><div class='rect2'></div><div class='rect3'></div></div></div>Generando gráfico" >Generar gráfico</button>					
				</div>
			</div>
		<?php echo form_close(); ?>
		<div class="row">
			<div class="col-md-12">
				<canvas id="chart" width="400" height="400"></canvas>
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(function(){
		$('.btn-search').on('click', function() {
			var $this = $(this);
			$this.button('loading');			
		});

		<?php if(isset($result)){ ?>
			var data = <?php echo json_encode($result) ?>;
		<?php }else{ ?>
			var data = [];
		<?php } ?>	


		var myLineChart = new Chart($('#chart'), {
			type: 'line',
			data: {
			labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
				datasets: [{
				label: '# of Votes',
				data: [12, 19, 3, 5, 2, 3],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
			},
			options: {
			scales: {
			yAxes: [{
			ticks: {
			beginAtZero:true
			}
			}]
			}
			}
			//options: options
		});

	});
</script>
