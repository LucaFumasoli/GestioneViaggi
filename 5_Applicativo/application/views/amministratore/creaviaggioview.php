	<div class="row">
		<div class="col"></div>
		<div class="col-4">
			<h3 style="color: white;">Crea viaggio</h3>
		</div>
		<div class="col"></div>
	</div>
	<br>
	
		<form method="POST" action="<?php echo URL . 'home/addViaggio' ?>">
			<div class="row">
				<div class="col-2">
					<span style="color: white;">seleziona bus</span>
				</div>
				<div class="col-2">
					<select name="numeroBus" id="numeroBus" class="form-control">
						<?php 
							for ($i=0; $i < count($bus); $i++) { ?>
								<option value=<?php echo $bus[$i]['id']  ?>><?php echo $bus[$i]['numero_bus'] ?></option>
							<?php
							}
						?>
						  
					</select>
				</div>
				<div class="col-1"></div>
				<div class="col-6">
					<input type="submit" value="aggiungi viaggio" class="w-50 btn btn-lg btn-primary" <?php if(isset($_SESSION['tratte'])){?>
							enable = "true"
					<?php }else{?>
						disabled = "true"
					 <?php } ?> />
				</div>
			</div>
		</form>
	
	<br>
	<hr style="height:4px;color:black;">
	<?php 
		if(isset($_SESSION['tratte'])){
			for ($i=0; $i < count($_SESSION['tratte']); $i++){ 
				?> 

					<div class="row">
						<div class="col-2">
							<h5 style="color: white;">Nome partenza:</h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;"><?php echo($_SESSION['tratte'][$i][0])?></h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;">Nome arrivo:</h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;"><?php echo($_SESSION['tratte'][$i][1])?></h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;">Orario partenza:</h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;"><?php echo substr($_SESSION['tratte'][$i][2],0 ,10);
								echo " ";
								echo substr($_SESSION['tratte'][$i][2],11);
							?>
								
							</h5>
						</div>	
						<div class="col-1">
							<h5 style="color: white;">Orario arrivo:</h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;"><?php 
								echo substr($_SESSION['tratte'][$i][3],0 ,10);
								echo " ";
								echo substr($_SESSION['tratte'][$i][3],11);
							?></h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;">Prezzo:</h5>
						</div>
						<div class="col-1">
							<h5 style="color: white;"><?php echo($_SESSION['tratte'][$i][4])?></h5>
						</div>			
					</div>
					<hr style="height:2px;color:black;">
				<?php }
			
		}?>
				
	<br>
	<br>
	<br>

	<hr style="height:4px;color:black;">

	<div class="row">
		<div class="col"></div>
		<div class="col-2">
			<h3 style="color: white;">Crea tratta</h3>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<form method="POST" action="<?php echo URL . 'home/addTratta' ?>">
		<div class="row">
			<div class="col-2">
				<span style="color: white;">Nome partenza</span>
			</div>
			<div class="col-2">
				<input type="text" class="form-control" id="nomePartenzaTratta" name="nomePartenzaTratta" />
			</div>
			<div class="col-2">
				<span style="color: white;">orario di partenza</span>
			</div>
			<div class="col-4">
				<input type="datetime-local" class="form-control" id="orarioPartenzaTratta" name="orarioPartenzaTratta" />
			</div>
			<div class="col"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-2">
				<span style="color: white;">Nome arrivo</span>
			</div>
			<div class="col-2">
				<input type="text" class="form-control" id="nomeArrivoTratta"  name="nomeArrivoTratta"/>
			</div>
			<div class="col-2">
				<span style="color: white;">orario di arrivo</span>
			</div>
			<div class="col-4">
				<input type="datetime-local" class="form-control" id="orarioArrivoTratta" name="orarioArrivoTratta"/>
			</div>
			<div class="col"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-2">
				<span style="color: white;">prezzo</span>
			</div>
			<div class="col-2">
				<input type="number" class="form-control" id="prezzoTratta" name="prezzoTratta"/>
			</div>
			<div class="col"></div>
		</div>

		<br>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<input type="submit" value="aggiungi tratta" class="w-50 btn btn-lg btn-primary" />
			</div>
			<div class="col-2"></div>
		</div>
	</form>
	