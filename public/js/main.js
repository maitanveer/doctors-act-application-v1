/* =====================================
Template Name: 	Mediplus.
Author Name: Naimur Rahman
Website: http://wpthemesgrid.com/
Description: Mediplus - Doctor HTML Template.
Version:	1.1
========================================*/
/*=======================================
[Start Activation Code]
=========================================
* Sticky Header JS
* Search JS
* Mobile Menu JS
* Hero Slider JS
* Testimonial Slider JS
* Portfolio Slider JS
* Clients Slider JS
* Single Portfolio Slider JS
* Accordion JS
* Nice Select JS
* Date Picker JS
* Counter Up JS
* Checkbox JS
* Right Bar JS
* Video Popup JS
* Wow JS
* Scroll Up JS
* Animate Scroll JS
* Stellar JS
* Google Maps JS
* Preloader JS
=========================================
[End Activation Code]
=========================================*/
(function($) {
    "use strict";
     $(document).on('ready', function() {

        jQuery(window).on('scroll', function() {
			if ($(this).scrollTop() > 200) {
				$('#header .header-inner').addClass("sticky");
			} else {
				$('#header .header-inner').removeClass("sticky");
			}
		});

		/*====================================
			Sticky Header JS
		======================================*/
		jQuery(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('.header').addClass("sticky");
			} else {
				$('.header').removeClass("sticky");
			}
		});

		/*====================================
			Search JS
		======================================*/
		$('.search a').on( "click", function(){
			$('.search-top').toggleClass('active');
		});

		/*====================================
			Mobile Menu
		======================================*/
		$('.menu').slicknav({
			prependTo:".mobile-nav",
      duration: 1000,
	    easingOpen: "easeOutBounce", //available with jQuery UI
			closeOnClick:true,
		});

		/*===============================
			Hero Slider JS
		=================================*/
		$(".hero-slider").owlCarousel({
			loop:true,
			autoplay:true,
			smartSpeed: 1000,
			autoplayTimeout:5000,
			singleItem: true,
			autoplayHoverPause:true,
			items:1,
			nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			dots:false,
		});

		/*===============================
			Testimonial Slider JS
		=================================*/
		$('.testimonial-slider').owlCarousel({
			items:3,
			autoplay:true,
			autoplayTimeout:1500,
			smartSpeed:300,
			autoplayHoverPause:true,
			loop:true,
			merge:true,
			nav:false,
			dots:true,
			responsive:{
				1: {
					items:1,
				},
				300: {
					items:1,
				},
				480: {
					items:1,
				},
				768: {
					items:2,
				},
				1170: {
					items:3,
				},
			}
		});

    /*===============================
			Testimonial Slider JS
		=================================*/
		$('.doctors-slider').owlCarousel({
			items:3,
			autoplay:true,
			autoplayTimeout:1500,
			smartSpeed:300,
			autoplayHoverPause:true,
			loop:true,
			merge:true,
			nav:false,
			dots:true,
			responsive:{
				1: {
					items:1,
				},
				300: {
					items:1,
				},
				480: {
					items:1,
				},
				768: {
					items:2,
				},
				1170: {
					items:3,
				},
			}
		});

		/*===============================
			Portfolio Slider JS
		=================================*/
		$('.portfolio-slider').owlCarousel({
			autoplay:true,
			autoplayTimeout:1500,
			margin:15,
			smartSpeed:300,
			autoplayHoverPause:true,
			loop:true,
			nav:true,
			dots:false,
			responsive:{
				300: {
					items:1,
				},
				480: {
					items:2,
				},
				768: {
					items:2,
				},
				1170: {
					items:4,
				},
			}
		});

		/*=====================================
			Counter Up JS
		======================================*/
		$('.counter').counterUp({
			delay:20,
			time:2000
		});

		/*===============================
			Clients Slider JS
		=================================*/
		$('.clients-slider').owlCarousel({
			items:5,
			autoplay:true,
			autoplayTimeout:3500,
			margin:15,
			smartSpeed: 400,
			autoplayHoverPause:true,
			loop:true,
			nav:false,
			dots:false,
			responsive:{
				300: {
					items:1,
				},
				480: {
					items:2,
				},
				768: {
					items:3,
				},
				1170: {
					items:5,
				},
			}
		});

		/*====================================
			Single Portfolio Slider JS
		======================================*/
		$('.pf-details-slider').owlCarousel({
			items:1,
			autoplay:false,
			autoplayTimeout:5000,
			smartSpeed: 400,
			autoplayHoverPause:true,
			loop:true,
			merge:true,
			nav:true,
			dots:false,
			navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
		});

		/*===================
			Accordion JS
		=====================*/
		$('.accordion > li:eq(0) a').addClass('active').next().slideDown();
		$('.accordion a').on('click', function(j) {
			var dropDown = $(this).closest('li').find('p');
			$(this).closest('.accordion').find('p').not(dropDown).slideUp(300);
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
			} else {
				$(this).closest('.accordion').find('a.active').removeClass('active');
				$(this).addClass('active');
			}
			dropDown.stop(false, true).slideToggle(300);
			j.preventDefault();
		});

		/*====================================
			Nice Select JS
		======================================*/
		$('select').niceSelect();

		/*=====================================
			Date Picker JS
		======================================*/
		$( function() {
			$( "#datepicker" ).datepicker();
		} );



		/*===============================
			Checkbox JS
		=================================*/
		$('input[type="checkbox"]').change(function(){
			if($(this).is(':checked')){
				$(this).parent("label").addClass("checked");
			} else {
				$(this).parent("label").removeClass("checked");
			}
		});

		/*===============================
			Right Bar JS
		=================================*/
		$('.right-bar .bar').on( "click", function(){
			$('.sidebar-menu').addClass('active');
		});
		$('.sidebar-menu .cross').on( "click", function(){
			$('.sidebar-menu').removeClass('active');
		});

		/*=====================
			Video Popup JS
		=======================*/
		$('.video-popup').magnificPopup({
			type: 'video',
		});

		/*================
			Wow JS
		==================*/
		var window_width = $(window).width();
			if(window_width > 767){
            new WOW().init();
		}

		/*===================
			Scroll Up JS
		=====================*/
		$.scrollUp({
			scrollText: '<span><i class="fa fa-angle-up"></i></span>',
			easingType: 'easeInOutExpo',
			scrollSpeed: 900,
			animation: 'fade'
		});

		/*=======================
			Animate Scroll JS
		=========================*/
		$('.scroll').on("click", function (e) {
			var anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 100
				}, 1000);
			e.preventDefault();
		});

		/*=======================
			Stellar JS
		=========================*/
		$.stellar({
		  horizontalOffset: 0,
		  verticalOffset: 0
		});

		/*====================
			Google Maps JS
		======================*/
		/*var map = new GMaps({
				el: '#map',
				lat: 23.011245,
				lng: 90.884780,
				scrollwheel: false,
			});
			map.addMarker({
				lat: 23.011245,
				lng: 90.884780,
				title: 'Marker with InfoWindow',
				infoWindow: {
				content: '<p>welcome to Medipro</p>'
			}

		});*/
	});

	/*====================
		Preloader JS`
	======================*/
	$(window).on('load', function() {
		$('.preloader').addClass('preloader-deactivate');
	});
  $(document).ready(function() {
    $('#mentalhealth-popup').modal('show')

    //toastr.options = {"showDuration": "2000","positionClass": "toast-top-full-width"}
    //toastr["success"]("<img src='/assets/img/promotions/Mental-Health-Promo.jpg'/>")
         //$('.toast').toast('show');
         //noticeofprivacy-button
         //noticeofprivacy-english
         $('#noticeofprivacy-button').click(function(){
           if($(this).attr("data-lang") === 'Spanish')
           {
              $('#noticeofprivacy-english').hide();
              $('#noticeofprivacy-spanish').show();
              $(this).attr("data-lang",'English');
              $('#noticeofprivacy-button').text('English');
           }
           else
           {
             $('#noticeofprivacy-english').show();
             $('#noticeofprivacy-spanish').hide();
             $(this).attr("data-lang",'Spanish');
             $('#noticeofprivacy-button').text('Spanish');
           }
          });
      });

    $('.portfolio-menu ul li').click(function(){
      	$('.portfolio-menu ul li').removeClass('active');
      	$(this).addClass('active');

      	var selector = $(this).attr('data-filter');
      	$('.portfolio-item').isotope({
      		filter:selector
      	});
      	return  false;
      });
    $(document).ready(function() {
      var popup_btn = $('.popup-btn');
      popup_btn.magnificPopup({
      type : 'image',
      gallery : {
      	enabled : true
      }
      });
    });

    $('.single-testimonial').mouseenter(function(){
              $(this).find('.testimonial-more').css("visibility","visible"); // Show the testimonial-more paragraph on mouse enter
          }).mouseleave(function(){
              $(this).find('.testimonial-more').css("visibility","hidden"); // Hide the testimonial-more paragraph on mouse leave
          });



    //contact us form

    $(document).ready(function () {
      //for contact form
      $('#phone').on('input', function () {
              var number = $(this).val().replace(/\D/g, '');
              if (number.length === 10) {
                  var formattedNumber = '(' + number.substring(0, 3) + ') ' + number.substring(3, 6) + '-' + number.substring(6, 10);
                  $(this).val(formattedNumber);
              }
          });
          //for feedback form
          $('#mobile_number').on('input', function () {
                  var number = $(this).val().replace(/\D/g, '');
                  if (number.length === 10) {
                      var formattedNumber = '(' + number.substring(0, 3) + ') ' + number.substring(3, 6) + '-' + number.substring(6, 10);
                      $(this).val(formattedNumber);
                  }
              });

              //for appointment form
              $('#phoneAp').on('input', function () {
                      var number = $(this).val().replace(/\D/g, '');
                      if (number.length === 10) {
                          var formattedNumber = '(' + number.substring(0, 3) + ') ' + number.substring(3, 6) + '-' + number.substring(6, 10);
                          $(this).val(formattedNumber);
                      }
                  });

                  $('#phoneAp1').on('input', function () {
                          var number = $(this).val().replace(/\D/g, '');
                          if (number.length === 10) {
                              var formattedNumber = '(' + number.substring(0, 3) + ') ' + number.substring(3, 6) + '-' + number.substring(6, 10);
                              $(this).val(formattedNumber);
                          }
                      });

        $('#contactForm').submit(function (e) {
          $('.loading-modal').modal('show');
            e.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let message = $('#message').val();

            $(".error").html("");

            if (name == "") {
                $("#nameError").html("Name is required");
            }
            if (email == "") {
                $("#emailError").html("Email is required");
            } else if (!isValidEmail(email)) {
                $("#emailError").html("Invalid email address");
            }
            if (phone == "") {
                $("#phoneError").html("Phone number is required");
            } else if (!isValidPhoneNumber(phone)) {
                $("#phoneError").html("Invalid phone number");
            }
            if (message == "") {
                $("#messageError").html("Message is required");
            }

            /*if (name != "" && email != "" && isValidEmail(email) && phone != "" && isValidPhoneNumber(phone) && message != "") {
                $(this).unbind('submit').submit();
            }*/
            if (name != "" && email != "" && isValidEmail(email) && phone != "" && isValidPhoneNumber(phone) && message != "") {
                // Submit form via AJAX
                $.ajax({
                    url: '/contact',
                    method: 'POST',
                    data: $(this).serialize(),
                      success: function(response) {
                        $('.loading-modal').modal('hide');
                        //console.log(response)
                        toastr.options.progressBar = true;
                        toastr.success('Thank you for contacting us! We will get back to you soon');
                        $('#contactForm')[0].reset();
                    },
                    error: function(response) {//console.log(response.responseJSON.error)
                      $('.loading-modal').modal('hide');
                      toastr.options.progressBar = true;
                      toastr.error(response.responseJSON.error);
                    }
                  });
                }


        });

        //for feedback form
        $('#feedbackForm').submit(function (e) {
            e.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#mobile_number').val();
            let source = $("input[name='source']:checked").val();
            let other_text = $("#otherText").val();

            $(".error").html("");
            if (name == "") {
                $("#nameErrorFb").html("Name is required");
            }
            if (email == "") {
                $("#emailErrorFb").html("Email is required");
            } else if (!isValidEmail(email)) {
                $("#emailErrorFb").html("Invalid email address");
            }
            if (phone == "") {
                $("#phoneErrorFb").html("Phone number is required");
            } else if (!isValidPhoneNumber(phone)) {
                $("#phoneErrorFb").html("Invalid phone number");
            }

            if (source == "") {
                $("#sourceError").html("Source is required");
            }

            if(source == 'Other')
            {
              if (other_text == "") {
                  $("#sourceError").html("Source is required");
              }
            }

            if (name != "" && email != "" && isValidEmail(email) && phone != "" && isValidPhoneNumber(phone) && source != "") {

              if(source == 'Other')
              {
                if (other_text == "") {
                    return;
                }
              }
                // Submit form via AJAX
                $.ajax({
                    url: '/feedback',
                    method: 'POST',
                    data: $(this).serialize(),
                      success: function(response) {
                        //console.log(response)
                        toastr.options.progressBar = true;
                        toastr.success('Thank you for your feedback!');
                        $('#feedbackForm')[0].reset();
                    },
                    error: function(response) {
                      toastr.options.progressBar = true;
                      toastr.error(response.responseJSON.message);
                    }
                  });
                }


        });

        //for appointment
        $('#appointmentForm').submit(function (e) {//console.log('test')
            e.preventDefault();

            let name = $('#nameAp').val();
            let email = $('#emailAp').val();
            let phone = $('#phoneAp').val();
            let referral = $('#referral').val();
            let other_text = $("#otherApText").val();

            $(".error").html("");

            if (name == "") {
                $("#nameApError").html("Name is required");
            }
            if (email == "") {
                $("#emailApError").html("Email is required");
            } else if (!isValidEmail(email)) {
                $("#emailApError").html("Invalid email address");
            }
            if (phone == "") {
                $("#phoneApError").html("Phone number is required");
            } else if (!isValidPhoneNumber(phone)) {
                $("#phoneApError").html("Invalid phone number");
            }

            if (referral == "") {
                $("#sourceAppError").html("Source is required");
            }

            if(referral == 'other')
            {
              if (other_text == "") {
                  $("#sourceAppError").html("Source is required");
              }
            }

            if (name != "" && email != "" && isValidEmail(email) && phone != "" && isValidPhoneNumber(phone))
            {
              $('.loading-modal').modal('show');

              if(referral == 'other')
              {
                if (other_text == "") {
                    return;
                }
              }
              //console.log('test')
                // Submit form via AJAX
                $.ajax({
                    url: '/appointment',
                    method: 'POST',
                    data: $(this).serialize(),
                      success: function(response) {
                        $('.loading-modal').modal('hide');
                        //console.log(response)
                        toastr.options.progressBar = true;
                        toastr.success('Thank you for booking an appointment with us! We will get back to you soon');
                        $('#appointmentForm')[0].reset();
                    },
                    error: function(response) {//console.log(response.responseJSON.error)
                      $('.loading-modal').modal('hide');
                      toastr.options.progressBar = true;
                      toastr.error(response.responseJSON.error);
                    }
                  });
                }


        });

        $('#appointmentForm1').submit(function (e) {//console.log('test')
            e.preventDefault();

            let name = $('#nameAp1').val();
            let email = $('#emailAp1').val();
            let phone = $('#phoneAp1').val();
            let referral = $('#referral1').val();
            let other_text = $("#otherApText1").val();

            $(".error").html("");

            if (name == "") {
                $("#nameApError1").html("Name is required");
            }
            if (email == "") {
                $("#emailApError1").html("Email is required");
            } else if (!isValidEmail(email)) {
                $("#emailApError1").html("Invalid email address");
            }
            if (phone == "") {
                $("#phoneApError1").html("Phone number is required");
            } else if (!isValidPhoneNumber(phone)) {
                $("#phoneApError1").html("Invalid phone number");
            }

            if (referral == "") {
                $("#sourceAppError1").html("Source is required");
            }

            if(referral == 'other')
            {
              if (other_text == "") {
                  $("#sourceAppError1").html("Source is required");
              }
            }

            if (name != "" && email != "" && isValidEmail(email) && phone != "" && isValidPhoneNumber(phone))
            {
              $('.loading-modal').modal('show');

              if(referral == 'other')
              {
                if (other_text == "") {
                    return;
                }
              }

              $.ajax({
                  url: '/appointment',
                  method: 'POST',
                  data: $(this).serialize(),
                    success: function(response) {
                      $('.loading-modal').modal('hide');
                      //console.log(response)
                      toastr.options.progressBar = true;
                      toastr.success('Thank you for booking an appointment with us! Someone from our office will contact you to confirm your appointment.');
                      $('#appointmentForm1')[0].reset();
                  },
                  error: function(response) {//console.log(response.responseJSON.error)
                    $('.loading-modal').modal('hide');
                    toastr.options.progressBar = true;
                    toastr.error(response.responseJSON.error);
                  }
                });
              }

        });

        //for contact and feedback forms
        function isValidEmail(email) {
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }

        function isValidPhoneNumber(phone) {
            // US phone number format: (123) 456-7890
            var pattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
            return pattern.test(phone);
        }


    });

    //below is for the feedback form
    document.addEventListener('DOMContentLoaded', function() {
       var otherRadioButton = document.getElementById('other');
       var otherTextInput = document.getElementById('otherText');

       // Function to handle radio button click
       function handleRadioButtonClick() {
           try {
               if (!otherTextInput) return;
               if (this.id === 'other') {
                  otherTextInput.style.display = 'block';
               } else {
                  otherTextInput.style.display = 'none';
               }
           } catch (e) {
               console.warn('handleRadioButtonClick error', e);
           }
       }

      // Add event listeners for all radio buttons
      var radios = document.querySelectorAll('input[type="radio"]');
      radios.forEach(function(radio) {
          radio.addEventListener('click', handleRadioButtonClick);
      });
   });

   //below is for the appointment form
   $('#referral').change(function(){
        $(this).val() == 'other' ? $("#otherApText").show() : $("#otherApText").hide();
    });

    $('#stickyDiv').hide();

    $('#book-appointment').click(function() {
        $('#stickyDiv').show();
    });

    $('.close-btn').click(function() {
        $('#stickyDiv').hide();
    });

   document.addEventListener('DOMContentLoaded', function() {
      var otherRadioButton = document.getElementById('referral');
      var otherTextInput = document.getElementById('otherApText');

      // Function to handle radio button click
      function handleRadioButtonClick() {
          if (this.value === 'other') {
             otherTextInput.style.display = 'block';
          } else {
             otherTextInput.style.display = 'none';
          }
      }

      // Add event listeners for the referral select (if present)
      var referral = document.getElementById('referral');
      if (referral) {
          referral.addEventListener('change', function() {
              try {
                  if (!otherTextInput) return;
                  if (this.value === 'other') otherTextInput.style.display = 'block'; else otherTextInput.style.display = 'none';
              } catch (e) { console.warn(e); }
          });
      }
  });

})(jQuery);

$(document).ready(function() {
        // Function to extract URL parameter value
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        // Function to trigger click event on portfolio menu item based on filter value
        function triggerPortfolioMenuClick(filterValue) {
            // Find the li element with data-filter attribute matching filterValue
            var $li = $('.portfolio-menu ul li[data-filter=".' + filterValue + '"]');

            // If such li element exists, simulate a click on it
            if ($li.length > 0) {
                $li.addClass('active'); // Add active class (if needed)
                $('.portfolio-menu ul li').not($li).removeClass('active'); // Remove active class from other li elements
                var selector = $li.attr('data-filter');
                $('.portfolio-item').isotope({
                    filter: selector
                });
                console.log('Clicked on ' + filterValue); // Optional: Log to console for verification
            } else {
                console.log('No portfolio menu item found with filter value ' + filterValue);
            }
        }

        // Example usage:
        $(document).ready(function() {
            // Get the filter value from the URL parameter
            var filterValue = getParameterByName('filter');

            // Trigger click event on portfolio menu item based on filter value
            if (filterValue) {
                triggerPortfolioMenuClick(filterValue);
            }
        });
    });
