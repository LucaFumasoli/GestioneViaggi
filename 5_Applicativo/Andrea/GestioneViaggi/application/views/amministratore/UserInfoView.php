<br>
<br>
<br>
<br>
<br>
<form action="<?php echo URL . 'home/userInfoChanged' ?>" method="POST">
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
		<div class="col-1"></div>
		<div class="col-4">
			<label style="color: white;"><?php echo $nome ?></label>
		</div>
		<div class="col-4">
			<div class="form-floating">
      		<input type="text" class="form-control" id="floatingInput" name="floatingNome" placeholder="text">
      		<label for="floatingNome">nome</label>
	    </div>
		</div>
		<div class="col-2"></div>
	</div>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-4">
			<label style="color: white;"><?php echo $cognome ?></label>
		</div>
		<div class="col-4">
			<div class="form-floating">
      		<input type="text" class="form-control" id="floatingInput" name="floatingCognome" placeholder="text">
      		<label for="floatingCognome">cognome</label>
	    </div>
		</div>
		<div class="col-2"></div>
	</div>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-4">
			<label style="color: white;"><?php echo $email ?></label>
		</div>
		<div class="col-4">
			<div class="form-floating">
      		<input type="email" class="form-control" id="floatingInput" name="floatingEmail" placeholder="email">
      		<label for="floatingEmail">email</label>
	    </div>
		</div>
		<div class="col-2">
			<input type="submit" value="applica" class="w-100 btn btn-lg btn-primary">
		</div>
	</div>
	<hr style="height: 5px; color: black;">
