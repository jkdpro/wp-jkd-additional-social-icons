( function ( wp ) {
	const { registerBlockVariation } = wp.blocks;
	const { createElement } = wp.element;
	const { SVG, Path } = wp.primitives;
	const services = [
		{ name: 'booksy', title: 'Booksy' },
		{ name: 'freelancer', title: 'Freelancer' },
	];

	services.forEach( ( service ) => {
		const iconData = window.wpJdkAdditionalSocialIcons[ service.name ];
		// Inserter icons are monochrome like core icons: drop the background tile and use currentColor.
		const inserterPaths = iconData.paths
			.filter( ( path ) => ! ( path.fill === '#000000' && ! path.stroke ) )
			.map( ( path ) => ( {
				...path,
				...( path.fill && path.fill !== 'none' ? { fill: 'currentColor' } : {} ),
				...( path.stroke ? { stroke: 'currentColor' } : {} ),
			} ) );
		registerBlockVariation( 'core/social-link', {
			name: service.name,
			title: service.title,
			icon: createElement(
				SVG,
				{ xmlns: 'http://www.w3.org/2000/svg', viewBox: iconData.viewBox },
				...inserterPaths.map( ( path ) =>
					createElement( Path, {
						key: path.d,
						...path,
					} )
				)
			),
			attributes: { service: service.name },
			isActive: [ 'service' ],
		} );
	} );
} )( window.wp );
