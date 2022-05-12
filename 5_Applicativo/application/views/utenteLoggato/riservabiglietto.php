<script>
	function riservaPosto(pos) {
		var col = document.getElementById(pos).style.background;
		if (col == 'orange') {
			document.getElementById(pos).style.background = 'green';
		}else {
			document.getElementById(pos).style.background = 'orange';
		}
	}

	function countReservations(postiTotali) {		
		var postiRiservati = "";
		for (var i = 0; i < postiTotali; i++) {
			if (document.getElementById(i).style.background == 'orange') {
				postiRiservati += (i+1) + ",";
			}
		}
		document.getElementById("postiRiservati2").value = postiRiservati;
		document.getElementById("myFunction").submit();
	}

</script>


<form action="<?php echo URL . 'home/boughtTicket/' ?><?php echo $numBus . '/'?><?php echo $postiTot ?> " id="myFunction" method="post">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<span style="color: white;">numero linea: <?php echo $numBus ?></span>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-2"></div>
		<div class="col-1">
			<h5 style="color: white; vertical-align: center;"><?php echo $_SESSION['partenza'] ?></h5><br>
		</div>
		<div class="col-1">
			<span style="color: blue; font-size: 50px;">&#8594;</span>
		</div>
		<div class="col-1">
			<h5 style="color: white;"><?php echo $_SESSION['arrivo'] ?></h5><br>
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
	        	$posto = 1;
				$numCol = 4;
				$numRig = $postiTot / $numCol;
		        echo "<table border =\"1\" style='border-collapse: collapse; background-color: white;'>";
		        for ($i=0; $i < $numRig; $i++) {
		            echo "<tr>";
		            for ($j=0; $j < $numCol; $j++) {
		            	$pos =$j+$i*$numCol;

		            	if(in_array($posto, $arrPosti)){
		            		echo '<td><button type="button" style="background-color:red; height: 25px; disabled" class="w-25 btn btn-lg btn-primary" id=' . $pos . '></button></td>';
		            	}else{
		            		echo '<td><button type="button" style="background-color:green; height: 25px;" class="w-25 btn btn-lg btn-primary" id=' . $pos . ' onClick="riservaPosto(' . $pos . ')"></button></td>';
		            	}
		                
		                if ($j == 1) {
		                	echo '<td>&nbsp;&nbsp;</td>';
		                }
		                $posto++;
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
			<input type="button" name="" value="Acquista" class="w-25 btn btn-lg btn-primary" onclick="countReservations( <?php echo $postiTot ?> )" />
			<input type="hidden" id="postiRiservati2" name="postiRiservati2">
		</div>
	</div>
</form>