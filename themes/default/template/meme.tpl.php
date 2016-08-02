<?
$memesPerPage = 20;
$maxFileSize = 400;
$enableCustomUpload = true;
$securityChecksEnabled = true;
$watermark = watermark;
?>
<div style="margin-top: 58px;"></div>
<div style="margin-top: -30px;"></div>
<div style="width: 936px;overflow: hidden;">

<? if($_GET['action'] == '') { ?> <!-- Index Action -->
<div class="headbar-upload">
<script type='text/javascript' src='<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/mootools.js'></script>
<script type='text/javascript'>//<![CDATA[ 
window.addEvent('load', function() {
document.getElementById("meme-editor-file").onchange = function() {
    document.getElementById("uploadimg").submit();
}
});//]]>  

</script>
<form id="uploadimg" action="<?=$root?>/view/meme/action/create/image/display" method="post" enctype="multipart/form-data">
    <a class="upload-button btn-custom-meme" href="javascript:void(0);"><?=$LANG['upload_new_image_title'];?></a>
    <input type="file" name="upload-input" class="headbar-upload-input" id="meme-editor-file" value="<?=$LANG['upload_new_image_title'];?>">
</form>
</div>
<?
$count = 0;
	  if ($handle = opendir('uploads/meme_templates')) {
	  
	    while (false !== ($entry = readdir($handle))) {
        $pngl = pathinfo($entry);
		
		if($pngl['extension'] == 'png' || $pngl['extension'] == 'jpg' || $pngl['extension'] == 'gif')
		{		
			$imbasename = $pngl['basename'];
			$imext = $pngl['extension'];
			if(($count == 0))
			{
				print '<ul class="meme-grid" style="position:relative;transition: all 1s ease;"><div style="width: 936px;" id="container">';
			}
?>
<div class="box" style="border: 0; background: transparent; margin-right: 0px; margin-bottom: 0px;">
<li><a href="<?=$root?>/view/meme/action/create/<?php echo $entry; ?>">
<div class="image-container"><img src="<?=$root?>/uploads/meme_templates/<?php echo $entry; ?>"></div>
<div class="title-container"><h3><?php $k = explode(".",str_replace("_"," ",$entry)); echo $k[0];?></h3></div>
</a></li>
</div>
<?
		if(($count + 1) % 500 == 0)
			{
				print '</div></ul>';
			}
			
			$count++;
			
		}
		}
		
			closedir($handle);
		
		}
?>


<!-- contains the content to be loaded when scrolled -->
<nav id="page-nav">
<? if($_GET['page'] = '') { $page=$_GET['page']; } else { $page='1'; } ?>
  <a href="<?=$root;?>/?view=meme&action=index&page=<?=$page+1;?>"></a>
</nav>

<? } ?> <!-- Index Action -->

<? if($_GET['action'] == 'create') { ?> <!-- Create Action -->
<div class="container_meme">

		<h1><?=$LANG['create_meme_title'];?></h1>


		<div class="row">
        	<!-- Span 4 start -->
			<div class="span8">
				<div id="memestage"></div>
			</div>
			<!-- Span 4 start -->
			<div class="span4">
				<form>
                    <div class="field">
						<textarea id="tc1" placeholder="<?=$LANG['top_text_title'];?>"><?=$LANG['top_text_title'];?></textarea>
                    </div>
                    <div class="update_font_size">
					<button type="button" class="btns btn-success" id="cap1" style="float: left;"><?=$LANG['update_title'];?></button>
                    <div style='float: right;'><label><select id="fontsizesel1">
						<option value="24">24pt</option>
						<option value="32" selected>32pt</option>
						<option value="48">48pt</option>
						<option value="72">72pt</option>
						<option value="144">144pt</option>
					</select></label></div><br><div style="margin-top: 5px;"></div>
                    </div>
                    <br><br>
					<div class="field">
						<textarea id="tc2" placeholder="<?=$LANG['bottom_text_title'];?>"><?=$LANG['bottom_text_title'];?></textarea>
                    </div>
					<div class="update_font_size">
					<button type="button" class="btns btn-success" id="cap2" style="float: left;"><?=$LANG['update_title'];?></button>
                    <div style='float: right;'><label><select id="fontsizesel2">
						<option value="24">24pt</option>
						<option value="32" selected>32pt</option>
						<option value="48">48pt</option>
						<option value="72">72pt</option>
						<option value="144">144pt</option>
					</select></label></div><br><div style="margin-top: 5px;"></div>
                    </div>
					
				</form>
				<br><br>
				<form id="createimg" action="<?=$root?>/view/meme/show" method="post">
					<p>
						<button id="cands" class="btn btn-large btn-primary" type="button" style="z-index: 9999999;"><?=$LANG['create_and_share_title'];?></button>
						<input type="hidden" id="imgdata" name="imgdata">
					</p>
				</form>
			</div>
		</div>
	</div>
	<!-- /container -->

	<div id="heightStage" style="display: none;"></div>
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script>
	<?php
		if(isset($_FILES['upload-input']))
		{
			$maxfs = $maxFileSize * 3072;
	   $allowedExts = array("jpg", "jpeg", "gif", "png","JPG","PNG","JPEG","GIF");

	   if(isset($_FILES["upload-input"]["name"]))
	   {
		   $extension = end(explode(".", $_FILES["upload-input"]["name"]));

		   if ((($_FILES["upload-input"]["type"] == "image/gif")
		   || ($_FILES["upload-input"]["type"] == "image/jpeg")
		   || ($_FILES["upload-input"]["type"] == "image/png")
		   || ($_FILES["upload-input"]["type"] == "image/pjpeg"))
		   && ($_FILES["upload-input"]["size"] < $maxfs)
		   && in_array($extension, $allowedExts))
	 	   	    {
	  	   	   	   if ($_FILES["upload-input"]["error"] > 0)
			   	   	   {
			   	   	   	   echo "Invalid file.";
			   	   	   }
	 	   	    else
			   	   	   {
			$fn = substr(md5(time() * rand(1,1000)), 0, 7);
		  move_uploaded_file($_FILES["upload-input"]["tmp_name"], "uploads/meme_custom/$fn.$extension");

			$templateName = isset($_GET['p']) ? $_GET['p'] : 'null.jpg'; 

			if(file_exists($root."/uploads/meme_custom/$fn.$extension"))
				$imgname = $root."/uploads/meme_custom/$fn.$extension";
			else
				$imgname = $root.'/uploads/meme_custom/'.$fn.".".$extension.'';
				
			print "var gblImgName = \"$imgname\";";
		}
	  }
}
		}
		else
		{		
			$templateName = isset($_GET['t']) ? $_GET['t'] : 'null.jpg'; 

			if(file_exists($root."/uploads/meme_templates/$templatName"))
				$imgname = $root."/uploads/meme_templates/$templateName";
			else
				$imgname = $root.'/uploads/meme_templates/'.$templateName;
				
			//$imgname = 'templates/int.jpg';
			print "var gblImgName = \"$imgname\";";
		}
		
		print "var watermark =\"$watermark\";";
	
	?>
	</script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/kinetic-v4.0.5.min.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/meme.min.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/spectrum.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-transition.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-alert.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-modal.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-dropdown.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-scrollspy.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-tab.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-tooltip.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-popover.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-button.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-collapse.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-carousel.js"></script>
	<script src="<?=$root;?>/themes/<?=$SETTINGS['theme'];?>/js/bootstrap-typeahead.js"></script>
    
<? } ?> <!-- Index Action -->



<? if($_GET['action'] == 'show') { ?> <!-- Show Action -->

<?
if(isset($_GET['subaction']))
{
	$fn = $_GET['subaction'];
}
else
{
	$filteredData=substr($_POST['imgdata'], strpos($_POST['imgdata'], ",")+1);

	// Need to decode before saving since the data we received is already base64 encoded
	$decodedData=base64_decode($filteredData);
	$fn = substr(md5(time()), 0, 7);

	$img = imagecreatefromstring(file_get_contents($_POST['imgdata']));
	if ($img !== false)
	imagejpeg($img, "uploads/meme_photos/$fn.jpg");
	
}

	?>

<div class="container">

		<div class="row">
			<div class="span8" style="float: left;">

				<h1><?=$LANG['share_meme_title'];?></h1>
				<br> <img src="<?php echo $root."/uploads/meme_photos/".$fn; ?>.jpg" width="600px">
			</div>

			<div class="span4" style="float: left;">
				
		<div class="sharing">

            <div class="share-facebook btn-container">
                <a class="btn facebook size-50" onclick="javascript:fbshare('<?=$root;?>/view/meme/show/<?=$fn;?>')" style="width: 250px;height: 20px;"><?=$LANG['share_to_title'];?> Facebook</a>
            </div>
            <div class="share-twitter btn-container">
                <a class="btn twitter size-50" onclick="javascript:twittershare('<?=$root;?>/view/meme/show/<?=$fn;?>')" style="width: 250px;height: 20px;"><?=$LANG['share_to_title'];?> Twitter</a>
            </div>
            <div class="recaption btn-container">
                <a class="btn red size-50" href="<?=$root;?>/view/upload/meme/post_url/num/<?=$fn;?>" style="width: 250px;height: 20px;" target="_blank"><?=$LANG['upload_to_website_title'];?></a>
            </div>
            <script>
			$(function () {
            	$("#field-share-link").click(function() {
			     	$(this).select();
		    	});
			});
			</script>
            <div class="share-link btn-container" style="width: 292px;">
                <div class="url-container">
                    <input id="field-share-link" type="url" value="<?=$root;?>/view/meme/show/<?=$fn?>" readonly="readonly">
                </div>
            </div>
            
                        <div class="divider">
                <p><?=$LANG['or_title'];?></p>
            </div>
            <div class="share-mousemedia btn-container" style="overflow: inherit;">
                    <div class="share-mousemedia btn-container" style="overflow: inherit;">
                        <a href="<?php echo $root."/uploads/meme_photos/".$fn; ?>.jpg" id="btn-edit" class="btn mousemedia size-50" style="width: 250px;height: 20px;margin-top: -20px;" download="<?=$fn?>.jpg" title="<?=$fn?>.jpg"><?=$LANG['save_as_title'];?> ...</a>
                    </div>
            </div>
                    </div>
                    
                    

			</div>
		</div>

	</div>
	<!-- /container -->

	<div id="heightStage" style="display: none;"></div>










<? } ?> <!-- Index Action -->

</div>