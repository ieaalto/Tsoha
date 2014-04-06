<div class = "container">
    <br>
    <div class = "row">
        <?php $valinta = 4; 
        require "views/navigaatio.php"; ?>
        <div class="col-md-8">    
            <?php require "views/valitsekalenteri.php"; 
            if($data->valittu != null){
                $kalenteri = Kalenteri::haeKalenteri($data->kalenterit, $data->valittu); 
                ?>
                <br>
                <h4>Kalenterin tiedot</h4>
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div style="color:#00FF00"> <?php echo $data -> ilmo?></div>
                <p>Kalenterin tunnusluku on <?php echo $kalenteri->getId();?>. Kalenterin omistaa <?php echo $kalenteri->getOmistaja();?>.</p>
                <form class="form-horizontal" role="form" action="" method="POST">
                <div class = "form-group">
                   <div class="col-md-10">
                        <label  for="inputNimi" class="control-label">Nimi</label>
                        <input type="text" class="form-control" id="inputNimi" name="nimi" placeholder="Nimi" value="<?php echo $kalenteri->getNimi();?>" <?php  
                            if(($kalenteri->getOmistaja() != $_SESSION['kayttaja'])){echo ' disabled';}?>>
                   </div>                     
                </div>
                <div class ="form-group">
                    <div class = "col-md-10">
                        <label for="checkJulkinen" class ="control-label">Julkinen</label>
                        <input type="checkbox" name="julkinen" id="checkJulkinen" value="1" <?php if($kalenteri->getJulkinen() == 1){echo 'checked';} 
                        if(($kalenteri->getOmistaja() != $_SESSION['kayttaja'])){echo ' disabled';}?>>             
                    </div>
                </div>
                <div class ="form-group">
                    <div class = "col-md-10">
                        <label for="checkSaaJakaa" class ="control-label">Salli jakaminen eteenpäin</label>
                        <input type="checkbox" name="saajakaa" id="checkSaaJakaa" value="1" <?php if($kalenteri->getSaaJakaa() == 1){echo 'checked';} 
                        if(($kalenteri->getOmistaja() != $_SESSION['kayttaja'])){echo ' disabled';}?>>             
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-default" name="paivita" value=<?php echo $data->valittu; 
                        if(($kalenteri->getOmistaja() != $_SESSION['kayttaja'])){echo ' disabled';}
                        ?>>Tallenna</button>
                    </div>
                </div>
            </form>
            <br>
            <h4>Jakaminen</h4>    
            <a href= <?php echo "naytakayttajat.php?kalenteri="; echo $kalenteri->getId() ?>>Kalenterin käyttäjät</a>
            <form class = "form-inline" role="form" action="" method="POST">
                <div class="form-group">
                    <label for="inputJako" class ="control-label">Jaa käyttäjälle:</label>
                    <input type="text" id="inputJako" name="kenelle" placeholder="Käyttäjätunnus">
                    <button type = "submit" name="jaa" class="btn btn-default" value=<?php echo $data->valittu; 
                    if(!($kalenteri->getSaaJakaa() == 1 || $kalenteri->getOmistaja() == $_SESSION['kayttaja'])){ echo ' disabled';} ?>  >Jaa</button>
                </div>
            </form>
            <br>
            <h4>Poista kalenteri</h4>
            <p>Huom! Jos olet kalenterin omistaja, se poistetaan kaikilta käyttäjiltä!</p>
            <form role="form" action="" method="POST">
                <button type="submit" name="poista" value=<?php echo $data->valittu; ?> class="btn btn-default"><span class="glyphicon glyphicon-remove"></span>Poista kalenteri</button>
            </form>
            <?php }else if(isset($data->paivita)){
                echo '<br><b>Muutokset tallennettu!</b>';
            } else if(isset($data->poista)){
                echo '<br><b>Kalenteri poistettu!</b>';
            }?>
        </div>
    </div>
</div>>