<div class = "container">
    <br>
    <h3>Tänään on <?php echo viikonpaiva(), date(' j.n.Y');?></h3>
    <form class="form-inline" role="form" action="" method="POST">
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
                 </tr>
            </thread>
            <tbody>
                <?php foreach($data->merkinnat as $merkinta){?>
                    <tr>
                        <td><?php echo $merkinta->getPvm() ?></td>
                        <td><?php echo $merkinta->getKlo() ?></td>
                        <td><?php echo $merkinta->getAihe()?></td>
                    </tr> 
                <?php }?>
            </tbody>
        </table>
     <?php } else { ?>
        <br>
        <p><b>Ei merkintöjä valitulle ajalle.</b></p>
     <?php } ?>
</div>



