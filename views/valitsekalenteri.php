<h3>Valitse muokattava kalenteri</h3>
<form class="form-inline" role="form" action="" method="POST">
                <div class = "form-group">               
                    <label for="selectKalenteri" class ="control-label">Kalenteri: </label>
                    <select name ="valittu" id="selectKalenteri" value=<?php ?>>
                        <?php 
                        foreach($data->kalenterit as $kalenteri){
                            $id = $kalenteri->getId();
                            ?><option value=<?php echo $id; if($id == $data->valittu){?> selected<?php } ?> ><?php echo $kalenteri->getNimi();?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-default">Valitse</button>
                    </div>
                </div>  
                
            </form>
