<?php

get_header(); 
?>
<section id="contact-us-page-wrapper" class="f-fix contact-us-page-wrapper page-content-wrapper grey-bg synerzip-watermark">
        <div class="container">
            <div class="page-intro-block-2">
                <h2>How can we help you</h2>
                <p>We help businesses, organisations and individuals from around the world bring their projects to life. Ask us anything. We’d love to hear what brought you here!</p>
                <div class="contact-us-form-container push-down-5">
                    <form>
                        <div class="form-group"><label for="name">Name *</label><br>
                            <input id="name" class="form-control" type="name" placeholder="Enter Name"></div>
                        <div class="form-group"><label for="emailId">Email id * </label><br>
                            <input id="emailId" class="form-control" type="email" placeholder="Enter email"></div>
                        <div class="form-group"><label for="company">Company</label><br>
                            <input id="company" class="form-control" type="text" placeholder="Enter Company"></div>
                        <div class="form-group">
                            <p><label for="purpose">Purpose * </label></p>
                            <ul class="contact-purpose clearfix">
                                <li id='project' class="active">Have a project in mind</li>
                                <li id='Applyjob'>Apply for a job</li>
                                <li id='other'>Other</li>
                            </ul>
							 <div id="resume" class ='hide-resume'>
							  <p><label>Resume *</label></p>
							  <input name="file" id="InputFile" class="inputfile" type="file" 
							   onchange="$(this).parent().parent().find('#upload-file-info').html($(this).val().split(/[\\|/]/).pop());">
							  <label for="InputFile" class="custom-upload" style="margin-left: 0px;">Choose file</label><span class="no-file" id="upload-file-info" style="color: black;">No file chosen</span><p class="help-block">
							  <p class="help-block" style="margin-left:0%;font-size:13px;">Only the following file extensions are allowed: pdf, doc and docx</p>
							 </div>
                        </div>
                        <div class="form-group"><label for="coverLetter">Message </label><br>
                            <textarea id="coverLetter" class="form-control" rows="5" placeholder="Enter message"></textarea></div>
                        <div class="text-center push-down-3"><button class="form-btn" type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
            <div class="locate-us-wrapper push-down-10">
                <div class="section-head">
                    <h2><strong>Our Offices</strong></h2>
                    <p>Drop in our office. Let’s talk business or just have a coffee. We’d love to hear from you!</p>
                </div>
                <div class="row push-down-4">
                    <div class="col-sm-4">
                        <div class="location-card">
                            <div class="img-wrap"><img src="../wp-content/uploads/2017/11/Group-18.png"></div>
                            <div class="location-content push-down-4">
                                <h3>Texas</h3>
                                <p class="push-down-3">4100 Spring Valley Road<br>
                                    Suite 308<br>
                                    Dallas, TX 75244</p>
                                <p class="push-down-7">Tel: +1.469.374.0500<br>
                                    Fax: +1.469.322.0490</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="location-card">
                            <div class="img-wrap"><img src="../wp-content/uploads/2017/08/silicon-valley.png"></div>
                            <div class="location-content push-down-4">
                                <h3>Silicon Valley</h3>
                                <p class="push-down-3">1750 Meridian Avenue<br>
                                    Suite 4105<br>
                                    San Jose, CA 95150</p>
                                <p class="push-down-7">Tel: +1.510.519.9673<br>
                                    Fax: +1.510.519.9673</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="location-card">
                            <div class="img-wrap"><img src="../wp-content/uploads/2017/11/shaniwar-wada.png"></div>
                            <div class="location-content push-down-4">
                                <h3>India</h3>
                                <p class="push-down-3">3rd Floor, Revolution Mall,<br>
                                    Above Big Bazaar, Kothrud,<br>
                                    Pune, India 411 038</p>
                                <p class="push-down-7">Tel: +91.20.67283222<br>
                                    Fax: +91.20.67283222</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="container-fluid no-padding">


	<div class="next-page-wrapper">
		<div class="send-enquiry">
			<div class="enquiry-section">
				<h4><a href="/career">Careers</a></h4>
				<div class="arrow">	
					<a href="/career"><img src="../wp-content/uploads/2017/11/skype.png"></a>
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
					.hide-resume {
						display:none;
					}
					
</style>
<script>
/*------- For Contact form resume  --------*/
$('#Applyjob').on('click', function(){
  $('#resume').removeClass('hide-resume');
});

$('#project').on('click',function(){
  $('#resume').addClass('hide-resume');
});

$('#other').on('click',function(){
 $('#resume').addClass('hide-resume');
});

</script>
<?php get_footer(); ?>
