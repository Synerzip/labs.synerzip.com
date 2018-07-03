<?php 
get_header('newheader'); 
global $post;
$condition=array();
$condition['post_type']='post';
$condition['posts_per_page']='-1';
$passhash='showAll';
$stories=fetch_rulequery($passhash,$condition);
//echo "<pre>";print_r($stories);
$Allstories=$stories->posts;
$countStory=count($Allstories);

$terms = get_terms(array(
    'taxonomy' => 'story_type',
    'hide_empty' => false,
        ));

?>

<!--success-stories section start-->   

<section class="f-fix success-stories-main-wrapper page-content-wrapper grey-bg" id="success-stories-main-wrapper">
    <div class="container">
           
              <div class="col-lg-4 col-lg-offset-4" >
                <input type="search" id="container-search" value="" class="form-control"  placeholder="Search..."
                style="margin-top: -200px; height: 50px;width: 130%;font-size: 20px;">
              </div>
           
              <div class="row push-down-6">
                  <div class="col-sm-12">
                      <ul class="success-stories-sort">

                          <?php
                          foreach ($terms as $term){
                              echo "<li><a href='#' data-group=$term->term_id class='storymenu'>$term->name</a></li>";
                          } ?>
                      </ul>
                  </div>
              </div>
           
            <div class="row push-down-1" id="storygrid">
                    <?php
                    for ($i = 0; $i < $countStory;$i++) {
                        $clientImage = get_the_post_thumbnail_src(get_the_post_thumbnail($Allstories[$i]->ID, 'medium'));
                        $clientLink = get_permalink($Allstories[$i]->ID); 
                         $storyType = get_the_terms($Allstories[$i]->ID, 'story_type');
                         //echo "<pre>";print_r($hashtags);
                         // pull youtubelink
                         // get its unique identifir using regular expression
                         //
                         if(isset($storyType) && $storyType[0]->name=='Testimonials')
                         {
                              
                             $videoUrl = get_post_meta($Allstories[$i]->ID, 'vedio', true);// pulling videourl from custom field.

                              if (strpos($videoUrl, 'v=') !== false) {
                                 $fetch=explode("v=", $videoUrl);
                                 $videoid=$fetch[1];
                                 $clientImage = "https://i.ytimg.com/vi/".$videoid."/hqdefault.jpg";
                                //$clientImage = "https://i.ytimg.com/vi/".$videoid."/maxresdefault.jpg";
                              } else {
                        
                                    $fetch=explode("/", $videoUrl);
                                      $videoid=$fetch[3];
                                    $clientImage = "https://i.ytimg.com/vi/".$videoid."/hqdefault.jpg";
                              }
                          }
                              $story_type_id=$storyType['0']->term_id;
                          ?>
                          <div class="item col-sm-6 col-md-4" data-groups='[444,<?php echo $story_type_id; ?>]'>
                            <div class="story-block">
                                  <div class="story-img" >
                                    <a  href="<?php echo $clientLink; ?>">
                                    <img src="<?php echo $clientImage; ?>"> </a>
                                  </div>  
                                <div class="story-text">
                                   <?php 
                                      if(get_field('client_name',$Allstories[$i])=='')
                                      { ?>
                                       <p><a  href="<?php echo $clientLink; ?>"><?php echo $Allstories[$i]->post_title; ?></a></p>
                                     <?php }

                                      else
                                       { ?>
                                        <div class="client-name">
                                            <p><a href="<?php echo $clientLink; ?>"><?php echo get_field('client_name',$Allstories[$i]);?>          
                                            </a></p>
                                        </div>
                                        <div class="client-title" >
                                          <div >
                                            <p><a  href="<?php echo $clientLink; ?>"><?php echo get_field('client_title',$Allstories[$i]);?>         
                                           </a></p></div>
                                        </div>
                                      <?php  }
                      ?>
                                </div>  
                        
                              <!-- Trigger the modal with a button -->
                              <div class="buttoncontainer"> 
                                 <i class="fa fa-chevron-right pl-1 button" type="button" data-toggle="modal" data-target="#myModal" ></i>
                               </div>
                              <!-- Modal -->
                              <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">

                                  <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Modal Header</h4>
                                       </div>
                                        <div class="modal-body">
                                           <p><?php echo $Allstories[$i]->post_content; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <!-- Close Modal -->
                            </div>
                        </div>
                    <?php } ?>
            </div>
    </div>
                  <div class="container-fluid no-padding">
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
</section> 

<style>
                 
  .next-img {
    align-content: center;
    display: flex;
    margin: 0 auto;
    width: 4%;
  }
  .buttoncontainer {
    position: absolute;
    left: 0;
    right: 0;
    margin-top: -8.44rem;
    margin-left: 79%;
    border-radius: 50%;
    width: 47px;
    height: 47px;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    overflow: hidden;
    background: linear-gradient(90deg,#FFFF66 50%,#FFFF66 50%);
    font-size: 17px;
  }

  .btn-floating i {
      display: inline-block;
      width: inherit;
      text-align: center;
      color: #fff;
  }
  .button {
      cursor: pointer;
      display: inline-block;
      width: inherit;
      text-align: center;
      color: black;
      padding-left: .25rem!important;
      margin-top: 16px;
  }
  .test{
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
  }
</style>

<script type="text/javascript">

  $(document).ready(function(){
      $('#container-search').keyup(function(){
        var val = $(this).val().toLowerCase();
        $(".story-block").hide();

           $('.story-block').each(function(){
               var text = $(this).text().toLowerCase();
                if(text.indexOf(val) != -1){
                  $(this).show();

                }
            });  
      });
  });


       
</script> 
       
       
 <?php
 get_footer();
 ?>
 )