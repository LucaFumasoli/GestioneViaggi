<br>
<br>
<br>
<br>
<br>
	<script>
		function printdiv(printdivname) {
		    var headstr = "<br><br>";
		    var footstr = "</body>";
		    var newstr = document.getElementById(printdivname).innerHTML;
		    var oldstr = document.body.innerHTML;
		    document.body.innerHTML = headstr+newstr+footstr;
		    window.print();
		    document.body.innerHTML = oldstr;
		}
	</script>
	<div id="print">
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
			<div class="col-3">
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
			<div class="col-3">
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
			<div class="col-3">
				<label style="color: white;">partenza alle ore: <?php echo $tappa[0]['orario_partenza']?></label>
			</div>
			<div class="col"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-1"></div>
			<div class="col-3">
				<label style="color: white;">arrivo alle ore: <?php echo $tappa[1]['orario_arrivo']?></label>
			</div>
			<div class="col-2"></div>
			<div class="col-2">
				<label style="color: white;">totale pagato: <?php echo $fattura[0]['costo_totale']?> CHF</label>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-4">
			<button class="w-25 btn btn-lg btn-primary" onclick="printdiv('print')">Stampa</button>
		</div>
		<div class="col-2"></div>
	</div>