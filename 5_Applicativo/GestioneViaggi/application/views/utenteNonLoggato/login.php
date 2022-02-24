<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<form action="<?php echo URL . 'home/tryToLogin' ?>" method="POST">
<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<h1 class="h3 mb-3 fw-normal" style="color: white;">Accedi</h1>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
			<?php if(!isset($_SESSION['emailLogin'])){ ?>
	      		<input type="email" class="form-control" id="floatingInput" name="floatingEmail" placeholder="email">
	      		<label for="floatingEmail">Indirizzo email</label>
	      	<?php } ?>
	      	<?php if(isset($_SESSION['emailLogin'])){ ?>
	      		<input type="email" class="form-control" id="floatingInput" name="floatingEmail" placeholder="email" value="<?php echo $_SESSION['emailLogin'] ?>"style="border: 2px solid red">
	      		<label for="floatingEmail">Indirizzo email</label>
	      	<?php } unset($_SESSION['emailLogin'])?>
	    </div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
			<?php if(!isset($_SESSION['passwordLogin'])){ ?>
	      		<input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password">
	      		<label for="floatingPassword">Password</label>
	       <?php } ?>
	       <?php if(isset($_SESSION['passwordLogin'])){ ?>
	      		<input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password" value="<?php echo $_SESSION['passwordLogin'] ?>"style="border: 2px solid red">
	      		<label for="floatingPassword">Password</label>

	       <?php } unset($_SESSION['passwordLogin'])?>
	    </div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-4"></div>
		<div class="col">
			<button class="w-100 btn btn-lg btn-primary" type="submit">Accedi</button>
		</div>
		<div class="col-4"></div>
	</div>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<label style="color: white;">non hai un account?</label>
		</div>
		<div class="col-3"></div>
	</div>
	<div class="row">
		<div class="col-4"></div>
		<div class="col">
			<a href="<?php echo URL . 'home/register' ?>"><input type="button" value="registrati" class="w-100 btn btn-lg btn-primary"></a>
		</div>
		<div class="col-4"></div>
	</div>
</form>