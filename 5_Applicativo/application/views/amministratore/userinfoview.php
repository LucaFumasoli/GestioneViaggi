
<form action="<?php echo URL . 'home/userInfoChanged/'?><?php echo $nome . "/"?><?php echo $cognome . "/"?><?php echo $email . "/"?>" method="POST">
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<h1 class="h3 mb-3 fw-normal" style="color: white;">Utente <?php echo $nome . " " . $cognome?></h1>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<br>
	<hr style="height: 5px; color: black;">
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="form-floating">
      		<input type="text" class="form-control" id="floatingInput" name="floatingNome" placeholder="text">
      		<label for="floatingNome"><?php echo $nome ?></label>
	    </div>
		</div>
		<div class="col"></div>
	</div>
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="form-floating">
      		<input type="text" class="form-control" id="floatingInput" name="floatingCognome" placeholder="text">
      		<label for="floatingCognome"><?php echo $cognome ?></label>
	    </div>
		</div>
		<div class="col"></div>
	</div>
	<div class="row">
		<div class="col-3"></div>
		<div class="col-6">
			<div class="form-floating">
      		<input type="email" class="form-control" id="floatingInput" name="floatingEmail" placeholder="email">
      		<label for="floatingEmail"><?php echo $email ?></label>
	    </div>
		</div>
		<div class="col">
			<input type="submit" value="applica" class="w-100 btn btn-lg btn-primary">
		</div>
	</div>
	<hr style="height: 5px; color: black;">
	<?php for ($i=0; $i < count($fatture); $i++) {?>
		<a href="<?php echo URL . 'home/fattura/'?><?php echo $fatture[$i]['id']?>" style="text-decoration: none;">
		<div class="row">
		
		<div class="col-3">
			<label style="color: white;">fattura <?php echo $i+1 ?></label>
		</div>
		<div class="col">
			<label style="color: white;">fattura del <?php echo $fatture[$i]['data'] ?></label>
		</div>
		<div class="col-1">
			
		</div>
	</div>
	<hr style="height: 3px; color: black;">
	<?php } ?>
	

