<?php  
   $pageTitle='Federation';
   include 'header.php';
   include 'nav.php';
?>

<script type="text/javascript">

	$(document).ready(function() {
		$(".confed").hover(function() {
			$(".hidden").show();
		});
	});

</script>

<div class="wrapper">
	<div class="left"> 
		<h3>The Federation:</h3>
		<ul>
			<li class="confed">Site 1</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 2</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 3</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 4</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 5</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 6</li>
			<div class="hidden">Description</div>
			<li class="confed">Site 7</li>
			<div class="hidden">Description</div>
		</ul>
	</div>
	
</div>

<?php include 'footer.php'; ?>
