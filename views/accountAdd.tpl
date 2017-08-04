<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Add Account</h2>
            <form accept-charset="UTF-8" role="form" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="basic-addon1">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <select class="form-control" id="sel1">
                    <?php
                        foreach($mail->getDomains() as $dout)
                        {
                            echo '<option value="'.$dout['id'].'">'.$dout['domain'].'</option>';
                        }
                    ?>
                    </select>
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                    <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                </div>
                <br />
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span></span>
                    <input type="password" class="form-control" placeholder="Quota (MB)" aria-describedby="basic-addon1">
                </div>
                <br />
                <br />
                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Add Account">
            </form>
        </div>
    </div>
</div>
