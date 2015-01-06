$(function() {
	
	$(document).ready(function() {
		$('.cal_now').map(function( index ) {
			//console.log( index );
			var htmlcal = $(this).attr('href') + ' .calendar_content';
			var calheight = $(this).parents('.calendar').height();
			$(this).parents('.calendar').html('<div style="height:'+calheight+'px;background:transparent url(tools/wikical/presentation/images/loading.gif) no-repeat center center;"></div>').load(htmlcal);
			return false;
		})		
	});

	//liens pour se déplacer dans le calendrier
	$(".next_month, .prev_month, .select_item").on('click', 'a', function() {
		var htmlcal = $(this).attr('href') + ' .calendar_content';
		var calheight = $(this).parents('.calendar').height();
		$(this).parents('.calendar').html('<div style="height:'+calheight+'px;background:transparent url(tools/wikical/presentation/images/loading.gif) no-repeat center center;"></div>').load(htmlcal);
		return false;
	});
	
	//listes déroulantes de sélection de date
	$(".select_annee, .select_mois").on('change', 'a', function() {
		var htmlcal = $(this).find("option:selected").val() + ' .calendar_content';
		var calheight = $(this).parents('.calendar').height();
		$(this).parents('.calendar').html('<div style="height:'+calheight+'px;background:transparent url(tools/wikical/presentation/images/loading.gif) no-repeat center center;"></div>').load(htmlcal);
		return false;
	});

	// affichage des évenements par survol et clique
  $('.calendar').on('mouseenter', '.evday' , function() {
		$('.evday').removeClass('sel');
		$(this).addClass('sel');
		$(this).children('.events').show();
  });
  
  $('.calendar').on('mouseleave', '.evday' , function() {
    $('.evday').removeClass('sel');
   	$('.events').hide();
	});
  
  $('.calendar').on('click', '.evday' , function() {
		if ($(this).hasClass('sel')) {
      $('.evday').removeClass('sel');
			$('.events').hide();
		}
		else {
      $('.evday').removeClass('sel');
			$(this).addClass('sel');
			$(this).children('.events').show();
		}
  });
			
	// affichage des mois par clique
  $('.calendar').on('click', '.month_list' , function() {
		if ($(this).hasClass('selm')) {
      $('.month_list').removeClass('selm');
      $('.selectm').hide();
		}
		else {
      $('.month_list').addClass('selm');
      $('.selectm').show();
		}
  });
			
	// affichage des années par clique
  $('.calendar').on('click', '.year_list' , function() {
		if ($(this).hasClass('sely')) {
      $('.year_list').removeClass('sely');
      $('.selecta').hide();
		}
		else {
      $('.year_list').addClass('sely');
      $('.selecta').show();
		}
  });
			
});
