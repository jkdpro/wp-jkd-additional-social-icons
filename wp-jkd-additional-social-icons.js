( function ( wp ) {
	const { registerBlockVariation } = wp.blocks;
	const { createElement } = wp.element;
	const { SVG, Path } = wp.primitives;
	const services = [
		{ name: 'booksy', title: 'Booksy' },
		{ name: 'freelancer', title: 'Freelancer.com' },
	];

	services.forEach( ( service ) => {
		registerBlockVariation( 'core/social-link', {
			name: service.name,
			title: service.title,
			icon: createElement(
				SVG,
				{ xmlns: 'http://www.w3.org/2000/svg', viewBox: '0 0 24 24' },
				createElement( Path, {
					fillRule: 'evenodd',
					d: window.wpJdkAdditionalSocialIconPaths[ service.name ],
				} )
			),
			attributes: { service: service.name },
			isActive: [ 'service' ],
		} );
	} );
} )( window.wp );
