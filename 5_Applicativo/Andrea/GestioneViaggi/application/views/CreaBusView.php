<br>
<br>
<br>
<br>
<br>
<?php 

	if (session_status() === PHP_SESSION_NONE) { 
		session_start(); 
	}

	if (isset($_GET['grandezza'])) {
        $grand = $_GET['grandezza'];
        $_SESSION['grand'] = $grand;
    }else {
        $grand = 1;
    }
    if ($_SESSION['grand'] == 0) {
        $numRig = 5;
    } else if ($_SESSION['grand'] == 1) {
        $numRig = 10;
    }else {
        $numRig = 15;
    }

    if (isset($_POST['nomeLinea'])) {
       	$_SESSION['colorRed'] = true;
    }

?>

	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">Grandezza bus</span>
		</div>

		<div class="col-1">
			<form action=" <?php echo URL . 'home/createBus' ?> " method="get">
				<select name="grandezza" id="grandezza" onblur="document.form2.input.value = this.value;">
				  <option value="0">Piccolo</option>
				  <option value="1">Medio</option>
				  <option value="2">Grande</option>
				</select>
				<input type="submit" value="conferma">
			</form>
			<script type="text/javascript">
				document.getElementById('grandezza').value = "<?php echo $_SESSION['grand'];?>";
			</script>
			<sub>
		</div>
		<div class="col-2"></div>
		<div class="col-1">
			<form action=" <?php echo URL . 'home/tryToCreateBus' ?> " method="post">
			<input type="hidden" value="<?php echo $grand ?>" name="grand" />
      		<span style="color: white;">nome linea</span>
		</div>
		<div class="col-1">
			<?php if($_SESSION['colorRed'] == false){ ?>
	      		<input type="number" name="nomeLinea" id="nomeLinea" value="<?php echo $_SESSION['nomeLinea']; ?>">
	      	<?php }else { ?>
	      		<input type="number" name="nomeLinea" id="nomeLinea" style="border: 2px solid red">
	      	<?php } ?>
		</div>
		<div class="col"></div>
	</div>
	<br>
	<div class="row">
		<div class="col-3"></div>
		<div class="col">

	        <?php

	            $numCol = 4;

		        echo "<table border =\"1\" style='border-collapse: collapse; background-color: white;'>";
		        for ($i=0; $i < $numRig; $i++) {
		            echo "<tr>";
		            for ($j=0; $j < $numCol; $j++) {
		                echo '<td><button type="button" style="background-color:red; height: 25px;" class="w-25 btn btn-lg btn-primary"></button></td>';
		                if ($j == 1) {
		                	echo '<td>&nbsp;&nbsp;</td>';
		                }
		            }
		            echo "</tr>";
		        }
		        echo "</table>";
		    ?>

	    </div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-6"></div>
		<div class="col">
			<input type="submit" value="crea" class="w-25 btn btn-lg btn-primary">
		</div>
	</div>
</form>