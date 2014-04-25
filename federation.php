<?php  
   $pageTitle='Federation';
   include 'header.php';
   include 'nav.php';
?>

<?php if ($_SESSION['username'] != 'guest') {?>
<script type="text/javascript">

<?php 
for ($i = 0; $i < 3; $i++) {
?>

	$(document).ready(function() {

		$(".confed#link<?php echo $i; ?>").hover(function() {

			//include AJAX call here to fill the description
			
			$(".hidden#desc<?php echo $i; ?>").show();
		},
		function() {
			$(".hidden#desc<?php echo $i; ?>").hide();
		});
	});

<?php } ?>

</script>
<?php } ?>

<div class="wrapper">
	<div class="left"> 
		<h3>The Federation:</h3>
		<ul>
			<li id="link0" class="confed">Site 1</li>
			<div id="desc0" class="hidden"><p>Description</p></div>
			<li id="link1" class="confed">Site 2</li>
			<div id="desc1" class="hidden"><p>Description</p></div>
			<li id="link2" class="confed">Site 3</li>
			<div id="desc2" class="hidden"><p>Description</p></div>
		</ul>
	</div>
	
</div>

<?php include 'footer.php'; ?>
