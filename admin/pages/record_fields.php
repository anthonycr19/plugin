<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}

</style>
			<?php
			global $wpdb;
			global $current_user;
			$ii=1;
			
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">
						<div class="row">
							
							<div class="col-md-12"><h3 class="page-header"><?php _e('Record Fields','ivdirectories'); ?>  <br /><small> &nbsp;</small> </h3>
							</div>
						</div> 
						<div id="success_message">	</div>
						
						
						
							
							
						<div class="panel panel-info">
						<div class="panel-heading"><h4>Record Fields </h4></div>
						<div class="panel-body">	
							
							
							<form id="dir_fields" name="dir_fields" class="form-horizontal" role="form" onsubmit="return false;">	
																							
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4>Post Meta Name</h4>
												</div>
												<div class="col-sm-5">
													<h4>Display Label</h4>									
												</div>
												<div class="col-sm-2">
													<h4>Action</h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('ep_fitness_fields' );
															
															
														if($field_set!=""){ 
																$default_fields=get_option('ep_fitness_fields' );
														}else{															
																$default_fields['height']='Height';
																$default_fields['weight']='Weight';
																$default_fields['chest']='Chest';
																$default_fields['l-arm']='Left Arm';
																$default_fields['r-arm']='Right Arm';
																$default_fields['waist']='Waist';
																$default_fields['abdomen']='Abdomen';
																$default_fields['hips']='Hips';
																$default_fields['l-thigh']='Left Thigh';
																$default_fields['r-thigh']='Right Thigh';
																$default_fields['l-calf']='Left Calf';
																$default_fields['r-calf']='Right Calf';
														}
														if(sizeof($field_set)<1){																
																$default_fields['height']='Height';
																$default_fields['weight']='Weight';
																$default_fields['chest']='Chest';
																$default_fields['l-arm']='Left Arm';
																$default_fields['r-arm']='Right Arm';
																$default_fields['waist']='Waist';
																$default_fields['abdomen']='Abdomen';
																$default_fields['hips']='Hips';
																$default_fields['l-thigh']='Left Thigh';
																$default_fields['r-thigh']='Right Thigh';
																$default_fields['l-calf']='Left Calf';
																$default_fields['r-calf']='Right Calf';
														 }
														$i=1;	
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field('<?php echo $i; ?>');">Delete</button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field();">Add More</button>
									 </div>	
									<input type="hidden" name="dir_name" id="dir_name" value="<?php echo $main_category; ?>">	 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_dir_fields();">Update </button>
												</div>
												<p>&nbsp;</p>
											</div>
						</div>							 
				
				</div>			 	
					
					
					
			
					
							
			
									
			  </div>						
		</div>		 


<script>
	var i=<?php echo $i; ?>;
	var ii=<?php echo $ii; ?>;
	
	
	function update_dir_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"ep_fitness_update_dir_fields",
			"form_data":	jQuery("#dir_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field(){	
	
		jQuery('#custom_field_div').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	// Doctor**********
	function update_doctor_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_doctor_fields",
			"form_data":	jQuery("#doctor_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_doctor').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	
		
</script>				
			
