
<?php
require_once  'libs/tietokantayhteys.php';

function haeKalenterit(){
    $palautus = array();
    $kysely = getTietokantayhteys()->prepare('select nimi, omistaja, tunnusnumero from kalenteri');
    $kysely ->execute();
    foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $rivi){
         $palautus[] = $rivi;
    }
    return $palautus;
}

$kalenterit = haeKalenterit();
?>
<html>
    <head>
        <title>Listaustesti</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>        
        <div class = "container">
            <table class="table table">
                <thread>
                    <tr>
                        <th>Nimi</th>
                        <th>Omistaja</th>
                        <th>Tunnusnumero</th>
                    </tr>
                </thread>
                <tbody>
                    <?php foreach($kalenterit as $kalenteri){ ?>
                    <tr>
                        <td><?php echo $kalenteri->nimi;?></td>
                        <td><?php echo $kalenteri->omistaja;?></td>
                        <td><?php echo $kalenteri->tunnusnumero;?></td>
                    </tr>
                    <?php }?>
                </tbody>
                
            </table>
        </div>    
        </div>
        </div>
    </body>
</html>