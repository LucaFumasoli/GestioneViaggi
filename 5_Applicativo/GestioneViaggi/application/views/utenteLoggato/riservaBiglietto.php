<script>
	function riservaPosto(pos) {
		var col = document.getElementById(pos).style.background;
		if (col == 'red') {
			document.getElementById(pos).style.background = 'green';
		}else {
			document.getElementById(pos).style.background = 'red';
		}
	}

</script>

<form action=" <?php echo URL . 'home/' ?> " method="get">
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">numero linea: <?php echo $bus->getName() ?></span>
		</div>
		<div class="col-1">
			<span style="color: white;">numero posti: <?php echo $bus->getPlaces() ?></span>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;"><?php echo $_POST['locPar'] ?></span><br>
			<span style="color: white;"><?php echo $_POST['oraPar'] ?></span>
		</div>
		<div class="col-1">
			<span style="color: blue; font-size: 50px;">&#8594;</span>
		</div>
		<div class="col-1">
			<span style="color: white;"><?php echo $_POST['locArr'] ?></span><br>
			<span style="color: white;"><?php echo $_POST['oraArr'] ?></span>
		</div>
	</div>
	<hr style="height:5px;color:black;">
	<br>
	<div class="row">
		<div class="col-2">
			<span style="color: white;">Seleziona posti</span>
		</div>
		<div class="col-2">

	        <?php

				$numCol = 4;
				$numRig = $bus->getPlaces()/4;

		        echo "<table border =\"1\" style='border-collapse: collapse; background-color: white;'>";
		        for ($i=0; $i < $numRig; $i++) {
		            echo "<tr>";
		            for ($j=0; $j < $numCol; $j++) {
		            	$pos = "'pos" . $j+$i*$numCol . "'";
		                echo '<td><button type="button" style="background-color:green; height: 25px;" class="w-25 btn btn-lg btn-primary" id=' . $pos . ' onClick="riservaPosto(' . $pos . ')"></button></td>';
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
		<div class="col-2"></div>
		<div class="col">
			<input type="submit" value="Acquista" class="w-25 btn btn-lg btn-primary">
		</div>
	</div>
</form>