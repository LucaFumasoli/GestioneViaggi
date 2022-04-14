<script>
	var nFer = 0;
	
	function addStop() {
		var nome = document.getElementById("nome").value;
		var orario = document.getElementById("orario").value;
		var prezzo = document.getElementById("prezzo").value;

		if (nome != null && orario != null && prezzo != null) {
			document.getElementById('fermate').innerHTML += '<div class="row"><div class="col-2"><div class="col-2"></div><input type="number" value="' + nFer + '" class="form-control" /></div><div class="col-2"><input type="text" value="' + nome + '" class="form-control" id="nome' + nFer + '" /></div><div class="col-2"><input type="datetime-local" value="' + orario + '" class="form-control" id="orario' + nFer + '" /></div><div class="col-2"><input type="prezzo" value="' + prezzo + '" class="form-control" id="prezzo' + nFer + '" /></div></div><br>';

			nFer++;
			document.getElementById("nome").value = null;
			document.getElementById("orario").value = null;
			document.getElementById("prezzo").value = null;
		}else {

		}
	}
</script>


	<div class="row">
		<div class="col-2">
			<span style="color: white;">seleziona bus</span>
		</div>
		<div class="col-1">
			<select name="grandezza" id="grandezza" class="form-control">
				<option value="0">...</option>
				<option value="1">...</option>
				<option value="2">...</option>
			</select>
		</div>
		<div class="col-2"></div>
		<div class="col-1">
		</div>
		<div class="col"></div>
	</div>
	<br>

	<div class="row">
		<div class="col-2">
			<span style="color: white;">partenza</span>
		</div>
		<div class="col-2">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-1">
			<span style="color: white;">orario</span>
		</div>
		<div class="col-2">
			<input type="datetime-local" class="form-control"/>
		</div>
		<div class="col-1">
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div id="fermate">
		
	</div>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-6">
			<input type="button" value="aggiungi fermata" class="w-25 btn btn-lg btn-primary" onclick="addStop()" />
		</div>
		<div class="col-4"></div>
	</div>
	<br>

	<div class="row">
		<div class="col-2">
			<span style="color: white;">arrivo</span>
		</div>
		<div class="col-2">
			<input type="text" class="form-control"/>
		</div>
		<div class="col-1">
			<span style="color: white;">orario</span>
		</div>
		<div class="col-2">
			<input type="datetime-local" class="form-control"/>
		</div>
		<div class="col-3">
			<input type="submit" value="crea" class="w-25 btn btn-lg btn-primary">
		</div>
	</div>
	<br>

	<br>
	<hr style="height:4px;color:black;">

	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<span style="color: white;">fermata intermedia</span>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-2">
			<span style="color: white;">nome fermata</span>
		</div>
		<div class="col-2">
			<input type="text" class="form-control" id="nome"/>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-2">
			<span style="color: white;">orario di partenza</span>
		</div>
		<div class="col-2">
			<input type="datetime-local" class="form-control" id="orario"/>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-2">
			<span style="color: white;">prezzo</span>
		</div>
		<div class="col-2">
			<input type="number" class="form-control" id="prezzo"/>
		</div>
		<div class="col"></div>
	</di