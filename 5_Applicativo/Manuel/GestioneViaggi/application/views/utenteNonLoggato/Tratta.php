<!DOCTYPE HTML>
<html>
<head>
 
    <title>Ricerca Viaggi</title>

    <meta charset="UTF-8">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Luca Fumasoli I2C">
    <meta name="description" content="">

  <!--Chrome e windows 10-->
  <!--data creazione: 10.02.2021 data ultima modifica: 25.11.2021-->

<script src="myscripts.js"></script>
<link rel="stylesheet" type="text/css" href="./style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<style>
.arrow {
    color:  blue;
}

.time {
    font-size: 10px;
}
</style>

<body style="background-color: #424242; color: white;">

<div style="color: white;">
    <div class="row">
        <div class="col-2">
            <span>442 </span>
        </div>
        <div class="col-4">
            <span>15 posti disponibili</span>
        </div>
        <br>
        <br>
    </div>
  
    <div class="row">
        <div class="col-1"></div>
        <div class="col-2 text-center">
            <h3><?php echo $result[0]['localita_partenza'] ?></h2><br>
            <h4><?php echo substr($result[0]['orario_partenza'], 11) ?></h3>
        </div>
        <div class="col"></div>
    </div>

    <?php 
        for ($i=1; $i < count($result); $i++) { ?>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-2 text-center">
                    <span class="arrow" style="font-size: 100px"> &#124;</span>
                </div>
                <div class="col-2">
                    <br>
                    <h3> <?php echo $result[$i]['localita_partenza']?></h2><br>
                    <h4><?php echo substr($result[$i]['orario_partenza'],11) ?></h3>
                </div>
                <div class="col"></div>
            </div>
       <?php }
    ?>

  
    <div class="row">
        <div class="col-1"></div>
        <div class="col-2 text-center">
            <span class="arrow" style="font-size: 100px">&darr;</span>
            <h2><?php echo $result[count($result)-1]['localita_arrivo']?></h2><br>
            <h3 ><?php echo substr($result[count($result)-1]['orario_arrivo'], 11)?></h3>
        </div>
        <div class="col"></div>
    </div>
    <br>
</div>

</body>
</html>