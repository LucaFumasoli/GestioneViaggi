<div class="row">
	<div class="col-2"></div>
	<div class="col-8">
		<h3 style="color: white;">Prossimi viaggi da <?php echo $partenza?> a <?php echo $arrivo ?>
		</h3>
	</div>
	<div class="col-2"></div>
	<hr style="height:2px;color:white;">
	<div class="row">
		<div class="col-2">
			<h5 style="color:white;">Partenza alle:</h5>
		</div>
		<div class="col-2">
			<h5 style="color:white;">Il:</h5>
		</div>
		<div class="col-2">
			<h5 style="color:white;">Da:</h5>
		</div>

		<div class="col-2">
			<h5 style="color:white;">Numero bus:</h5>
		</div>
		<div class="col-2">
			<h5 style="color:white;">A:</h5>
		</div>
		<div class="col-2">
			<h5 style="color:white;">Arrivo alle:</h5>
		</div>
	</div>
	<hr style="height:2px;color:white;">
</div>

<?php 

	for ($i=0; $i < count($result); $i++) {?>
		<a href="<?php 
			if($_SESSION['isRegistered'] == false){
				echo URL . 'home/tratta/';
			}else if($_SESSION['isAdmin'] == true){
				echo URL . 'home/trattaAdmin/';
			}else{
				echo URL . 'home/trattaLoggato/';
			}
		 	echo ($result[$i]['id_viaggio'])?>" style="text-decoration: none;">
			<div class="row">
				<div class="col-2">
					<h5 style="color:white;"><?php echo substr($result[$i]["orario_partenza"],11)?></h5>
				</div>
				<div class="col-2">
						<h5 style="color: white;"><?php echo substr($result[$i]["orario_partenza"],0,10)?></h5>
				</div>
				<div class="col-2">
						<h5 style="color: white;"><?php echo $result[$i]["localita_partenza"]?></h5>
				</div>
				<div class="col-2"><h5 style="color: white;"><?php echo $result[$i]["numero_bus"]?></h5></div>
				<div class="col-2">
					<h5 style="color:white;"><?php echo $result[$i]["localita_arrivo"]?></h5>
				</div>
				<div class="col-2">
					<h5 style="color:white;"><?php echo substr($result[$i]["orario_arrivo"],11)?></h5>
				</div>
				<hr style="height:2px;color:white;">
			</div>
		</a>

		<?php

	}?>
		
	
