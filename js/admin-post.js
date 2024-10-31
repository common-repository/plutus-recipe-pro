jQuery( function ( $ ) {
	'use strict';

	var MixAPOSTADMIN = MixAPOSTADMIN || {};

	MixAPOSTADMIN.colorPicker = function () {
		$( document ).on( 'ready', function ( event, widget ) {
			$( '.plutus-color-picker' ).wpColorPicker();
		} );
	},
		MixAPOSTADMIN.imageSelect = function () {
			$( 'body' ).on( 'change', '.plutus-image-select input', function () {
				var $this = $( this ),
					type = $this.attr( 'type' ),
					selected = $this.is( ':checked' ),
					$parent = $this.parent(),
					$others = $parent.siblings();
				if ( selected ) {
					$parent.addClass( 'plutus-active' );
					if ( type === 'radio' ) {
						$others.removeClass( 'plutus-active' );
					}
				} else {
					$parent.removeClass( 'plutus-active' );
				}
			} );
			$( '.plutus-image-select input' ).trigger( 'change' );
		},
		MixAPOSTADMIN.metaboxTab = function () {
			$( '.plutus-metabox-tabs' ).on( 'click', 'a', function ( e ) {
				e.preventDefault();

				var $li = $( this ).parent(),
					panel = $li.data( 'panel' ),
					$wrapper = $li.closest( '.plutus-metabox-wrap' ),
					$panel = $wrapper.find( '.plutus-tab-panel-' + panel );

				$li.addClass( 'tab-active' ).siblings().removeClass( 'tab-active' );
				$panel.show().siblings().hide();
			} );

			$( '#plutus_recipe_ingredients_type' ).on( 'change', function () {

				var selected  =  $( "#plutus_recipe_ingredients_type option:selected" ).val();
				if ( 'wysiwyg' == selected ) {
					$( '.plutus_recipe_ingredients_rtext' ).removeClass( 'plutus-hidden' );
					$( '.plutus_recipe_ingredients' ).addClass( 'plutus-hidden' );
				} else {
					$( '.plutus_recipe_ingredients_rtext' ).addClass( 'plutus-hidden' );
					$( '.plutus_recipe_ingredients' ).removeClass( 'plutus-hidden' );
				}
			} );

		},
		MixAPOSTADMIN.metaboxAccordion = function () {
			var acc = document.getElementsByClassName( "plutus-accordion-name" );
			var i;

			for ( i = 0; i < acc.length; i ++ ) {
				acc[i].addEventListener( "click", function () {
					this.classList.toggle( "active" );
					var panel = this.nextElementSibling;
					if ( panel.style.maxHeight ) {
						panel.style.maxHeight = null;
					} else {
						panel.style.maxHeight = panel.scrollHeight + "px";
					}

					return false;
				} );
			}
			return false;
		},
		MixAPOSTADMIN.uploadImg = function () {
			var frame = wp.media( {
				title: PlutusObject.WidgetImageTitle,
				multiple: false,
				library: {type: 'image'},
				button: {text: PlutusObject.WidgetImageButton}
			} );

			$( 'body' )
				.on( 'click', '.plutus-widget-image__select', function ( e ) {

					e.preventDefault();
					var $this = $( this ),
						$input = $this.siblings( 'input' ),
						$image = $this.siblings( 'img' ),
						$placeholder = $this.prev(),
						$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

					frame.off( 'select' )
					     .on( 'select', function () {
						     var id = frame.state().get( 'selection' ).toJSON()[0].id;
						     var url = frame.state().get( 'selection' ).toJSON()[0].url;
						     $input.val( id );
						     $input.data( 'url', url );
						     $image.attr( 'src', url ).removeClass( 'hidden' );
						     $placeholder.addClass( 'hidden' );
						     $savewidget.prop( "disabled", false );
					     } )
					     .open();
				} )
				.on( 'click', '.plutus-widget-image__remove', function ( e ) {
					e.preventDefault();
					var $this = $( this ),
						$input = $this.siblings( 'input' ),
						$image = $this.siblings( 'img' ),
						$placeholder = $this.prev().prev(),
						$savewidget = $this.closest( '.widget-inside' ).find( '.widget-control-save' );

					$input.val( '' );
					$image.addClass( 'hidden' );
					$placeholder.removeClass( 'hidden' );
					$savewidget.prop( "disabled", false );
				} )
				.on( 'change', '.plutus-widget-image__input', function ( e ) {
					e.preventDefault();
					var $this = $( this ),
						url = $this.data( url ),
						$image = $this.siblings( 'img' );
					$image.attr( 'src', url )[url ? 'removeClass' : 'addClass']( 'hidden' );
				} );
		};

	MixAPOSTADMIN.uploadImgs = function () {
		var file_frame;

		$( document ).on( 'click', '.plutus-add-images', function ( e ) {

			e.preventDefault();

			var $this = $( this ),
				fieldID = $this.data( 'fieldid' ),
				uploaderTitle = $this.data( 'uploader-title' ),
				uploaderBtnText = $this.data( 'uploader-button-text' );

			if ( file_frame ) {
				file_frame.close();
			}

			file_frame = wp.media.frames.file_frame = wp.media( {
				title: uploaderTitle,
				button: {
					text: uploaderBtnText,
				},
				multiple: true
			} );

			file_frame.on( 'select', function () {
				var listIndex = $( '.plutus-images-list li' ).index( $( '.plutus-images-list li:last' ) ),
					selection = file_frame.state().get( 'selection' );

				selection.map( function ( attachment, i ) {
					var attachment = attachment.toJSON(),
						index = listIndex + (
						        i + 1
						);

					var $html_img = '<li><input type="hidden" name="' + fieldID + '[' + index + ']"  value="' + attachment.id + '">'
					                + '<img class="image-preview" src="' + attachment.sizes.thumbnail.url + '">'
					                + '<ul class="actions"><li><a href="#" class="remove-image delete" data-fieldid ="' + fieldID + '"><i class="dashicons dashicons-no-alt"></i></a></li></ul>'
					                + '</li>';

					$( '.plutus-images-list' ).append( $html_img );
				} );
			} );
			file_frame.open();

		} );

		function resetIndex( fieldid ) {
			$( '.plutus-images-list li' ).each( function ( i ) {
				$( this ).find( 'input:hidden' ).attr( 'name', fieldid + '[' + i + ']' );
			} );
		}

		function makeSortable() {
			if ( ! $( '.plutus-images-list' ).length ) {
				return false;
			}

			$( '.plutus-images-list' ).each( function () {

				var $this = $( this ),
					fieldID = $this.data( 'fieldid' );

				$this.sortable( {
					opacity: 0.6,
					stop: function () {
						resetIndex( fieldID );
					}
				} );
			} );

		}

		$( document ).on( 'click', '.plutus-widget-images a.remove-image', function ( e ) {
			e.preventDefault();

			var fieldid = $( this ).data( 'fieldid' );

			$( this ).parents( 'li' ).animate( {opacity: 0}, 200, function () {
				$( this ).remove();
				resetIndex( fieldid );
			} );
		} );

		makeSortable();
	};

	/* Init functions
	 ---------------------------------------------------------------*/
	$( document ).ready( function () {
		MixAPOSTADMIN.colorPicker();
		MixAPOSTADMIN.uploadImg();
		MixAPOSTADMIN.uploadImgs();
		MixAPOSTADMIN.imageSelect();
		MixAPOSTADMIN.metaboxTab();
		MixAPOSTADMIN.metaboxAccordion();
	} );
} );