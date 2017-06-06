<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  <!-- right column -->
    <div class="row">
         <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Ticket Id</th>
                  <th>City</th>
                  <th>Site</th>
                  <th>Issue Desc</th>
                  <th>Supervised By</th>
                  <th>Issue Resolved By Technician</th>
                  <th>Created At</th>
                  <th>Closed At</th>
                  <th>Closing Comment</th>
                </tr>
                </thead>
                <tbody>
               
                <?php 
				//print_r($closingReport);
			foreach($closingReport as $user)
			{?>
				<tr>
					<td><?php echo $user['ticket_id']; ?></td>
					<td><?php $city= $this->ComplainModel->getCitiesById($user['city']); 
					echo $city[0]['name'];
					?></td>
					<td><?php $site=$this->ComplainModel->getSitesById($user['site']);
					echo $site[0]['site_name'];
					?></td>
					<td><?php echo $user['issue_desc']; ?></td>
					<td><?php $supervisor= $this->ComplainModel->getSupervisorById($user['supervisor_id']); 
					echo $supervisor[0]['supervisor_name'];
					?></td>
					<td><?php $technician = $this->ComplainModel->getTechnicianById($user['tech_id']);
						echo $technician[0]['technician_name'];
					?></td>
					<td><?php echo $user['c_created']; ?></td>
					<td><?php echo $user['closed_at']; ?></td>
					<td><?php echo $user['issue_comment']; ?></td>
				</tr>
			<?php
			}
			?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
	</div>
