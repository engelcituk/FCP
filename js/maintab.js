require.config({
	paths: {
		'index': 'index',
		'jquery': 'jquery-1.10.1.min.js',
		'jquery.ba-resize': 'resize',
		'jquery.tabs+accordion': 'accordion',
	},
	shim: {
		'jquery.ba-resize': ['jquery'],
	},
});

require(['accordion'], function() {
	
	$('.accordion, .tabs')
	.TabsAccordion({
		hashWatch: true,
		pauseMedia: true,
		responsiveSwitch: 'tablist',
		saveState: sessionStorage,
	});
});

// demo only
// if(document.body.querySelector('.theme .color-scheme')) require(['../demo/js/demo']);