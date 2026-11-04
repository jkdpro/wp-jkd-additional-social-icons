( function ( wp ) {
	const { registerBlockVariation } = wp.blocks;
	const { createElement } = wp.element;
	const { SVG, Path } = wp.primitives;
	const services = [
		{ name: 'booksy', title: 'Booksy' },
		{ name: 'freelancer', title: 'Freelancer.com' },
	];

	services.forEach( ( service ) => {
		const iconData = window.wpJdkAdditionalSocialIcons[ service.name ];
		registerBlockVariation( 'core/social-link', {
			name: service.name,
			title: service.title,
			icon: createElement(
				SVG,
				{ xmlns: 'http://www.w3.org/2000/svg', viewBox: iconData.viewBox },
				...iconData.paths.map( ( path ) =>
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
