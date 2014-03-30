<div class = "container" > 
            <h1>Tervetuloa!</h1>
            <p>Luodaksesi uuden käyttäjätunnuksen täytä lomakkeeseen haluamasi käyttäjätunnus ja salasana</p>
            <a href="">Julkisia kalentereita selaamaan pääset tästä.</a>
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
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-default">Kirjaudu</button>
                    </div>
                </div>            
            </form>
</div>
