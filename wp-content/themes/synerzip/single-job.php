<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

get_header();
global $post;
 $post->locations = get_field('location',$post->ID);
  $post->overview = get_field('overview',$post->ID);
  $post->responsibilities = get_field('responsibilities',$post->ID);
  $post->skills_and_experience = get_field('skills_and_experience',$post->ID);
  $post->education= get_field('education',$post->ID);
  $post->benefits= get_field('benefits',$post->ID); 
   
?>
<section class="f-fix career-single-wrapper" id="career-single-wrapper">
  <div class="container">
    <div class="text-content-block type-list">
		<?php if(isset($post->overview ) && !empty($post->overview) )
{?>
		<h2 class="push-down-3">Overview</h2> 
      <p><?php echo $post->overview;?></p>
	<?php 	}?>
				<?php if(isset($post->responsibilities ) && !empty($post->responsibilities) )
{?>
		<h2 class="push-down-3">Responsibilities</h2> 
      <p><?php echo $post->responsibilities;?></p>
	<?php 	}?>
				<?php if(isset($post->skills_and_experience ) && !empty($post->skills_and_experience) )
{?>
		<h2 class="push-down-3">Skills And Experience</h2> 
      <?php echo $post->skills_and_experience;?>
	<?php 	}?>
				<?php if(isset($post->education ) && !empty($post->education) )
{?>
		<h2 class="push-down-3">Education</h2> 
      <p><?php echo $post->education;?></p>
	<?php 	}?>
				<?php if(isset($post->benefits ) && !empty($post->benefits) )
{?>
		<h2 class="push-down-3">Benefits</h2> 
      <p><?php echo $post->benefits;?></p>
	<?php 	}?>
    </div>
 



    <div class="apply-form">
      <button class="form-btn">Apply Now</button>
      <div class="form-container push-down-4">
        <form>
          <div class="form-group">
            <label for="emailId">Email id <span>*</span></label>
            <input type="email" class="form-control" id="emailId">
          </div>
          <div class="form-group">
            <label for="InputFile">Resume <span>*</span></label>
            <input type="file" name="file" id="InputFile" class="inputfile">
            <label for="InputFile" class="custom-upload">Choose file</label><span class="no-file">No file chosen</span>
            <p class="help-block">Only the following file extensions are allowed: pdf, doc and docx</p>
          </div>
          <div class="form-group">
            <label for="coverLetter">Cover Letter </label>
            <textarea class="form-control" id="coverLetter" rows="7"></textarea>
          </div>
          <div class="text-center push-down-3">
            <button type="submit" class="form-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
	
<?php 
if(($post->locations)=="India")
{?>
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
 <?php }?>
</section>

        <!--career-content-end-->





        <!--career-list-start-->

<section class="f-fix career-main-wrapper grey-bg" id="career-main-wrapper">
  <div class="container">
    <div class="india-career-wrapper">
      <div class="section-head">
        <h2>Current Openings
          <select class="div-toggle country-opening" data-target=".carrer-list">
            <option value="india" data-show=".india-career">India</option>
            <option value="us" data-show=".us-career">US</option>
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
$condition['posts_per_page']='30';
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
                <tr  href="<?php echo $singleJobIndia->link;?>">
                  <td><?php echo $singleJobIndia->post_title;?> </td>
                  <td><?php echo $singleJobIndia->years_of_experience;?> years of experiance</td>
                  <td><i style="font-size:24px" class="fa">&#xf178;</i></a></td>

                </tr>
                 <?php
				  }
				  ?>

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
                  <td><?php echo $singleJobUS->years_of_experience;?> years of experiance</td>
                  <td><i style="font-size:24px" class="fa">&#xf178;</i></a></td>
                </tr>
           <?php } ?>
              </tbody>
            </table>
			  <?php
			  }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


        <!--career-list-end-->



<?php  wp_reset_query(); 
get_footer(); ?>
