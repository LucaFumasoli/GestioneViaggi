<form action=" <?php echo URL . 'home/' ?> " method="get">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">numero linea</span>
		</div>
		<div class="col-1">
			<span style="color: white;">numero posti disponibili</span>
		</div>
	</div>
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">Partenza</span><br>
			<span style="color: white;">orario</span>
		</div>
		<div class="col-1">
			<span style="color: blue; font-size: 50px;">&#8594;</span>
		</div>
		<div class="col-1">
			<span style="color: white;">Destinazione</span><br>
			<span style="color: white;">orario</span>
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
	            $numRig = 4;

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
		<div class="col-2"></div>
		<div class="col">
			<input type="submit" value="Acquista" class="w-25 btn btn-lg btn-primary">
		</div>
	</div>
</form>