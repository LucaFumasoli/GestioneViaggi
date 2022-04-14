<form method="POST" action="<?php echo URL . 'home/viaggi' ?>">
<div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <h1 class="h3 mb-3 fw-normal" style="color: white;">Cerca viaggi</h1>
            </div>
            <div class="col-3"></div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-4"></div>
            <div class="col">
                <div class="form-floating">
                    <input type="text" class="form-control" id="luogoPartenza" name="luogoPartenza" placeholder="Luogo di partenza">
                    <label for="luogoPartenza">Luogo di partenza</label>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-4" ></div>
            <div class="col">
                <div class="form-floating">
                    <input type="text" class="form-control" id="luogoArrivo" name="luogoArrivo" placeholder="Luogo di arrivo">
                    <label for="luogoArrivo">luogo di arrivo</label>
                </div>
            </div>
            <div class="col-4" ></div>
        </div>
        <br>
        <div class="row">
            <div class="col-2" ></div>
            <div class="col-4">
                <div class="form-floating">
                    <input type="date" class="form-control" id="dataViaggio" name="dataViaggio" placeholder="data del viaggio">
                    <label for="dataViaggio">Data del viaggio</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating">
                    <input type="time" class="form-control" id="orarioViaggio" name="orarioViaggio" placeholder="orario del viaggio">
                    <label for="orarioViaggio">Orario del viaggio</label>
                </div>
            </div>
            <div class="col-2" ></div>
        </div>
        <br>
        <div class="row">
            <div class="col-4" ></div>
            <div class="col">
                <div class="form-floating">
                    <input class="w-25 btn btn-lg btn-primary" type="submit" name="button" value="cerca" />
                </div>
            </div>
        </div>
    <br>
    <br>
    <hr style="height:4px;color:white;">
</div>
</form>

