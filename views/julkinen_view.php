<div class = "container">
            <br>
            <form class = "form-horizontal" role="form" action="" method = "POST"> 
                <div class = "form-group">               
                    <div class="col-md-5">
                        <label  for="inputKalenteriID" class="control-label">Anna kalenterin tunnusnumero:</label>
                        <input type="text" class="form-control" id="inputKalenteriID" name="tunnus" placeholder="Kalenterin tunnus">
                    </div>
                </div> 
                <div style="color:#FF0000"> <?php echo $data -> virhe?></div>
                <div class="form-group">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-default">Hae kalenteri</button>
                    </div>
                </div> 
            </form>    
        </div>

