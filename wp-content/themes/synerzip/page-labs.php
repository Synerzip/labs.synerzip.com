<?php 
get_header('labheader'); 
global $post;
$condition=array();
$condition['post_type']='post';
$condition['posts_per_page']='-1';
$passhash='showAll';
$stories=fetch_rulequery($passhash,$condition);
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
                        $st = get_post_field('post_content',$Allstories[$i]);
                        
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
                              $story_type_name=$storyType['0']->name;
                          ?>
                          <div class="item col-sm-6 col-md-4" data-groups='[444,<?php echo $story_type_id; ?>]'>
                            <div class="story-block" id="test">
                                  <div class="story-img" >
                                    <a  href="<?php echo $clientLink; ?>">
                                    <img src="<?php echo $clientImage; ?>"> </a>
                                  </div>
                                   
                                <div class="story-text">
                                      <?php echo $story_type_name; ?>

                                      <?php 
                                        if(get_field('client_name',$Allstories[$i])=='')
                                      { ?>
                                       <p>
                                        <a  href="<?php echo $clientLink; ?>"><?php echo $Allstories[$i]->post_title; ?></a></p>
                                      <?php }
                                      else
                                       { ?>
                                        <div class="client-name">
                                            <p><a href="<?php echo $clientLink; ?>"><?php echo get_field('client_name',$Allstories[$i]);?>          
                                            </a></p>
                                        </div>
                                        <div class="client-title" >
                                          <div >
                                            <p><?php echo "<li><a href='#' data-group=$term->term_id class='storymenu'>$term->name</a></li>" ?>
                                            </p>
                                            <p>
                                              <a  href="<?php echo $clientLink; ?>"><?php echo get_field('client_title',$Allstories[$i]);?>         
                                             </a>
                                           </p>
                                         </div>
                                        </div>
                                      <?php   }
                      ?>
                                </div>  
                               
                              <!-- Trigger the modal with a button -->
                              <div class="buttoncontainer"> 
                                <i class="fa fa-chevron-right pl-1 button" type="button" data-toggle="modal" 
                                   data-target="#mymodal<?php echo $Allstories[$i]->ID; ?>" postitle = "<?php echo $Allstories[$i]->post_title; ?>"> </i>
                              </div>
                              <div  class="pagecontent"  >
                                 <p ><?php echo $Allstories[$i]->post_content; ?></p>
                              </div> 
                             
                            </div>
                        </div>
                    <?php } ?>
            </div>
               <!-- Modal -->
                              <div  class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                     <!-- Modal content-->
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title"></h4>
                                       </div>
                                        <div class="modal-body">
                                           <p></p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <!-- Close Modal -->
           
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
  .pagecontent{
    display: none;
  }
   .pardotform{
     overflow: hidden!important;
     margin: 0!important;
     font-size: 18px !important;
     text-align: left!important;
     font-family: 'Open Sans', sans-serif !important;
   }
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $('#container-search').val("");
      $('#container-search').keyup(function(){
        var val = $(this).val().toLowerCase();
        $(".story-block").hide();
           $('.story-block').each(function(){
               var text = $(this).text().toLowerCase();
                if(text.indexOf(val) != -1){
                    $(this).show();

                     // Advanced filtering
                    var $storygrid = $('#storygrid');
                    $('#storygrid').shuffle({
                        group: 444,
                        speed: 1000,
                        easing: 'ease-out'
                    });
                    $("ul.success-stories-sort").find("[data-group=444]").parent('li').addClass('active');
                     

                    var groupName1 = $('.storymenu').attr('data-group');
                    // reshuffle grid
                    console.log(groupName1);
                    $storygrid.shuffle('shuffle', Number(groupName1));
                    $(".success-stories-sort li").first().css("text-decoration", "none");

              
                }
            });  
      });
  });
   

$(function() {
   $(".button").click(function(){
     var id = $(this).attr('data-target');
     var postcontent =$(this).parent().next().text();
     var postTitle = $(this).attr('postitle');
     var id = id.match(/[\d\.]+/g);
     var e = $('<div id='+id+' class="modal fade" role="dialog">');
         $('id').append(e);
         $(".modal .modal-title").html(postTitle);
         $(".modal .modal-body").text(postcontent);
         $(".modal").modal("show");
    });
    
});

</script> 
       
       
 <?php
 get_footer();
 ?>
 )

