
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
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
                                    <a href="index.php?go=domainEdit&dID='.$mailOut["id"].'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
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
