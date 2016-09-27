<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    </head>
    <body>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TYPE</th>
                    <th>INCIDENT DATE</th>
                    <th>LOCATION</th>
                    <th>RESPONDER</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items AS $row):?>
                    <tr>
						<td>#<?= $row['id']?></td>
						<td><?= $row['incident_type']?></td>
						<td><?= format_date($row['incident_date'], 'F d, Y')?></td>
						<td><?= $row['formatted_address']?></td>
						<td><?= $row['responder']?></td>
						<td>
							<?php if($row['approved_by']):?>
								<span class="label label-success">Approved</span>
							<?php elseif(!$row['approved_by'] && $row['rejected_by']):?>
								<span class="label label-danger">Rejected</span>
							<?php else:?>
								<span class="label label-warning">Pending approval</span>
							<?php endif;?>
						</td>
					</tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </body>
</html>