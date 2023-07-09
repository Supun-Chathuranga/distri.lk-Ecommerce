<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$footer_about = $row['footer_about'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$contact_address = $row['contact_address'];
	$footer_copyright = $row['footer_copyright'];
	$total_recent_post_footer = $row['total_recent_post_footer'];
    $total_popular_post_footer = $row['total_popular_post_footer'];
    $newsletter_on_off = $row['newsletter_on_off'];
    $before_body = $row['before_body'];
}
?>


<?php if($newsletter_on_off == 1): ?>
<section class="home-newsletter">
<!-- change this -->
	<div class="footerLeftSide" >
		<div class="firstSection">
		<a href="index.php"><img src="assets\uploads\Untitled-2.png"></a>
		<p class="descriptionText">Distri.lk is Sri lankan number one online wholesale supplier.You can buy All accessories with this.<br>
		Your one-stop-shop for all your electronic accessory needs. We provide ourselves on providing<br>
		top-quality products and excellent customer service.</p>
		<div class="socialIcons" >
			<a  class="socialIconLink"  href="contact.php"><i class="fa fa-facebook"></i></a>
			<a  class="socialIconLink"  href="contact.php"><i class="fa fa-twitter"></i></a>
			<a  class="socialIconLink"  href="contact.php"><i class="fa fa-youtube"></i></a>
			<a  class="socialIconLink"  href="contact.php"><i class="fa fa-instagram"></i></a>
		</div>
				

		</div>
		<div class="secondSection">
			<div class="quickLinksSection">
				<p style="color:white;  font-size:20px;">Quick Links</p>
				<h6><a class="quickLinkText"  href="index.php"><i class="fa fa-home"></i> &nbsp; Home</a></h6>
				<h6><a class="quickLinkText"  href="dashboard.php"><i class="fa fa-user"></i> &nbsp; Dashboard</a></h6>
				<h6><a class="quickLinkText"  href="contact.php"><i class="fa fa-phone"></i> &nbsp; Contact Us</a></h6>
				<h6><a class="quickLinkText"  href="faq.php"><i class="fa fa-comments"></i> &nbsp; FAQ</a></h6>
			</div>

			<div class="quickLinksSection">
				<p style="color:white;  font-size:20px;">Contact Me</p>
				<h6 class="quickLinkText" href="+940769841736"><i class="fa fa-phone"></i> &nbsp;+94-0717884724</h6>
				<h6><a class="quickLinkText" href="https://wa.me/message/WTUKKDVOWN2QP1"><i class="fa fa-whatsapp"></i> &nbsp;+94-0713393826</a></h6>
				<h6 class="quickLinkText" href="Distrisl220@gmail.com"><i class="fa fa-envelope-o"></i> &nbsp;Distrisl220@gmail.com</h6>
				<h6><a class="quickLinkText" href="https://goo.gl/maps/XGvTpH33nWFTHWy27"><i class="fa fa-map-marker"></i> &nbsp;Nanneriya</a></h6>
			</div>

		</div>
		



		


	</div>



	
</section>
<?php endif; ?>




<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12 copyright">
				<?php echo $footer_copyright; ?>
			</div>
		</div>
	</div>
</div>

<!-- change this -->

<a href="https://wa.me/message/WTUKKDVOWN2QP1" target="_blank" class="scrollup">
  <i class="fa fa-whatsapp" onclick="window.location.href='https://wa.me/message/WTUKKDVOWN2QP1/'" ></i>
</a>


<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
}
?>

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
	function confirmDelete()
	{
	    return confirm("Sure you want to delete this data?");
	}
	$(document).ready(function () {
		advFieldsStatus = $('#advFieldsStatus').val();

		$('#paypal_form').hide();
		$('#stripe_form').hide();
		$('#bank_form').hide();

        $('#advFieldsStatus').on('change',function() {
            advFieldsStatus = $('#advFieldsStatus').val();
            if ( advFieldsStatus == '' ) {
            	$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'PayPal' ) {
               	$('#paypal_form').show();
				$('#stripe_form').hide();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'Stripe' ) {
               	$('#paypal_form').hide();
				$('#stripe_form').show();
				$('#bank_form').hide();
            } else if ( advFieldsStatus == 'Bank Deposit' ) {
            	$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').show();
            }
        });
	});


	$(document).on('submit', '#stripe_form', function () {
        // createToken returns immediately - the supplied callback submits the form if there are no errors
        $('#submit-button').prop("disabled", true);
        $("#msg-container").hide();
        Stripe.card.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
            // name: $('.card-holder-name').val()
        }, stripeResponseHandler);
        return false;
    });
    Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#submit-button').prop("disabled", false);
            $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
            $("#msg-container").show();
        } else {
            var form$ = $("#stripe_form");
            var token = response['id'];
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }
</script>
</body>
</html>