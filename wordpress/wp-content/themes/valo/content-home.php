   <div class="the_content" style="clear:both; margin:15px 0;">
 <?php the_content();?>
 </div>
  
  <div class="center">
 <?php
 
  for($i=1;$i<=3;$i++){
  $key_feature_title        =  valo_options_array('key_feature_title_'.$i);
  $key_feature_image        =  valo_options_array('key_feature_image_'.$i);
  $key_feature_description  =  valo_options_array('key_feature_description_'.$i);
  $key_feature_link         =  valo_options_array('key_feature_link_'.$i)
  
  ?>
  <div class="Featured_item Featured_item<?php echo $i;?>">
  <?php
   $thumb = "";
   
      if(isset($key_feature_image) && $key_feature_image != ""){
	$thumb = '<img src="'.$key_feature_image.'" alt="'.$key_feature_title.'" style="top: 0px;border:0px;" />';
	 }
   ?>
 <a style="width:300px;height:300px;display:block; color:#fff;" class="Featured_image" title="Facile Duis Mollisest" href="">
 <?php echo $thumb;?>
  </a>

    <div class="Featured<?php echo $i;?>" >
	
      <h1><?php echo $key_feature_title;?></h1>
      <span class="video_xian"></span>
      <p><?php echo $key_feature_description;?><br/>
        <a href="<?php echo esc_url($key_feature_link);?>"><?php _e("Learn more >>","sillver");?></a></p>
      </div>
   
	</div>
	
	<?php };?>
   
  </div>