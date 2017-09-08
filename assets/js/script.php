<?php 
	include("../../config.php");
	header("ContentType: application/javascript");
	$user = mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'");
	$user = mysql_fetch_assoc($user);
?>
$(document).ready(function(){

<?php if(isset($_SESSION["ACCESS_TOKEN"])){ ?>
    navigator.geolocation.getCurrentPosition(success, error);

    function success(position) {
        console.log(position.coords.latitude)
        console.log(position.coords.longitude)

        var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + position.coords.latitude + '%2C' + position.coords.longitude + '&language=en';

        $.getJSON(GEOCODING).done(function(location) {
            $("#location").text(location.results[0].formatted_address)
        });
    }
<?php } ?>

    function error(err) {
        console.log(err)
    }
	<?php if(isset($_SESSION["ACCESS_TOKEN"]) && $allow_splash){ ?>
	setTimeout(function() {
		$("#splash").slideUp();
	}, <?=$splash_delay; ?>*1000);
	<?php } else if(isset($_SESSION["ACCESS_TOKEN"]) && !$allow_splash){ ?>
		$("#splash").hide();
	<?php } ?>

	$("#login-fb").click(function(){
		$(this).attr("disabled");
		$(this).html('<img src="assets/img/loading-login.gif">');
		setTimeout(function(){
			window.location = "login.php";
		}, 2000);
	});
	current = 0;
	var timer;
	$(".nav-bottom .col-xs-4").click(function(){
		$(".nav-bottom").find(".col-xs-4").removeClass("active");
		$(this).addClass("active");
		nav = $(this).attr("nav");
		if(nav=="home" && current!=1){
			current = 1;
			$(".home").fadeIn().delay(5000).fadeOut();
			timer = setTimeout(function(){
				$(".tinder").fadeIn();
				get_users_nearby();
			}, 5000);
			$(".profile").hide();
			$(".contacts").hide();
			$(".messages").hide();
			$(".message-list").hide();
			$(".loading-overlay").hide();
			$("#chat-input").hide();
		}else if(nav=="messages" && current!=2){
			clearTimeout(timer);
			current = 2;
			$(".home").hide();
			$(".profile").hide();
			$(".tinder").hide();
			$(".messages").fadeIn();
			$(".message-list").hide();
			$(".loading-overlay").hide();
			//$("#chat-input").fadeIn().css("display", "inline-table");
			$("#chat-input").hide();
		}else if(nav=="contact" && current!=3){
			clearTimeout(timer);
			current = 3;
			$(".home").hide();
			$(".profile").hide();
			$(".tinder").hide();
			$(".messages").hide();
			$(".message-list").hide();
			$(".loading-overlay").hide();
			$("#chat-input").hide();
		}else if(nav=="profile" && current!=4){
			clearTimeout(timer);
			current = 4;
			$(".home").hide();
			$(".profile").fadeIn().css("display", "flex");
			$(".tinder").hide();
			$(".messages").hide();
			$(".message-list").hide();
			$(".loading-overlay").hide();
			$("#chat-input").hide();
		}
	});


	var size = 140;
	setInterval(function(){
	  $('.pulse').width(size).height(size);
	  size++;
	  if(size > 200){
	    $('.pulse').css('opacity', $('.pulse').css('opacity')-0.001);
	  }
	  if(size > 500){
	    size = 50;
		$('.pulse').width(size).height(size);
	    $('.pulse').css('opacity', '0.3');
	  }
	},0); 

	$('.photo').click(function(){
	  console.log('CLick'); 
	  $( ".pulse" ).clone().appendTo( "body" );
	});
	$("#edit-profile-form").submit(function(e){
		var this_form = $(this);
		var orig_value = this_form.find("button[type=submit]").html();
		this_form.find("button[type=submit]").attr("disabled", true);
		this_form.find("button[type=submit]").html('<img src="assets/img/loading-sm.gif">');
		$.ajax({
			type: this_form.attr("method"),
			url: this_form.attr("action"),
			data: this_form.serialize(),
			dataType: 'json',
			success: function(data){
				refresh_profile();
				this_form.find("button[type=submit]").attr("disabled", false);
				this_form.find("button[type=submit]").html(orig_value);
				$("#edit-profile").modal("hide");
			}
		});
		e.preventDefault();
	});
	function refresh_profile(){
		$(".loading-overlay").fadeIn();
		$(".job-list").empty();
		$.ajax({
			url: "actions/get-user-info.php",
			dataType: 'json',
			success: function(data){
				$(".profile p").text(data.about);
				$(".profile h3").text(data.name);
			}
		});
		$.ajax({
			url: "actions/get-user-jobs.php",
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, value){
					$(".job-list").append('<span class="label label-primary lb-sm">'+value+'</span>');
				});
				$(".loading-overlay").fadeOut();
			}
		});
	}
	refresh_profile(); 

	function get_users_nearby(){
		$(".tinder div").empty();
		$.ajax({
			url: "actions/get-users-nearby.php",
			dataType: 'json',
			success: function(data){
				var i = 0;
				$.each(data, function(index, value){
					$(".tinder > div").append('<div class="profile-tinder" profile="'+index+'" fbid="'+value.id+'"><div class="row"><img src="https://graph.facebook.com/'+value.id+'/picture?type=large" class="img-circle"></div><div class="row"><h3>'+value.name+'</h3><hr/><p>'+value.about+'</p></div><div class="row"><div class="pull-left action" id="approve"><i class="fa fa-check"></i></div><div class="pull-right action" id="reject"><i class="fa fa-close"></i></div></div></div>');
					i++;
				});
				$(".tinder > div").append('<div class="profile-tinder" profile="'+(i)+'"><div class="row"><img src="assets/img/all-today.jpg"></div></div>');
				$(".profile-tinder").not(':eq(0)').hide();
				$(".loading-overlay").fadeOut();
			}
		});
	}

	$(document).on("click", "#reject", function(){
		var id = parseInt($(this).closest(".profile-tinder").attr("profile"))+1;
		$(".profile-tinder[profile='"+id+"']").fadeIn();
		$(".profile-tinder").not(':eq('+id+')').hide();
	});
	$(document).on("click", "#approve", function(){
		$.get("actions/approve.php?id="+$(this).closest(".profile-tinder").attr("fbid"), function(data) {}, 'text');
		var id = parseInt($(this).closest(".profile-tinder").attr("profile"))+1;
		$(".profile-tinder[profile='"+id+"']").fadeIn();
		$(".profile-tinder").not(':eq('+id+')').hide();
	});

	function contacts(){
		$(".messages > ul").empty();
		$.ajax({
			url: "actions/contacts.php",
			dataType: 'json',
			success: function(data){
				var i = 0;
				var dt = new Date();
    			var h =  dt.getHours(), m = dt.getMinutes();
    			var _time = (h > 12) ? (h-12 + ':' + m +' PM') : (h + ':' + m +' AM');
				$.each(data, function(index, value){
					$(".messages > ul").append('<li><img src="https://graph.facebook.com/'+value.id+'/picture?type=small" class="img-circle pull-left"><div class="pull-left"><span class="name">'+value.name+'</span><span>'+_time+'</span></div></li>');
				});
			}
		});
	}
	contacts();
	//setInterval(contacts, 1000);
});