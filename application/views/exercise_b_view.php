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
						<?php echo form_dropdown('value', array(''=>'Seleccione el tipo de valor', 'ind_act'=>'Valor actual', 'ind_ant'=>'Valor anterior', 'ind_may'=>'Valor mayor', 'ind_men'=>'Valor menor', 'ind_pro'=>'Valor promedio', 'ind_var'=>'Valor porcentual'), set_value('value', ''), array('class'=>'form-control', 'id'=>'value')); ?>	
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
				<div class="chart-content">
					<canvas id="chart"></canvas>	
				</div>
				
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(function(){
		$('#btn-1').removeClass();
		$('#btn-2').removeClass();
		$('#btn-2').addClass('active');

		$('.btn-search').on('click', function() {
			var $this = $(this);
			$this.button('loading');			
		});
		<?php 
			$colors = array('IGPA'=>'#3498db', 'IPSA'=>'#e67e22', 'INTER-10'=>'#9b59b6');
			$backgroundColor = array('IGPA'=>'rgba(52, 152, 219, 0.1)', 'IPSA'=>'rgba(230, 126, 34, 0.3)', 'INTER-10'=>'rgba(155, 89, 182,0.5)');
		?>			
		<?php if(isset($result)){ ?>
			var labels = <?php echo json_encode($formatLabels) ?>; 			
			var myLineChart = new Chart($('#chart'), {
				type: 'line',				
				responsive: false,
				width:500,
				height:300,
				data: {
					labels: labels,
						datasets: [
							<?php foreach ($result as $key => $value) { ?>
								{
									label: "<?php echo $key ?>",
									data: <?php echo json_encode($result[$key]); ?>,							
									borderWidth: 1,																		
									borderColor: "<?php echo $colors[$key]; ?>",
									backgroundColor: "<?php echo $backgroundColor[$key]; ?>"
								},								

							<?php } ?>					
						]
				},
				maintainAspectRatio: false,
				options: {
					title: {
						display: true,
						text: 'Gráfico de índices'
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}			
			});
			myLineChart.resize(300,200);

		<?php } ?>

		

		

	});
</script>
