/*
	Plugin name: Post Plugin for Mouse Media Script
	Plugin description: You can simply post texts, images, videos
	Plugin author: NISGEO
	Plugin url: http://www.nisgeo.com/
*/
function post_tab_first() {
	document.getElementsByName("tab_selector")[0].value = "nisgeo_post_tab_1";
	var el = document.getElementById('nisgeo_post_tab_1');
	if(el) {
		el.className += el.className ? ' active' : 'active';
	}
	$("#nisgeo_post_tab_2").removeClass('active');
	$("#nisgeo_post_tab_3").removeClass('active');
	$('#additional_footer').html(
		"<div class='upload-button'>"
		+
			"<a rel='ignore' role='button'>"
		+
				"<button value='1' type='submit'>Add Pictures</button>"
		+
				"<input id='nisgeo_post_image' class='hidden-file' type='file' multiple='multiple' accept='image/*'' name='photoimg[]'><div id='count_files'><span class='count_files'></span> <span class='count_text'>image</span></div>"
		+
			"</a>"
		+
		'</div>'
	);
}
function post_tab_second() {
	document.getElementsByName("tab_selector")[0].value = "nisgeo_post_tab_2";
	var el = document.getElementById('nisgeo_post_tab_2');
	if(el) {
		el.className += el.className ? ' active' : 'active';
	}
	$("#nisgeo_post_tab_1").removeClass('active');
	$("#nisgeo_post_tab_3").removeClass('active');
	$('#additional_footer').html(
		'<input id="nisgeo_post_image_url" type="url" name="url" placeholder="'+LANG_IMAGE_URL+'" value="" style="position: relative; left: 18px; top: 2px; width: 240px; padding: 0px 0px 0px 10px; height: 23px; border: 1px solid #ddd;">'
	);
}
function post_tab_third() {
	document.getElementsByName("tab_selector")[0].value = "nisgeo_post_tab_3";
	var el = document.getElementById('nisgeo_post_tab_3');
	if(el) {
		el.className += el.className ? ' active' : 'active';
	}
	$("#nisgeo_post_tab_1").removeClass('active');
	$("#nisgeo_post_tab_2").removeClass('active');
	$('#additional_footer').html(
		'<input id="nisgeo_post_video_url" type="url" name="video_url" placeholder="'+LANG_VIDEO_URL+'" value="" style="position: relative; left: 18px; top: 2px; width: 240px; padding: 0px 0px 0px 10px; height: 23px; border: 1px solid #ddd;">'
	);
}
function NISGEO_POST_BUTTON() {
	// Turn on Loader and Loading icon
	$(".inner-loader").css("display", "block");
	// SELECT elements
	var tab_selector = document.querySelector('#nisgeo-post .inner-block .inner-list li a.active').id;
	var title = document.getElementById('nisgeo_post_textarea').value;
	var nisgeo_post_category = document.getElementById("nisgeo_post_category");
	var category = nisgeo_post_category.options[nisgeo_post_category.selectedIndex].value;

	var product_title = document.getElementById('nisgeo_post_title').value;
	var product_price = document.getElementById('nisgeo_post_price').value;
	var product_currency = document.getElementById('nisgeo_post_currency').value;

	// SELECT Images, Image url, Video url information
	if (document.getElementById('nisgeo_post_image') != null) {
	    var images = document.getElementById("nisgeo_post_image").value;
	} else {
	    var images = null;
	}
	if (document.getElementById('nisgeo_post_image_url') != null) {
	    var image_url = document.getElementById("nisgeo_post_image_url").value;
	} else {
	    var image_url = null;
	}
	if (document.getElementById('nisgeo_post_video_url') != null) {
	    var video_url = document.getElementById("nisgeo_post_video_url").value;
	} else {
	    var video_url = null;
	}

	// validate product title price and currency

	if(product_title == '') {
		alert("Please enter product title");
		$(".inner-loader").css("display", "none");
		return false;
	} else {
		if(product_price == '') {
			alert("Please enter product price");
			$(".inner-loader").css("display", "none");
			return false;
		}

	}
	
	// SELECT Tab Selectors

	// Post Tab 1
	if(tab_selector == 'nisgeo_post_tab_1') {
		if(images == '') {
			alert(LANG_PLEASE_UPLOAD_PHOTOS);
			$(".inner-loader").css("display", "none");
		} else {
			if(isNaN(category)) {
				alert(category);
				$(".inner-loader").css("display", "none");
			} else {
				if(title == '') {
					alert(LANG_PLEASE_WRITE_SOMETHING);
					$(".inner-loader").css("display", "none");
				} else {
					var formData = new FormData($("#nisgeo_post_form")[0]);

				    $.ajax({
				        url: "/sources/nisgeo-post.php",
				        type: 'POST',
				        data: formData,
				        async: false,
				        success: function (data) {
				            obj = JSON.parse(data);
							// add condition for error_session 2 and display obj.alert
							if(obj.ERROR_SESSION == '2' ){
								alert(obj.alert);
								$(".inner-loader").css("display", "none");
							}

							if(obj.ERROR_SESSION == '1') {
								alert(LANG_PLEASE_LOGGED_IN);
								$(".inner-loader").css("display", "none");
							}
							if(obj.SUCCESS_SESSION == '1') {
								alert(LANG_POST_UPLOADED);
								window.location.reload();
								$(".inner-loader").css("display", "none");
							}
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });
				}
			}
		}
	}

	// Post Tab 2
	if(tab_selector == 'nisgeo_post_tab_2') {
		if(image_url == '') {
			alert(LANG_PLEASE_WRITE_IMAGE_URL);
			$(".inner-loader").css("display", "none");
		} else {
			if(isNaN(category)) {
				alert(category);
				$(".inner-loader").css("display", "none");
			} else {
				if(title == '') {
					alert(LANG_PLEASE_WRITE_SOMETHING);
					$(".inner-loader").css("display", "none");
				} else {
					var formData = new FormData($("#nisgeo_post_form")[0]);

				    $.ajax({
				        url: "/sources/nisgeo-post.php",
				        type: 'POST',
				        data: formData,
				        async: false,
				        success: function (data) {
				            obj = JSON.parse(data);
							if(obj.ERROR_SESSION == '1') {
								alert(LANG_PLEASE_LOGGED_IN);
								$(".inner-loader").css("display", "none");
							}
							if(obj.ERROR_URL == '1') {
								alert(LANG_PLEASE_WRITE_RIGHT_URL);
								$(".inner-loader").css("display", "none");
							}
							if(obj.SUCCESS_SESSION == '1') {
								alert(LANG_POST_UPLOADED);
								window.location.reload();
								$(".inner-loader").css("display", "none");
							}
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });
				}
			}
		}
	}

	// Post Tab 3
	if(tab_selector == 'nisgeo_post_tab_3') {
		if(video_url == '') {
			alert(LANG_PLEASE_WRITE_VIDEO_URL);
			$(".inner-loader").css("display", "none");
		} else {
			if(isNaN(category)) {
				alert(category);
				$(".inner-loader").css("display", "none");
			} else {
				if(title == '') {
					alert(LANG_PLEASE_WRITE_SOMETHING);
					$(".inner-loader").css("display", "none");
				} else {
					var formData = new FormData($("#nisgeo_post_form")[0]);

				    $.ajax({
				        url: "/sources/nisgeo-post.php",
				        type: 'POST',
				        data: formData,
				        async: false,
				        success: function (data) {
				            obj = JSON.parse(data);
							if(obj.ERROR_SESSION == '1') {
								alert(LANG_PLEASE_LOGGED_IN);
								$(".inner-loader").css("display", "none");
							}
							if(obj.ERROR_URL == '1') {
								alert(LANG_PLEASE_WRITE_RIGHT_URL);
								$(".inner-loader").css("display", "none");
							}
							if(obj.SUCCESS_SESSION == '1') {
								alert(LANG_POST_UPLOADED);
								window.location.reload();
								$(".inner-loader").css("display", "none");
							}
				        },
				        cache: false,
				        contentType: false,
				        processData: false
				    });
				}
			}
		}
	}
}

function run_js_controller() {
	var inp = document.getElementById('nisgeo_post_image');
	for (var i = 0; i < inp.files.length; ++i) {
	  var name = inp.files.item(i).name;
	  $("#count_files").css("display", "block");
	  $(".count_files").html(inp.files.length);
	}
}

setInterval(function(){ run_js_controller(); }, 3000);
