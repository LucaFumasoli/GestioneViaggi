
	
	<form action="<?php echo URL . 'home/users' ?>" method="POST">
	<div class="row" style="position: sticky; position: -webkit-sticky; background: #424242;">
		<div class="row" style="color: white;">
			<div class="col-3"></div>
			<div class="col">
		        <h1 >filtra</h1>
			</div>
			<div class="col-3"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-3"></div>
			<div class="col form-floating">
		     	<input type="text" class="form-control" id="floatingName" name="floatingName" placeholder="name">
		   		<label for="floatingName">Nome</label>
	    	</div>
			<div class="col-3"></div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-3"></div>
			<div class="col form-floating">
		     	<input type="text" class="form-control" id="floatingSurname" name="floatingSurname" placeholder="name">
		   		<label for="floatingName">Cognome</label>
	    	</div>
			<div class="col-3"></div>
		</div>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="col-3"></div>
				<div class="col">
					<input type="submit" value="filtra" class="w-100 btn btn-lg btn-primary">
				</div>
			<div class="col-3">
				<div class="form-check form-switch">
				  <input class="form-check-input" type="checkbox" role="switch" id="id_check_uncheck_all">
				  <label style="color: white;" class="form-check-label" for="id_check_uncheck_all">seleziona tutti</label>
				</div>
				<br/>
				<br/>
			</div>
		</div>
		<br>

		<hr style="height: 6px; color: white;">

	</div>
	<div class="row" style="color: white;">
		<?php
		for($i = 0; $i < count($arrUsers); $i++){?>
			<div class="row" style="color: white;">
				<div class="col-2">utente <?php echo ($i + 1) ?></div>
				<div class="col-2"><?php echo $arrUsers[$i]["nome"] ?></div>
				<div class="col-2"><?php echo $arrUsers[$i]["cognome"] ?></div>
				<div class="col-4"><?php echo $arrUsers[$i]["email"] ?></div>
				<div class="col">

				
				<div class="form-check form-switch">
				  <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $arrUsers[$i]["email"]?>" name="<?php echo $arrUsers[$i]["email"]?>">
				  <label class="form-check-label" for="flexSwitchCheckChecked">manda email</label>
				</div>
				</div>
				
				<hr style="height: 2px; color: white;">
			</div>
		<?php } ?>
		<div><input type="button" value="manda email agli utenti selezionati" class="w-100 btn btn-lg btn-primary"> </div>
	</div>
</form>
<script>
		var checkAll = document.getElementById("id_check_uncheck_all");
		checkAll.addEventListener("change", function() {
		  var checked = this.checked;
		  var otherCheckboxes = document.querySelectorAll(".form-check-input");
		  [].forEach.call(otherCheckboxes, function(item) {
		    item.checked = checked;
		    console.log("rth");
		  });
		});
	</script>
