<script>
$(document).ready(function(){
	//alert('alert');
});
function getCities(stateId){
	$.ajax({
	  url: "<?php echo base_url('index.php/welcome/getCitiesByStateId') ?>",
	  method: "post",
	  data: {
		  'stateId':stateId
	  },
	  success: function(data) {
		var mydata = JSON.parse(data);
		if(mydata['status'] == 'success'){
			var mycity = "";
			for(var i=0;i< mydata['msg'].length;i++){
				mycity += '<option value="'+mydata['msg'][i]['id']+'">'+mydata['msg'][i]['name']+'</option>';
			}
			$("#cities").html(mycity);
			//cities
		}
	  },
	  error: function() {
		 
	  }
	});
}
</script>
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
              <h3 class="box-title">Manage Areas</h3>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/welcome/add_site'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-2 control-label">State</label>
                  <div class="col-sm-10">
                    <select name="states" class="form-control" onchange="getCities(this.value);">
						<option value="">Select</option>
						<?php foreach($allStates as $states){
							?>
							<option value="<?php  echo $states['id']; ?>"><?php echo $states['name'];  ?></option>
							<?php
						} ?>
				   </select>
                  </div>
				  </div>
				  <div class="form-group">
                  <label  class="col-sm-2 control-label">city</label>
                  <div class="col-sm-10">
				   <select name="city" class="form-control" id="cities">
						<option value="">Select</option>
				   </select>
                  </div>
				 
                </div>
                
				
                <div class="form-group">
                  <label  class="col-sm-2 control-label">site</label>

                  <div class="col-sm-10">
                   <!-- <input type="text" class="form-control"  placeholder="Password">!-->
				   <!-- <select name="area" class="form-control">
					<option value="">Select</option>
					<option value="1">CG Road</option>
					<option value="2">AV Road</option>
				   </select>-->
				   <input type="text" name="site" class="form-control">
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
  