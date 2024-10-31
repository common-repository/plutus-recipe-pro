jQuery( function ( $ ) {
	'use strict';
	$( document ).ready( function () {
		if ( $( '.plutus-image-lightbox' ).length && $().owlCarousel ) {
			$( '.plutus-image-lightbox' ).each( function () {
				$( this ).magnificPopup( {
					delegate: 'a',
					type: 'image',
					closeOnContentClick: false,
					closeBtnInside: false,
					mainClass: 'mfp-with-zoom mfp-img-mobile',
					gallery: {
						enabled: true
					}
				} );
			} );
		}

		if ( $( '.plutus-zoomImg' ).length && $().zoom ) {
			$( '.plutus-zoomImg' ).zoom();
		}

		if ( $( '.plutus-recipe-owl-carousel' ).length && $().owlCarousel ) {
			$( '.plutus-recipe-owl-carousel' ).owlCarousel( {
				loop: true,
				margin: 0,
				dots: true,
				items: 1,
				autoHeight: true
			} )
		}


		$( 'body' ).on( 'click', '.plutus-recipe-printbtn', function () {
			var printWindow = window.open( '', '', 'height=800,width=800' );
			var printCSS = jQuery( this ).data( 'print' );
			var divContents = jQuery( this ).parent().parent().parent().parent().html() +
			                  "<script>" +
			                  "window.onload = function() {" +
			                  "     window.print();" +
			                  "};" +
			                  "<" + "/script>";
			var srcCSS = '<link href=\"' + printCSS + '\" rel=\"stylesheet\" type=\"text/css\" media=\"print\">';
			setTimeout( function () {
				printWindow.document.write( srcCSS + divContents );
				printWindow.document.close();
			}, 250 );
			return false;
		} );
	} );
} );
