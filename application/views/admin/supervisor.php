
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
              <h3 class="box-title">Manage Supervisor</h3>
			<?php if(validation_errors()) { ?>			
			<div class="alert alert-danger">
			<?php echo validation_errors();  ?>
			</div>	
			<?php
			} if(isset($status) && $status!="") {
				?>
				<div class="alert alert-danger"><?php echo $status; ?></div>
				<?php
			}
			?>
			  </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/welcome/add_supervisor'); ?>">
              <div class="box-body">
				  <div class="form-group">
                  <label  class="col-sm-2 control-label">Supervisor Name</label>
                  <div class="col-sm-10">
				   <input type="text" name="supervisor_name" class="form-control">
                  </div>
				 
                </div>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Qualification</label>

                  <div class="col-sm-10"> 
				   <input type="text" name="qualification" class="form-control">
                  </div>
                </div> 
				<div class="form-group">
                  <label  class="col-sm-2 control-label">Expertise</label>

                  <div class="col-sm-10"> 
				   <input type="text" name="expertise" class="form-control">
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
  