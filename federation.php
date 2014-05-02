<?php  
   $pageTitle='Federation';
   include 'header.php';
   include 'nav.php';
?>

<div class="wrapper">
	<div class="left"> 
		<h3>The Federation:</h3>
		<ul id="fedlist">
			<!-- 
			
			<li id="link0" class="confed">Site 1</li>
			<div id="desc0" class="hidden"><p>Description</p></div>
			<li id="link1" class="confed">Site 2</li>
			<div id="desc1" class="hidden"><p>Description</p></div>
			<li id="link2" class="confed">Site 3</li>
			<div id="desc2" class="hidden"><p>Description</p></div>
			
			-->
			
			<?php 
			$json = file_get_contents("http://www.cs.colostate.edu/~ct310/yr2014sp/more_assignments/project4rosterJSON.php?key=WQT3xKmVV7");
			$decoded = json_decode($json, true);
			
			foreach($decoded as $website) {
				$short = $website['shortname'];
				$short = preg_replace('/ /', '_', $short);
				$long = $website['longname'];
				$url = $website['url'];
				if (substr($url, 0, 3) == 'www') {
					$url = "http://" . $url;
				}
				
				$purposePage = $url;
				$root = strrpos($purposePage, '/');
				$purposePage = substr($purposePage, 0, $root+1);
				$purposePage .= "purpose.php";
				
				echo '<li id="link'.$short.'"><a href="'.$url.'">'.$long.'</a></li>';
				//TODO: after testing, remove the "Site description from..." text
				echo '<div id="desc'.$short.'" class="hidden"><p>Site description from '.$purposePage.':</p></div>';
				
				if ($_SESSION['username'] != 'guest') { ?>
				
					<script type="text/javascript">
						$(document).ready(function() {

							$('#link<?php echo $short; ?>').hover(function() {

									//jquery call to other website for purpose
									//set desc.text to the purpose
									website = '<?php echo $purposePage?>';
									//this should call getpurpose.php
									$.post('getpurpose.php', {website:website}, function(data){
											
											if (data != "fail") {
												json = $.parseJSON(data);
												if(json.purpose != null) {
													$('#desc<?php echo $short; ?>').children().text(json.purpose);
												}
												else if (json[0].purpose != null){
													$('#desc<?php echo $short; ?>').children().text(json[0].purpose);
												}
												else {
													//returned something that wasn't a json object/array of one object
													$('#desc<?php echo $short; ?>').children().text("Sorry, <?php echo $long;?> appears to be down :(");
												}
											}
											else {
												//site was unreachable
												$('#desc<?php echo $short; ?>').children().text("Sorry, <?php echo $long;?> appears to be down :(");
											}
											
										});
									
									$('#desc<?php echo $short; ?>').show();
								
								}, function() {

									$('#desc<?php echo $short; ?>').hide();
									
								});

						});
					</script>
				
				<?php 
				}
				
			}
			
			?>
			
		</ul>
	</div>
	
</div>

<?php include 'footer.php'; ?>
