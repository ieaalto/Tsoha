<div class = "container">
    <br>
    <div class = "row">
        <?php $valinta = 4; 
        require "views/navigaatio.php"; 
        $kalenteri = $data->kalenteri;
        $kayttajat = $data->kayttajat;
        ?>
        <div class="col-md-8">
            <h3>Kalenterin käyttäjät:</h3>
            <table class="table table"> 
                <thread>
                    <tr>
                        <td>Käyttäjä </td>
                    </tr>
                </thread>
                <?php foreach($kayttajat as $kayttaja){?>
                <tr>
                    <th><?php echo $kayttaja; ?></th>
                </tr>
                <?php }?>
            </table>
            
        </div>
    </div>
</div>
