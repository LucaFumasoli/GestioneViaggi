<script>
	function printDiv() {
		const printContents = document.getElementById('printD').innerHTML;
		const originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}

	function getPage() {
		var fat = document.getElementById('printD').innerHTML;
		document.getElementById('fattura').value = fat;
	}

</script>
<div id="printD">
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<h1 class="h3 mb-3 fw-normal" style="color: white;">Fattura del <?php echo $fattura[0]['data']?></h1>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<br>
	<hr style="height: 5px; color: black;">
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<label style="color: white;">destinarario:</label>
		</div>
		<div class="col-2">
			<label style="color: white;"><?php echo $utente[0]['nome'] . " " . $utente[0]['cognome']?></label>
	    </div>
	    <div class="col"></div>
	</div> 
	<br>

	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			
		</div>
		<div class="col-2">
			<label style="color: white;"><?php echo $utente[0]['email']?></label>
	    </div>
	    <div class="col"></div>
	</div>
	<br>
	<hr style="height: 3px; color: black;">
	<br>
	<br>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<label style="color: white;">pagamento per il tragitto: </label>
		</div>
		<div class="col-2"></div>
		<div class="col-2">
			<label style="color: white;">viaggio fatto sul bus: <?php echo $bus[0]['numero_bus']?></label>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<label style="color: white;"><?php echo $tappa[0]['localita_partenza']?> -----> <?php echo $tappa[1]['localita_arrivo']?></label>
		</div>
		<div class="col-2"></div>
		<div class="col-2">
			<label style="color: white;">nel posto: <?php echo $fattura[0]['numero_posto']?></label>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<label style="color: white;">partenza alle ore: <?php echo $tappa[0]['orario_partenza']?></label>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-2">
			<label style="color: white;">arrivo alle ore: <?php echo $tappa[1]['orario_arrivo']?></label>
		</div>
		<div class="col-2"></div>
		<div class="col-2">
			<label style="color: white;">totale pagato: <?php echo $fattura[0]['costo_totale']?> CHF</label>
		</div>
	</div>
</div>
	<br>
	<br>
	<div class="row">
		<div class="col-2"></div>
		<div class="col-2">
			<form action=" <?php echo URL . 'home/mandaMail' ?> " method="post" onsubmit="getPage()">
				<input type="hidden" id="mail" name="mail" value="<?php echo $utente[0]['email']?>">
				<input type="hidden" id="data" name="data" value="<?php echo $fattura[0]['data']?>">
				<input type="hidden" id="fattura" name="fattura">
				<button class="w-100 btn btn-lg btn-primary">Manda email</button>
			</form>
		</div>
		<div class="col-1"></div>
		<div class="col-2">
			<button class="w-100 btn btn-lg btn-primary" onclick="printDiv()">Stampa</button>
		</div>
	</div>

