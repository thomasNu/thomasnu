
$(function() {
	$(window).resize(function() {
		$('div.slide').each(function() {
			var w = $(this).find('img').width();
			var h = $(this).find('img').height();
			var maxH = $(window).height() - $(this).find('p.slide-text').height() - 160;
			if (maxH != h && maxH >= 140) {
				var imgW = Math.round((w * maxH) / h);
				if (imgW != 575) {
					if (imgW > 575) {
						var maxH = Math.round((h * 575) / w);
						imgW = 575;
					}
					$(this).find('img').attr({width: imgW, height: maxH});
					$(this).find('p.slide-text').css('width', imgW);
					$(this).css('width', imgW);
				}
			}
		});		
    }).resize();
    $('p[lang]').removeAttr('style');
    $('li > p').removeAttr('style');
    $('div#content, div#prt-content').each(function() { 
    	$(this).find('h1, h2:not(#gallery)').each(function() {
            var $header = $(this).html();
            $(this).replaceWith('<h3>' + $header + '</h3>');
    	});
    	$(this).find('p').each(function() {
            var $paragraph = $(this).html();  
//            alert('$paragraph');
//            var $para = $paragraph.replace(/^<br>/U, ''); 
            if ($paragraph == ' ' || $paragraph.substring(0, 3) == '<br') {
                $(this).remove();
            }
    	});
    });
    // rotateBanners();
    initLightbox($('div.settings p.lightbox-click').text(), $('div.settings p.lightbox-close').text());
	$('div#calendar').each(function() {
		markNow();
	});
	$('div#slideshow').each(function() {
		initGallery();
	});

    var $tabs = $('#tnu-jquery-tabs li');
    var $contents = $('.tnu-tab-content');
    $tabs.click(function(event) {
        event.preventDefault();
        if ($(this).hasClass('active')) return;
        $tabs.removeClass('active');
        $(this).addClass('active');
        $contents.removeClass('tnu-tab-active').hide();
        $('#tnu-jquery-tabs').find('#' + $(this).find('a').attr('title')).addClass('tnu-tab-active').fadeIn('slow');
    });

    // KIWI
	$('div#album2013,div#album2012').css('text-align', 'right');

});

