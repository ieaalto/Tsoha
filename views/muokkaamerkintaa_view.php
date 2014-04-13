<div class = "container">
    <br>
    <div class = "row">
        <?php $valinta = 1; 
        require "views/navigaatio.php"; ?>
        <div class = "col-md-8">
            <h3>Muokkaa merkintää</h3>
            
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class = "form-group">               
                    <div class="col-md-10">
                        <label  for="inputAihe" class="control-label">Aihe</label>
                        <input type="text" class="form-control" id="inputAihe" name="aihe" placeholder="Aihe" <?php echo "value='".$data->aihe."'";?>>
                    </div>
                </div>    
                
                <div class ="form-group">
                  <div class = "form-inline">    
                    <div class = "col-md-10">
                        <label  for="inputP" class="control-label">Pvm</label>
                        <input type="text" size="2" class="form-control " id="inputP" name="pp" placeholder="PP" value=<?php echo $data->pp?>>
                        <input type="text" size="2" class="form-control " name="kk" placeholder="KK" value=<?php echo $data->kk?>>
                        <input type="text" size="4" class="form-control " name="vv" placeholder="VVVV" value=<?php echo $data->vv?>>
                        <label for="inputH" class ="control-label">Klo</label>
                        <input type="text" size="2" class="form-control " id="inputH" name="hh" placeholder="HH" value=<?php echo $data->hh?>>
                        <input type="text" size="2" class="form-control " name="mm" placeholder="MM" value=<?php echo $data->mm?>>
                    </div>
                    
                  </div>    
                </div>
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button name="laheta" <?php echo"value=".$data->id." " ;?> type="submit" class="btn btn-default">Merkitse</button>
                    </div>
                </div>            
            </form>
            
        </div>
    </div>
</div>





