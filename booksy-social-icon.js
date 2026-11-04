( function ( wp ) {
	const { registerBlockVariation } = wp.blocks;
	const { createElement } = wp.element;
	const { SVG, Path } = wp.primitives;

	const icon = createElement(
		SVG,
		{ xmlns: 'http://www.w3.org/2000/svg', viewBox: '0 0 24 24' },
		createElement( Path, {
			fillRule: 'evenodd',
			d: window.booksySocialIconPath,
		} )
	);

	registerBlockVariation( 'core/social-link', {
		name: 'booksy',
		title: 'Booksy',
		icon,
		attributes: { service: 'booksy' },
		isActive: [ 'service' ],
	} );
} )( window.wp );
