<?php
ob_start();
session_start();

$root = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($root, -1)=="/")
$root = 'http://' . $_SERVER['SERVER_NAME'];
$document = '' . $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']);
if(substr($document, -1)=="/")
$document = '' . $_SERVER['DOCUMENT_ROOT'];

include_once ('../includes/config.php');
include_once ('../includes/db_connect.php');
include_once ('functions.php');
include_once ('random_functions.php');


// sepertate this code into procedural and call the function to check the validation
if($_POST['check_user_info']){

	$ret = check_profile_validation_buyer($members['id']);
	echo json_encode($ret);

	exit();
}

// Session Member Info
$members = get_members($id);
$settings = get_settings();

$product_title = $_REQUEST["product_title"];
$product_price = $_REQUEST["product_price"];
$product_currency = $_REQUEST["product_currency"];

if($members['username'] != '') {
	//call function and check validation
	$ret = check_profile_validation($members['id']);
	if($ret['code'] != 0){
		$ret['ERROR_SESSION'] = 2;
		echo json_encode($ret);
		exit();
	}
	if($_REQUEST['tab_selector'] == 'nisgeo_post_tab_1') {
	  $rand = $rand;
	  $url_REQUEST = mysql_real_escape_string($_REQUEST['img_url']);
	  $title = mysql_real_escape_string($_REQUEST['description']);
	  $url = $_REQUEST['img_url'];
	  $category = $_REQUEST['nisgeo_post_category'];
	  $source = $_REQUEST['img_source'];
	  $description = mysql_real_escape_string($_REQUEST['description']);

        $path = "../uploads/media_photos/";
		$valid_formats = array("jpg", "jpeg", "png", "gif");
		$name = $_FILES['photoimg']['name'];
		$tmp_name = $_FILES['photoimg']['tmp_name'];
		$size = $_FILES['photoimg']['size'];
		$media_type = 'pic';
	  	if($title && $category){

					if($settings['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($settings['upload_type'] == 'auto') {
						$status = 'on';
					}

			for($i=0; $i < 11; $i++){
				$seed_second = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
				shuffle($seed_second);
				$rand_second = '';
				foreach (array_rand($seed_second, 30) as $ks) { $rand_second .= $seed_second[$ks]; }
				$ext = pathinfo($_FILES["photoimg"]["name"][$i], PATHINFO_EXTENSION);
				$tmp = $_FILES['photoimg']['tmp_name'][$i];
				$actual_image_name = $rand_second.".".$ext;
				$fileData = pathinfo(basename($_FILES["photoimg"]["name"][$i]));
				$file_name = $i.$_FILES['photoimg']['name'][$i];
				$file_size = $_FILES['photoimg']['size'][$i];
				$file_tmp = $_FILES['photoimg']['tmp_name'][$i];
				$file_type= $_FILES['photoimg']['type'][$i];
				$allowed =  array('gif','png' ,'jpg' ,'jpeg');
				$filename = $_FILES["photoimg"]["name"][$i];
				$ext2 = pathinfo($filename, PATHINFO_EXTENSION);
				if(in_array($ext2,$allowed)) {
					if(move_uploaded_file($_FILES["photoimg"]["tmp_name"][$i], $path.$rand_second.".".$ext)){
							mysql_query("INSERT INTO mouse_multiple (`post_id`,`file_name`,`file_size`,`file_type`) VALUES('".$rand."','$actual_image_name','$file_size','$file_type')");
					}
				}
			}

			$mouse_multiple_sql = mysql_query("SELECT * FROM mouse_multiple WHERE post_id = '".$rand."' LIMIT 1");
			$mouse_multiple = mysql_fetch_array($mouse_multiple_sql);

			$url_name = $mouse_multiple['file_name'];

			create_thumb("../uploads/media_photos/".$mouse_multiple['file_name'], "../uploads/media_photos/"."thumb_".$mouse_multiple['file_name'], 630);

			$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status, product_title, product_price, product_currency)
		                       VALUES ('".$rand."','".$title."','".$media_type."','".$name_media_gif."','".$url_name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."','".$product_title."','".$product_price."','".$product_currency."')");

		    $data = array(
			  				'SUCCESS_SESSION' => "1"
			  			 );

			echo json_encode($data, JSON_PRETTY_PRINT);
		}
	}
	elseif($_REQUEST['tab_selector'] == 'nisgeo_post_tab_2') {
		$url = filter(mysql_real_escape_string($_POST['url']));
      	$title = filter(mysql_real_escape_string($_POST['description']));
	  	$url = filter($_POST['url']);
	  	$category = filter($_POST['nisgeo_post_category']);
	  	$source = filter($_POST['source']);
	  	$description = filter(mysql_real_escape_string($_POST['description']));

	  	$name = basename($url);
	  	list($txt, $ext) = explode(".", $name);
	  	$name = $txt.time();
	  	$name_gif = $txt.time();
	  	$name = $name.".".$ext;
	  	if($ext == "jpg" or $ext == "jpeg" or $ext == "png"){
			$media_type = "pic";
	  	} elseif($ext == "gif") {
	    	$media_type = "gif";
			$name_media_gif = $name.".jpg";
		}
				$upload = uploadImageFromURL($url, $name_gif);
		if($upload) {
	  			if($title && $media_type && $name && $category){
					if($settings['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($settings['upload_type'] == 'auto') {
						$status = 'on';
					}
					mysql_query("INSERT INTO mouse_multiple (`post_id`,`file_name`,`file_size`,`file_type`) VALUES('".$rand."','$name','','')");

					if($media_type == 'gif') {
						create_thumb("../uploads/media_photos/".$name_media_gif, "../uploads/media_photos/"."thumb_".$name_media_gif, 630);
					} elseif($media_type == 'pic') {
						create_thumb("../uploads/media_photos/".$name, "../uploads/media_photos/"."thumb_".$name, 630);
					}

					$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status, product_title, product_price, product_currency)
                       VALUES ('".$rand."','".$title."','".$media_type."','".$name_media_gif."','".$name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."','".$product_title."','".$product_price."','".$product_currency."')");
        		    //print success message.
        		    $data = array(
			  				'SUCCESS_SESSION' => "1"
			  		);
					echo json_encode($data, JSON_PRETTY_PRINT);
				}
		} else {
			$data = array(
	  					'ERROR_URL' => "1"
	  			 	);
			echo json_encode($data, JSON_PRETTY_PRINT);
		}
	}
	elseif($_REQUEST['tab_selector'] == 'nisgeo_post_tab_3') {
		$media = http_decode(trim($_POST['video_url']));
	  	$type = getdomain($media);
      	$title = mysql_real_escape_string($_POST['description']);
	  	$category = $_POST['nisgeo_post_category'];
	  	$source = $_POST['video_source'];
	 	$description = mysql_real_escape_string($_POST['description']);
	  	if($source == ""){ $source = getdomain($media); }
	  	if($type=="youtube.com") {
		    $media_type = "vid";
			$url=get_youtube_photo($media);
	  	}
	  	else if($type=="vimeo.com") {
		    $media_type = "vid";
			$url=get_vimeo_photo($media);
	  	}
	  	else if($type=="vine.co") {
		    $media_type = "vid";
			$url=get_vine_photo($media);
	  	}

	  	$name = basename($url);
	  	list($txt, $ext) = explode(".", $name);
	  	$name = $txt.time();
	  	$name = $name.".".$ext;

	  	$upload = file_put_contents("../uploads/media_photos/$name",file_get_contents($url));


		if($upload) {
	  			if($title && $media_type && $name && $category){
					if($settings['upload_type'] == 'pend') {
						$status = 'off';
					} elseif($settings['upload_type'] == 'auto') {
						$status = 'on';
					}

					create_thumb("../core/uploads/media_photos/".$name, "../core/uploads/media_photos/"."thumb_".$name, 300);

					$result = mysql_query("INSERT INTO news (news_id, title, type, thumb, file, source, cat, author, description, date, status, product_title, product_price, product_currency)
                       VALUES ('".$rand."','".$title."','vid','".$media."','".$name."','".$source."','".$category."','".$members['id']."','".$description."','".date("Y-m-d")."','".$status."','".$product_title."','".$product_price."','".$product_currency."')");
        			//print success message.
					$data = array(
			  				'SUCCESS_SESSION' => "1"
			  		);
					echo json_encode($data, JSON_PRETTY_PRINT);
				} else {
					echo $LANG['sources_Please_Fill_Out_All_Required_Fields'].".";
				}
		} else {
			$data = array(
	  					'ERROR_URL' => "1"
	  			 	);
			echo json_encode($data, JSON_PRETTY_PRINT);
		}
	}

} else {
	$data = array(
	  				'ERROR_SESSION' => "1"
	  			 );

	echo json_encode($data, JSON_PRETTY_PRINT);
}

?>
