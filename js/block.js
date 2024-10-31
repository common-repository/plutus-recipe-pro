(
	function ( blocks, element, components, editor ) {
		var el = element.createElement,
			ServerSideRender = components.ServerSideRender,
			TextControl = components.TextControl,
			SelectControl = components.SelectControl,
			RangeControl = components.RangeControl,
			ToggleControl = components.ToggleControl,
			InspectorControls = editor.InspectorControls;

		const selectstyle = [
			{value: 's1', label: 'Style 1'},
			{value: 's2', label: 'Style 2'},
			{value: 's3', label: 'Style 3'},
			{value: 's4', label: 'Style 4'},
		];

		const selectcolumns = [
			{value: '2', label: '2 Columns'},
			{value: '3', label: '3 Columns'},
			{value: '4', label: '4 Columns'},
		];

		const selectImageSize = [
			{value: 'landscape', label: 'Landscape'},
			{value: 'square', label: 'Square'},
			{value: 'vertical', label: 'Vertical'},
		];

		blocks.registerBlockType( 'plutus-recipegtb/plutus-recipe', {
			title: 'Plutus: Recipe Pro',
			icon: 'editor-code',
			category: 'layout',
			edit: function ( props ) {
				return [
					el( "div", {},
						el( ServerSideRender, {
							block: 'plutus-recipegtb/plutus-recipe',
							attributes: props.attributes
						} )
					),
					el( InspectorControls,
						{}, [
							el( "hr", {
								style: {marginTop: 20}
							} ),
							el( TextControl, {
								label: 'Post ID',
								value: props.attributes.postID,
								options: selectcolumns.map( ( {value, label} ) => (
									{
										value: value,
										label: label,
									}
								) ),
								onChange: ( value ) => {
									props.setAttributes( {postID: value} );
								}
							} ),

						]
					)
				];
			},
			save: function () {
				return null;
			},
		} );

		blocks.registerBlockType( 'plutus-recipegtb/plutus-recipe-index', {
			title: 'Plutus: Recipe Index',
			icon: 'editor-code',
			category: 'layout',
			edit: function ( props ) {
				return [
					el( "div", {},
						el( ServerSideRender, {
							block: 'plutus-recipegtb/plutus-recipe-index',
							attributes: props.attributes
						} )
					),
					el( InspectorControls,
						{}, [
							el( "hr", {
								style: {marginTop: 20}
							} ),
							el( SelectControl, {
								label: 'Select Skin',
								value: props.attributes.style,
								options: selectstyle.map( ( {value, label} ) => (
									{
										value: value,
										label: label,
									}
								) ),
								onChange: ( value ) => {
									props.setAttributes( {style: value} );
								}
							} ),
							el( TextControl, {
								label: 'Title',
								value: props.attributes.title,
								onChange: ( value ) => {
									props.setAttributes( {title: value} );
								}
							} ),
							el( TextControl, {
								label: 'Category Slug',
								value: props.attributes.cat,
								onChange: ( value ) => {
									props.setAttributes( {cat: value} );
								}
							} ),
							el( RangeControl, {
								label: 'Numbers Item to Show',
								value: props.attributes.ppp,
								onChange: ( value ) => {
									props.setAttributes( {ppp: value} );
								}
							} ),
							el( SelectControl, {
								label: 'Select Layout',
								value: props.attributes.columns,
								options: selectcolumns.map( ( {value, label} ) => (
									{
										value: value,
										label: label,
									}
								) ),
								onChange: ( value ) => {
									props.setAttributes( {columns: value} );
								}
							} ),
							el( ToggleControl, {
								label: 'Show Category of Items',
								checked: props.attributes.show_pcat,
								onChange: ( value ) => {
									props.setAttributes( {show_pcat: value} );
								}
							} ),
							el( ToggleControl, {
								label: 'Hide Date of Items',
								checked: props.attributes.hide_pdate,
								onChange: ( value ) => {
									props.setAttributes( {hide_pdate: value} );
								}
							} ),
							el( ToggleControl, {
								label: 'Hide Author of Items',
								checked: props.attributes.hide_pauthor,
								onChange: ( value ) => {
									props.setAttributes( {hide_pauthor: value} );
								}
							} ),
							el( ToggleControl, {
								label: 'Hide Featured Image of Items',
								checked: props.attributes.hide_pimg,
								onChange: ( value ) => {
									props.setAttributes( {hide_pimg: value} );
								}
							} ),
							el( SelectControl, {
								label: 'Select type of Image',
								value: props.attributes.image_type,
								options: selectImageSize.map( ( {value, label} ) => (
									{
										value: value,
										label: label,
									}
								) ),
								onChange: ( value ) => {
									props.setAttributes( {image_type: value} );
								}
							} ),
							el( TextControl, {
								label: 'Custom Link "View All" button',
								value: props.attributes.view_more_link,
								onChange: ( value ) => {
									props.setAttributes( {view_more_link: value} );
								}
							} ),
							el( TextControl, {
								label: 'Custom "View All" button text',
								value: props.attributes.view_more_text,
								onChange: ( value ) => {
									props.setAttributes( {view_more_text: value} );
								}
							} ),
							el( TextControl, {
								label: 'Rows Gap',
								value: props.attributes.row_gap,
								onChange: ( value ) => {
									props.setAttributes( {row_gap: value} );
								}
							} ),
							el( TextControl, {
								label: 'Columns Gap',
								value: props.attributes.col_gap,
								onChange: ( value ) => {
									props.setAttributes( {col_gap: value} );
								}
							} ),
						]
					)
				];
			},
			save: function () {
				return null;
			},
		} );
	}(
		window.wp.blocks,
		window.wp.element,
		window.wp.components,
		window.wp.editor,
	)
);
