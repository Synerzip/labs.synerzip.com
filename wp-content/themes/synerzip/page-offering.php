<?php
get_header(); 
global $post;

 ?>


                <!--our-offerings section start-->   

                

<section class="f-fix our-offerings-main-wrapper page-content-wrapper grey-bg" id="best-practice-main-wrapper">

  <div class="container">
<?php echo $post->post_content;?>
    </div>

  </div>

 <div class="container-fluid no-padding">
    <div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/team">Our Team</a></h4>
				<div class="arrow">	
					<a href="/team"><img src="../wp-content/uploads/2017/11/skype.png">
				</div></a>

			</div>
	</div>
      <!--<p class="page-name"><a href="/team">Our Team</p>
     	 
      <img src="../wp-content/uploads/2017/11/skype.png" class="next-text next-img" style="align-content: center;"></a> -->
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


                <!--our-offerings section end-->

<?php
get_footer(); 
?>


</body>

</html>
