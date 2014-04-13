<div class = "container">
    <br>
    <div class = "row">
        <?php $valinta = 1; 
        require "views/navigaatio.php"; ?>
        <div class = "col-md-8">            
            <h3>Tänään on <?php echo viikonpaiva(), date(' j.n.Y');?></h3>
                <form class="form-inline" role="form" action="" method="POST">
                    <label for="selectKalenteri" class ="control-label">Kalenteri: </label>
                    <select name="valittu" id="selectKalenteri" value=-1>
                        <option value = -1 <?php if($data->valittu == -1){ ?>selected<?php } ?>>Kaikki</option>
                        <?php 
                        foreach($data->kalenterit as $kalenteri){
                            $id = $kalenteri->getId();
                            ?><option value=<?php echo $id; if($id == $data->valittu){?> selected<?php } ?> ><?php echo $kalenteri->getNimi();?></option>
                        <?php } ?>
                    </select>
                    <label for="selectAikavali" class ="control-label">Näytä merkinnät ajalle: </label>
                    <select name = "aikavali" id="selectAikavali">
                        <option value="1" <?php if($data->aikavali == "1"){ ?>selected<?php } ?> >Tänään</option>
                        <option value="2" <?php if($data->aikavali == "2"){ ?>selected<?php } ?> >Viikon sisällä</option>
                        <option value="3" <?php if($data->aikavali == "3"){ ?>selected<?php } ?> >Kuukauden sisällä</option>
                        <option value="4" <?php if($data->aikavali == "4"){ ?>selected<?php } ?> >Kaikki</option>
                    </select>
                    <button name = "paivita" type="submit" class="btn btn-default">Näytä</button>
                </form>
                <?php if(!empty($data->merkinnat)){?>
                    <table class="table table">
                        <thread>
                            <tr>
                                <th>Pvm</th>
                                <th>Klo</th>
                                <th>Aihe</th>
                                <th>Muokkaa</th>
                                <th>Poista</th>
                            </tr>
                        </thread>
                        <tbody>
                            <?php foreach($data->merkinnat as $merkinta){?>
                                <tr>
                                    <td><?php echo $merkinta->getPvm() ?></td>
                                    <td><?php echo $merkinta->getKlo() ?></td>
                                    <td><?php echo $merkinta->getAihe()?></td>
                                    <td><form action="muokkaamerkintaa.php" method="POST"><button type="submit" name="merkinta" <?php echo "value=".$merkinta->getId();?> class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span> </button></form></td>
                                    <td><form action="" method="POST"><button name="poista" <?php echo "value=".$merkinta->getId() ;?> type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> </button></form></td>
                                </tr> 
                            <?php }?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <br>
                    <p><b>Ei merkintöjä valitulle ajalle.</b></p>
                 <?php } ?>
        </div>
    </div>
</div>


