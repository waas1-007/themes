/**
 * Front-end theme scripts
 *
 * @since 1.0.0
 */

jQuery( function ( $ ) {
	'use strict';

	/* -----------------------------------------
	First letter content styling
	----------------------------------------- */
	(function () {
		var $entries = $('.entry-item-post');
		var $content = $entries.find('.entry-item-excerpt');
		var $stylizedParagraphs = $('.is-style-ignition-milos-letter-stylized');
		var lineHeight;

		if (!$content.length && !$stylizedParagraphs.length) {
			return;
		}

		if ($content.length > 0) {
			lineHeight = window.getComputedStyle($content.get(0), null).getPropertyValue('line-height');
		}

		$entries.each(function () {
			var $this = $(this);
			var $p0 = $this.find('.entry-item-excerpt').find('p:first-of-type').first();

			// Only apply stylized first letter if the first
			// paragraph spans 4 lines or more.
			if (!$p0.length || $p0.height() < 4 * parseInt(lineHeight, 10)) {
				return;
			}

			var $letter = $('<span />', {
				class: 'letter-stylized',
				text: $p0.text().charAt(0).toUpperCase(),
			});
			$p0.prepend($letter);
		});


		$stylizedParagraphs.each(function () {
			var $this = $(this);

			var $letter = $('<span />', {
				class: 'letter-stylized',
				text: $this.text().charAt(0).toUpperCase(),
			});
			$this.prepend($letter);
		} )
	})();
} );
