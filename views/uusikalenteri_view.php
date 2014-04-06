<div class = "container">
    <br>
    <div class = "row">        
        <?php $valinta = 3; 
        require "views/navigaatio.php"; 
        if(isset($data->tallennettu)){
            echo '<br><b>Kaleteri tallennettu!</b> Voit jakaa kalenterin muille käyttäjille Muokkaa kalentereita -valikosta.';
        } else {?>
        
        <div class = "col-md-8">
            <h3>Uusi kalenteri</h3>
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class = "form-group">               
                    <div class="col-md-10">
                        <label  for="inputNimi" class="control-label">Nimi</label>
                        <input type="text" class="form-control" id="inputNimi" name="nimi" placeholder="Nimi">
                    </div>
                </div>    
                <div class ="form-group">
                    <div class = "col-md-10">
                        <label for="checkJulkinen" class ="control-label">Julkinen</label>
                        <input type="checkbox" name="julkinen" id="checkJulkinen" value="1">             
                    </div>
                </div>
                <div class ="form-group">
                    <div class = "col-md-10">
                        <label for="checkSaaJakaa" class ="control-label">Saa jakaa</label>
                        <input type="checkbox" name="saaJakaa" id="checkSaaJakaa" value="1">             
                    </div>
                </div>
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" name="tallenna" value="true" class="btn btn-default">Tallenna</button>
                    </div>
                </div>  
                
            </form>
            
        </div>
    </div>
</div>>
        <?php }?>

