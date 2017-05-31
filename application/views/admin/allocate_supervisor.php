
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Area</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Area Master</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Allocate Site Supervisor For Complain</h3>
			  <?php
	if($this->session->flashdata('allocate_msg')){
		?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('allocate_msg'); ?></div>
		<?php 
	}
	if($this->session->flashdata('allocate_msg_error')){
		?>
		<div class="alert alert-danger"><?php echo $this->session->flashdata('allocate_msg_error'); ?></div>
		<?php
	}
	 
?>
		
			<?php if(validation_errors()) { ?>			
			<div class="alert alert-danger">
			<?php echo validation_errors();  ?>
			</div>	
			<?php
			} if(isset($status) && $status!="")  {
				?>
				<div class="alert alert-success"><?php echo $status; ?></div>
				<?php
			}
			?>		
	
	 
?>
			  </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/welcome/add_allocate_supervisor'); ?>">
              <div class="box-body">
				  <div class="form-group">
                  <label  class="col-sm-2 control-label">TicketId #</label>
                  <div class="col-sm-10">
				  <!-- <input type="text" name="supervisor_name" class="form-control">-->
				  <select name="ticket_id" class="form-control">
				  <?php foreach($alltickets as $ticket){
							?>
							<option value="<?php  echo $ticket['ticket_id']; ?>"><?php echo $ticket['ticket_id'];  ?></option>
							<?php
						} ?>
				  </select>
                  </div>
				 
                </div>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Supervisor Name</label>

                  <div class="col-sm-10"> 
				  <!-- <input type="text" name="qualification" class="form-control">-->
				  <select name="supervisor_id" class="form-control">
				  <?php foreach($allSupervisors as $supervisor){
							?>
							<option value="<?php  echo $supervisor['supervisor_id']; ?>"><?php echo $supervisor['supervisor_name'];  ?></option>
							<?php
						} ?>
				  </select>
                  </div>
                </div> 
                </div>
				
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Book</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        <!--/.col (right) -->

        </section>
     
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  