<?php
wp_enqueue_style('all-post-style', wp_ep_fitness_URLPATH. 'admin/files/css/all-post.css', array(), $ver = false, $media = 'all');
?>
          <div class="profile-content">
            
              <div class="portlet light">
                <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"> <?php _e('New Physical Record','epfitness'); ?></span>
                    </div>
					
                  </div>
               
                  
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">					 			
					
						<div class="row">
							<div class="col-md-12">	 						
							 
							<form action="" id="new_post" name="new_post"  method="POST" role="form">															
								
<img src="<?php echo wp_ep_fitness_URLPATH.'assets/images/unnamed.jpg'; ?>" width="600" height="125" title="Body Measurement" alt="Body Measurement" />

								
							<label for="text" class=" control-label"><?php esc_html_e('Instruction: Fill out the Physical Record every end of the week to track and monitor your Progress.','epfitness'); ?></label>

								<div class="upload-content">
									<div class="row">
									
										<div class="col-md-6">
											<div class="form-group ">
												<label for="text" class="control-label"><?php _e('Current Status Image','epfitness'); ?>  </label>
												
													<div class="image-content" id="post_image_div">
														
														
																			
													</div>
													
													<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
													
													<div class="" id="post_image_edit">	
														<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-sm green-haze"><?php esc_html_e('Add','epfitness'); ?> </button>
														
													</div>									
											</div>
										</div>

									</div>
								</div>
								
								<div class=" form-group">
									<label for="text" class=" control-label"><?php _e('Week #','epfitness'); ?></label>
									<div class="  "> 
										<input type="text" class="" name="week" id="week" value="" placeholder="<?php _e('Enter Week number','epfitness'); ?>">
									</div>																		
								</div>
								
								<div class=" form-group">
									<label for="text" class=" control-label"><?php _e('Date','epfitness'); ?></label>
									<div class="  "> 
										<input type="date" class="" id="date" name='date' size='9' value="" placeholder="<?php _e('Date','epfitness'); ?>"> 
 
									</div>																		
								</div>
								<?php									
										
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
										foreach ( $default_fields as $field_key => $field_value ) { ?>
												 <div class="form-group">
													<label class="control-label"><?php echo _e($field_value, 'epfitness'); ?></label>
													<input type="text" placeholder="<?php echo _e('Enter', 'epfitness'); ?> <?php echo ' '.$field_value;?>" name="<?php echo $field_key;?>" id="<?php echo $field_key;?>"  value=""/>
												  </div>

										<?php
										}
									
									?>	
								
								<div class="margiv-top-10">
								    <div class="" id="update_message"></div>
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php //echo $curr_post_id; ?>">
								    <button type="button" class="btn-new btn-custom"  onclick="iv_save_post();"  class="btn green-haze"><?php esc_html_e('Save Record','epfitness'); ?></button>
		                          
		                        </div>	
									 
							</form>
						  </div>
						</div>
			
					  
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->

          
	 <script>	

 $(function()
                {
                         $( "#date" ).datepicker();
                         $("#icon").click(function() { $("#date").datepicker( "show" );})
                 });
 











function iv_save_post (){

	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_ep_fitness_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"ep_fitness_save_record",	
					"form_data":	jQuery("#new_post").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = "<?php echo get_permalink(); ?>?&profile=records";    						
								jQuery(location).attr('href',url);	
						}						
					}
				});
	
	}


function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Add</button>');
}
	
 function edit_post_image(profile_image_id){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Current Pic', 'epfitness' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Current Pic', 'epfitness' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  						   
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	}

			
</script>	  
        
