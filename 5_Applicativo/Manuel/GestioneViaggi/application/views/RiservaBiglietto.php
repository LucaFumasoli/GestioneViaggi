<form action=" <?php echo URL . 'home/creaNuovoBus' ?> " method="get">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">numero posti</span>
		</div>

		<div class="col-1">
			<form action=" <?php echo URL . 'home/creaBus' ?> " method="get">
				<select name="grandezza" id="grandezza">
				  <option value="0">Piccolo</option>
				  <option value="1">Medio</option>
				  <option value="2">Grande</option>
				</select>
				<input type="submit" value="conferma">
			</form>
			<script type="text/javascript">
				document.getElementById('grandezza').value = "<?php echo $grand;?>";
			</script>
			<sub>
		</div>
		<div class="col-2"></div>
		<div class="col-1">
      		<span style="color: white;">nome linea</span>
		</div>
		<div class="col-1">
			<input type="number" name="nomeLinea">
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