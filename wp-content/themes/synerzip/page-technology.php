<?php
get_header();

$terms = getParentandChildTaxonomy('technology', 1);

foreach ($terms as $term) {
    //print_r($term);
    if ($term->parent == '') {
        $parentTaxonomy[$term->term_id] = $term;
    }
}
?>

<section class="f-fix technologies-main-wrapper page-content-wrapper grey-bg" id="technologies-main-wrapper">
    <div class="container">
        <div class="page-intro-block">
            <p>Constantly keeping pace with new IT powering businesses in your industry, Synerzip delivers engaging user experience - continuously. We combine experience and insight to constantly innovate to drive business performance. From modernizing legacy applications to building your MVP on modern platforms, we partner with you on your journey. 
            </p>
        </div>
    
    <div class="row push-down-6">
        <?php
        foreach ($parentTaxonomy as $parentKey => $parentValue) {
            $image = get_field('feature_images', $parentValue)['url'];
            $tech->url = get_term_link($parentValue);
            
            ?>
            <div class="col-sm-6 col-md-4 push-down-3">
                <div class="tech-list">
                    <a href="<?php echo $tech->url; ?>">
                        <img src="<?php echo $image; ?>"/>
                        <div class="tech-details">
                            <h3><a href="<?php echo $tech->url; ?>" id="tech"><?php echo $parentValue->name; ?></a></h3>
                            
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

 <div class="container-fluid no-padding">
    <div class="next-page-wrapper">

	 
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/practices">Practices</a></h4>
				<div class="arrow">	
					<a href="/practices"><img src="../wp-content/uploads/2017/11/skype.png">
				</div></a>
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
                    
                

    .tech-list {border-radius:5px; width: 348px;height: 315px;}
@media only screen and (max-width: 800px) {
.tech-list {height: 350px;}
}
}

     .tech-list:hover {box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);}
    .tech-list img{height:253px;width:100%;background-color:#D8D8D8;border:0;border-top-left-radius: 5px;border-top-right-radius: 5px;object-fit:cover;-webkit-filter: grayscale(100%); filter: grayscale(100%);}
    .tech-list img:hover { filter: none;
  -webkit-filter: grayscale(0%);}
    .tech-list .tech-details{padding:0 5px;background:#fff;border-radius: 5px;min-height: 65px;}
    .tech-list .tech-details h3{color:#4a4a4a;font-size: 22px;font-weight: 500;line-height: 26px;font-size: 18px;text-align: left; margin:10px 0}
    .tech-list .tech-details p{color: #4a4a4a;font-size: 12px;line-height: 16px;}
    #tech{color:#4a4a4a;padding-left:10px}
    .tech-list .tech-details a:hover{
color:blue;
}
</style>
<!--technologies section end-->

<?php
get_footer('');
?>


