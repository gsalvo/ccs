<div class="container">	
	<div class="exercise1">
		<div class="row exercise-title">
			<div class="col-md-12">
				<h4>Ejercicio 1</h4>
			</div>
			<div class="col-md-12">
				<p>Estimado usuario, a continuación se presenta un grilla con la información de los índices. Para esto debe completar el formulario que se encuentra a continuación y presionar el botón "Buscar Datos". Si desea realizar una búsqueda de todos los índices puede dejar el campo índice sin completar.</p>
			</div>
		</div>
		<?php echo form_open("ExerciseA", array("id"=>"form-exercise1", "autocomplete"=>"off")); ?>
			<div class="row">			
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Índice', 'type'); ?>
						<?php echo form_input(array('type'=>'text', 'class'=> 'form-control', 'id'=>'type', 'name'=>'type', 'placeholder'=>'Índice (EJ: IPSA o vacío si desea buscarlos todos)', 'value'=>set_value('type', ''))) ?>
						<?php echo form_error('type'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo form_label('Periodo', 'period'); ?>
						<?php echo form_dropdown('period', array(''=>'Seleccione periodo', 'DI'=>'Diario', 'ME'=>'Mensual', 'AN'=>'Anual'), set_value('period', ''), array('class'=>'form-control', 'id'=>'period')); ?>	
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
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-search" data-loading-text="<div class='spinner'><div class='rect1'></div><div class='rect2'></div><div class='rect3'></div></div></div>Buscando datos" >Buscar Datos</button>					
				</div>
			</div>
		<?php echo form_close(); ?>
		

		<div class="row table-content">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-hover" id="exercisea-table">
						
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(function(){
		$('#btn-1').removeClass();
		$('#btn-2').removeClass();
		$('#btn-1').addClass('active');
		
		$('.btn-search').on('click', function() {
			var $this = $(this);
			$this.button('loading');			
		});

		<?php if(isset($result)){ ?>
			var data = <?php echo json_encode($result) ?>;
		<?php }else{ ?>
			var data = [];
		<?php } ?>	


		$('#exercisea-table').DataTable({
			data: data,
			columns: [
				{ title: "Índice" },
				{ title: "Fecha" },
				{ title: "Valor actual" },
				{ title: "Valor anterior" },
				{ title: "Valor mayor" },
				{ title: "Valor med" },
				{ title: "Valor menor" },
				{ title: "Valor promedio" },
				{ title: "Valor porcentual" },
			],
			columnDefs: [
				{
					targets: 1,
					width: "100px",
					render: function ( data, type, row ) {
						var dateSplit = data.split("-");
						return dateSplit[2] +'-'+ dateSplit[1] +'-'+ dateSplit[0];
					},				
				},
				{
					targets: 0,
					width: "130px",					
				}
        	],			
			filter:false,
			lengthChange: false,
			paging: true,
			ordering: true,
			info: true,
			pageLength: 5,
			language: {
				decimal:        "",
				emptyTable:     "No hay datos para mostrar",
				info:           "Mostrando _START_ de _END_ de un total de _TOTAL_ registros",
				infoEmpty:      "Mostrando 0 de 0 de 0 registros",
				infoFiltered:   "(filtrado de un total de _MAX_ registros)",
				infoPostFix:    "",
				thousands:      ".",
				lengthMenu:     "Mostrar _MENU_ registros",
				loadingRecords: "Cargando datos...",
				processing:     "Buscando...",
				search:         "Buscar:",
				zeroRecords:    "No se han encontrado coincidencias",
				paginate: {
					first:      "<<",
					last:       ">>",
					next:       ">",
					previous:   "<"	
				},
				aria: {
					sortAscending:  ": Activar para ordenar de forma ascendente",
					sortDescending: ": Activar para ordenar de forma descendente"
				}

			}
		});

	});
</script>
