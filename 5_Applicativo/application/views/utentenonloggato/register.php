
<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<form action="<?php echo URL . 'home/tryToRegister' ?>" method="POST">
<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<h1 class="h3 mb-3 fw-normal" style="color: white;">Registrati</h1>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
				<?php if(!isset($_SESSION['nomeRegister'])){ ?>
		      		<input type="text"  class="form-control" id="floatingNome" name="floatingNome" placeholder="Nome">
		      		<label for="floatingNome">Nome</label>
		     	<?php } elseif($_SESSION['wrongNameRegister']){ ?>
		     		<input type="text"  class="form-control" id="floatingNome" name="floatingNome" placeholder="Nome" value="<?php echo $_SESSION['nomeRegister'] ?>" style="border: 2px solid red">
		      		<label for="floatingNome">Nome</label>
		      	<?php } elseif(!$_SESSION['wrongNameRegister']){ ?>
		      		<input type="text"  class="form-control" id="floatingNome" name="floatingNome" placeholder="Nome" value="<?php echo $_SESSION['nomeRegister'] ?>">
		      		<label for="floatingNome">Nome</label>
		      	<?php } unset($_SESSION['nomeRegister'])?>
	    	</div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
				<?php if(!isset($_SESSION['cognomeRegister'])){ ?>
				      <input type="text"  class="form-control" id="floatingCognome" name="floatingCognome" placeholder="Cognome">
				      <label for="floatingCognome">Cognome</label>
				<?php } elseif($_SESSION['wrongSurnameRegister']){ ?>
					<input type="text"  class="form-control" id="floatingCognome" name="floatingCognome" placeholder="Cognome" value="<?php echo $_SESSION['cognomeRegister'] ?>"style="border: 2px solid red">
				    <label for="floatingCognome">Cognome</label>
				<?php } elseif(!$_SESSION['wrongSurnameRegister']){ ?>
					<input type="text"  class="form-control" id="floatingCognome" name="floatingCognome" placeholder="Cognome" value="<?php echo $_SESSION['cognomeRegister'] ?>">
				    <label for="floatingCognome">Cognome</label>
				<?php } unset($_SESSION['cognomeRegister']) ?>
	    	</div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
				<?php if(!isset($_SESSION['emailRegister'])){ ?>
			      <input type="email" class="form-control" id="floatingEmail" name="floatingEmail" placeholder="email">
			      <label for="floatingEmail">Indirizzo email</label>
			    <?php } 
			    elseif($_SESSION['wrongEmailRegister']){ ?>
			      <input type="email" class="form-control" id="floatingEmail" name="floatingEmail" placeholder="email" value="<?php echo $_SESSION['emailRegister'] ?>" style="border: 2px solid red">
			      <label for="floatingEmail">Indirizzo email</label>
			    <?php } 
			     elseif(!$_SESSION['wrongEmailRegister']){ ?>
			      <input type="email" class="form-control" id="floatingEmail" name="floatingEmail" placeholder="email" value="<?php echo $_SESSION['emailRegister'] ?>">
			      <label for="floatingEmail">Indirizzo email</label>
			     <?php } unset($_SESSION['emailRegister'])?>
	    	</div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
				<?php if(!isset($_SESSION['passwordRegister'])){ ?>
	      			<input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password">
	      			<label for="floatingPassword">Password</label>
	      		<?php }
			    elseif($_SESSION['wrongPasswordRegister']){ ?>
			    	<input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password" style="border: 2px solid red">
	      			<label for="floatingPassword">Password</label>
	      			<script>alert("La password deve essere lunga almeno 8 caratteri e deve contenere almeno una lettera minuscola, una maiuscola e un numero")</script>
	      		<?php } 
			    elseif(!$_SESSION['wrongPasswordRegister']){ ?>
			     	<input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password" value="<?php echo $_SESSION['passwordRegister'] ?>">
	      			<label for="floatingPassword">Password</label>
	      		<?php } ?>
	    </div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<div class="form-floating">
				<?php if(!isset($_SESSION['passwordRegister'])){ ?>
			      <input type="password" class="form-control" id="floatingPasswordConfirm" name="floatingRepeatedPassword" placeholder="password">
			      <label for="floatingPassword">Conferma password</label>
			    <?php }
			    elseif($_SESSION['wrongPasswordRegister']){ ?>
			   		<input type="password" class="form-control" id="floatingPasswordConfirm" name="floatingRepeatedPassword" placeholder="password" style="border: 2px solid red">
			        <label for="floatingPassword">Conferma password</label>
			    <?php } 
			    elseif(!$_SESSION['wrongPasswordRegister']){ ?>
			    	<input type="password" class="form-control" id="floatingPasswordConfirm" name="floatingRepeatedPassword" placeholder="password" value="<?php echo $_SESSION['passwordRegister'] ?>">
			        <label for="floatingPassword">Conferma password</label>
			     <?php } unset($_SESSION['passwordRegister'])?>
	    </div>
		</div>
		<div class="col-3"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-4"></div>
		<div class="col">
			<button class="w-100 btn btn-lg btn-primary" type="submit">Registrati</button>
		</div>
		<div class="col-4"></div>
	</div>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">
			<label style="color: white;">hai già un account?</label>
		</div>
		<div class="col-3"></div>
	</div>
	<div class="row">
		<div class="col-4"></div>
		<div class="col">
			<a href="<?php echo URL . 'home/login' ?>"><input type="button" class="w-100 btn btn-lg btn-primary" value="Accedi" ></a>
		</div>
		<div class="col-4"></div>
	</div>
</form>