<div class = "container" > 
            <h2>Rekisteröityminen</h2>
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class = "form-group">               
                    <div class="col-md-5">
                        <label  for="inputTunnus" class="control-label">Käyttäjätunnus</label>
                        <?php 
                        if($data->tunnus != NULL){
                            $tunnus = $data->tunnus;
                        } else{
                            $tunnus = "";
                        }
                        ?>
                        <input type="text" class="form-control" id="inputTunnus" name="tunnus" placeholder="Tunnus" value=<?php echo $tunnus?>>
                    </div>
                </div>    
                <div class = "form-group">    
                    <div class = "col-md-5">
                        <label  for="inputSalasana" class="control-label">Salasana</label>
                        <input type="password" class ="form-control" id="inputSalasana" name="salasana" placeholder="Salasana">
                    </div>                    
                </div>
                <div class = "form-group">    
                    <div class = "col-md-5">
                        <label  for="inputSalasanaUud" class="control-label">Salasana uudelleen</label>
                        <input type="password" class ="form-control" id="inputSalasanaUud" name="salasana2" placeholder="Salasana uudelleen">
                    </div>                    
                </div>
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-default">Rekisteröidy</button>
                    </div>
                </div>            
            </form>
</div>
