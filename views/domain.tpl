
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Domain</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($mail->getDomains() as $mailOut)
                    {
                        echo '
                            <tr>
                                <td>'.$mailOut["id"].'</td>
                                <td>'.$mailOut["domain"].'</td>
                                <td>
                                    <a href="index.php?go=domain&domainDel='.$mailOut["id"].'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp;
                                </td>
                            </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
