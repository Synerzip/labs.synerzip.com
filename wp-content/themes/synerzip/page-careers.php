<?php
get_header(); 
global $post;
//echo "<pre>";print_r($post);
//$terms=getParentandChildTaxonomy('practice');
?>
                <!--banner section end-->

                <!--career section start-->   
                
<section class="f-fix career-main-wrapper grey-bg synerzip-watermark" id="career-main-wrapper">
  <div class="container">
    <div class="synerzip-about-wrapper">
  <?php echo $post->post_content;?>
    </div>
    <div class="india-career-wrapper">
      <div class="section-head" id="openings">
        <h2>Current Openings
          <select class="div-toggle country-opening" data-target=".carrer-list" onchange="java_script_:show(this.options[this.selectedIndex].value)">
            <option value="india" data-show=".india-career">India</option>
            <option  value="us" data-show=".us-career">USA</option>
          </select>
          <div class="caret"></div>
        </h2>
      </div>  
      <div class="row">
        <div class="col-md-12">
          <div class="career-list">
			<?php
			  
			  $condition=array();
$condition['post_type']='job';
$condition['posts_per_page']='8';
$passhash='showAll';
$posts=fetch_rulequery($passhash,$condition);
$allPosts=$posts->posts;
			 // echo "<pre>";print_r($allPosts);
			  foreach($allPosts as $jobPost)
			  {
				  $location = get_the_terms( $jobPost->ID , 'location' );
				  $jobPost->years_of_experience = get_field('years_of_experience',$jobPost->ID);
				  $jobPost->link=get_permalink($jobPost->ID);
				if($location[0]->name=="India")
				{
					$IndiaJobs[]=$jobPost;
				}
				 else
				  {
					  $USJobs[]=$jobPost;
				  }
			  }
			  
			  if(isset($IndiaJobs) && !empty($IndiaJobs))
			  {
				  
			  ?>
            <table class="table india-career syn-table-style hide">
              <tbody>
				<?php 
				  foreach($IndiaJobs as $singleJobIndia)
				  {
					  ?>
                <tr  onclick= "document.location='<?php echo $singleJobIndia->link;?>'">
                  <td><?php echo $singleJobIndia->post_title;?> </td>
                  <td><?php echo $singleJobIndia->years_of_experience;?> years of experience</td>
                  <td><i style="font-size:24px" class="fa">&#xf178;</i></td>
                </tr>
                 <?php
				  }
				  ?>
                        <tr  style="border-bottom: 1px solid #ddd;"class="to-append">
                            <td colspan="3"><div  style=" text-align: center;
    text-transform: uppercase;" class="loadmore">More Jobs<i id= "loading" class="fa fa-refresh fa-spin" style="padding:10px"></i></div></td>
                        </tr>
              </tbody>
            </table>
			 <?php
				 
			  }
			  
			   if(isset($USJobs) && !empty($USJobs))
			  {
				  
			  ?>
            <table class="table us-career syn-table-style hide">
              <tbody>
				  <?php 
				  foreach($USJobs as $singleJobUS)
				  {
					  ?>
                <tr href="<?php echo $singleJobUS->link;?>">
                  <td><?php echo $singleJobUS->post_title;?> </td>
                  <td><?php echo $singleJobUS->years_of_experience;?> years of experience</td>
                  <td><i style="font-size:24px" class="fa">&#xf178;</i></a></td>
                </tr>
           <?php } ?>
			 <tr  style="border-bottom: 1px solid #ddd;"class="to-append">
                            <td colspan="3"><div  style=" text-align: center;
    text-transform: uppercase;" class="loadmore">More Jobs<i id= "loading" class="fa fa-refresh fa-spin"></i></div></td>
                        </tr>
				  </tbody>
            </table>
			  <?php
			  }?>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="container-fluid no-padding push-down-3">
    <div class="emp-benefit-wrapper" id="empben">
      <div class="container">
        <div class="section-head">
          <h2>Employee Benefits</h2>
        </div>  
        <?php 
		  $page = get_page_by_title('Employee Benefits', OBJECT, 'page');
		 if(isset($page) && $page->post_content!='')
			 {
			echo $page->post_content;  
		 	  }
			 ?>
      </div>
    </div>
  </div>

  <div class="container">
    	  <?php
	  	  $page='';
		  $page = get_page_by_title('Our Culture', OBJECT, 'page');
	//$page='';
		 if(isset($page) && $page->post_content!='')
			 {
			echo $page->post_content;  
		 	  }
			 
			 ?>
  </div>
   <div class="container-fluid no-padding">
<div class="next-page-wrapper">
	<div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/contact">Contact Us</a></h4>
				<div class="arrow">	
					<a href="/contact"><img src="../wp-content/uploads/2017/11/skype.png"></a>
				</div>
			</div>
		</div>
	</div>
</div>
  </div>
</section>
                <style>
                    
                    .next-img{
                            align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
   
                    }

</style>
<SCRIPT> 	
	function show(select_item) {
	    if (select_item == "india") {
		    empben.style.visibility='visible';
			empben.style.display='block';
			
		} 
		else{
			empben.style.visibility='hidden';
			empben.style.display='none';
		}
	}	
</SCRIPT>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var page =2;
    jQuery(function($){
        $('#loading').hide();
        $('body').on('click', '.loadmore', function(){
            var data = {
                'action': 'load_jobs_by_ajax',
                'page': page
                             
            };
            $('#loading').show();
            $.post(ajaxurl, data, function(response){
                $('.to-append').before(response);
                page++;
                $('#loading').hide();
                //console.log(response);
            });
        });
    });
</script>

                <!--career section end-->

                <!--footer section start-->

<?php 
get_footer(''); 
?>