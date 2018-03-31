
(function($){
    $.datepicker.regional['fi'] = {
		closeText: 'Sulje',
		prevText: '&laquo;Edellinen',
		nextText: 'Seuraava&raquo;',
		currentText: 'T&auml;n&auml;&auml;n',
        monthNames: ['Tammikuu','Helmikuu','Maaliskuu','Huhtikuu','Toukokuu','Kes&auml;kuu',
        'Hein&auml;kuu','Elokuu','Syyskuu','Lokakuu','Marraskuu','Joulukuu'],
        monthNamesShort: ['Tammi','Helmi','Maalis','Huhti','Touko','Kes&auml;',
        'Hein&auml;','Elo','Syys','Loka','Marras','Joulu'],
		dayNamesShort: ['Su','Ma','Ti','Ke','To','Pe','Su'],
		dayNames: ['Sunnuntai','Maanantai','Tiistai','Keskiviikko','Torstai','Perjantai','Lauantai'],
		dayNamesMin: ['Su','Ma','Ti','Ke','To','Pe','La'],
		weekHeader: 'Vk',
        dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
})($);


$(document).ready(function() 
    { 
        $(".tablesorter").tablesorter(); 
			
		// Fade info message out
		$( '.validation-ok' ).delay(4000).fadeOut(1000, function() {
			// Animation complete.
		});

		$( "#showRarities" ).click(function() {
			console.log("Show rarities");
			$( ".rare" ).show();
			$( "#hideRarities" ).addClass("active");
			$( "#showRarities" ).removeClass("active");
		});

		$( "#hideRarities" ).click(function() {
			console.log("Hide rarities");
			$( ".rare" ).hide();
			$( "#showRarities" ).addClass("active");
			$( "#hideRarities" ).removeClass("active");
		});

    }
); 