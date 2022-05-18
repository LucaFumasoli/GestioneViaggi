<div style="color: white;">
<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
     	<h3 style="color: white">dettagli tratta</h3>
	</div>
	<div class="col-3"></div>
</div>
<br>
<hr style="height: 4px; color: black;">
<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
     	<h4 style="color: white">dettagli generali</h4>
	</div>
	<div class="col-3"></div>
</div>
<br>
<br>
<br>
<div class="row">
	<div class="col-3"><h4 style="color: white">partenza</h4></div>
	<div class="col-3"><h4 style="color: white">arrivo</h4></div>
	<div class="col-3"><h4 style="color: white">prezzo</h4></div>
	<div class="col-3"><h4 style="color: white">Posti disponibili</h4></div>
</div>
<br>
<div class="row">
	<div class="col-3"><h5><?php echo $arrInfo[0]['localita_partenza']?></h5></div>
	<div class="col-3"><h5><?php echo $arrInfo[0]['localita_arrivo']?></h5></div>
	<div class="col-3"><h5><?php echo $arrInfo[0]['costo']?> fr</h5></div>
	<div class="col-3"><h5><?php echo $postiTot ?></h5></div>
</div>
<div class="row">
	<div class="col-3"><h5>(<?php echo $arrInfo[0]['orario_partenza']?>)</h5></div>
	<div class="col-3"><h5>(<?php echo $arrInfo[0]['orario_arrivo']?>)</h5></div>
</div>
<hr style="height: 2px; color: black;">
<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
     	<h4 style="color: white">dettagli passeggeri</h4>
	</div>
	<div class="col-3"></div>
</div>
<br>
<br>
<br>
<div class="row">
	<div class="col-4"><h4 style="color: white">sale:</h4></div>
	<div class="col-4"><h4 style="color: white">resta:</h4></div>
	<div class="col-4"><h4 style="color: white">scende:</h4></div>
</div>
<div class="row">
	<div class="col-4"><h5><?php 
		for ($i=0; $i < count($sale); $i++) { 
			echo '<br>' . $sale[$i][0]['nome'] . " ";
			echo $sale[$i][0]['cognome'] . ": posto " . $postoSale[$i][0]['numero_posto'];
		}
	?></h5></div>
	<div class="col-4"><h5><?php 
		for ($i=0; $i < count($resta); $i++) { 
			echo '<br>' . $resta[$i][0]['nome'] . " ";
			echo $resta[$i][0]['cognome'] . ": posto " . $postoResta[$i][0]['numero_posto'];
		}
	?></h5></div>
	<div class="col-4"><h5><?php 
		for ($i=0; $i < count($scende); $i++) { 
			echo '<br>' . $scende[$i][0]['nome'] . " ";
			echo $scende[$i][0]['cognome'] . ": posto " . $postoScende[$i][0]['numero_posto'];
		}
	?></h5></div>
</div>
</div>