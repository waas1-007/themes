/**
 * Ajax Product Search
 *
 * @since 1.0.0
 */

jQuery( function ( $ ) {
	'use strict';

	var $window = $( window );
	var $body   = $( 'body' );

	/* -----------------------------------------
	 Ajax Product Search
	 ----------------------------------------- */
	var $productSearchForm = $('.category-search-form');
	var $categoriesSelect = $('.category-search-select');
	var $searchInput = $('.category-search-input');
	var $categoryResults = $('.category-search-results');
	var $categoryResultsTemplate = $('.category-search-results-item');
	var $spinner = $('.category-search-spinner');

	function dismissSearchResults() {
		$categoryResults.hide();
	}

	function queryProducts(category, string) {
		return $.ajax({
			url: ignition_nozama_vars.ajaxurl,
			method: 'get',
			data: {
				action: 'ignition_nozama_search_products',
				product_cat: category,
				s: string,
			},
		});
	}

	function queryProductsAndPopulateResults(category, string) {
		if (string.trim().length < 3) {
			dismissSearchResults();
			return;
		}

		$spinner.addClass('visible');

		return queryProducts(category, string)
			.done(function (response) {
				$spinner.removeClass('visible');

				if (response.error) {
					var $errorMessage = $categoryResultsTemplate.clone();
					var errorString = response.errors.join(', ');

					$errorMessage.find('.category-search-results-item-thumb').remove();
					$errorMessage.find('.category-search-results-item-excerpt').remove();
					$errorMessage.find('.category-search-results-item-price').remove();

					$errorMessage
						.addClass('error')
						.find('.category-search-results-item-title')
						.text(errorString);
					$categoryResults.html($errorMessage).show();

					return;
				}

				var products = response.data;

				if (products.length === 0) {
					var $notFoundMessage = $categoryResultsTemplate.clone();
					$notFoundMessage.find('.category-search-results-item-thumb').remove();
					$notFoundMessage.find('.category-search-results-item-excerpt').remove();
					$notFoundMessage.find('.category-search-results-item-price').remove();
					$notFoundMessage
						.find('.category-search-results-item-title')
						.text(ignition_nozama_vars.search_no_products);
					$categoryResults.html($notFoundMessage).show();

					return;
				}

				var $items = products.map(function (product) {
					var $template = $categoryResultsTemplate.clone();
					$template.find('a').attr('href', product.url);
					if ( ! product.image ) {
						$template.find('.category-search-results-item-thumb').remove();
					} else {
						$template.find('.category-search-results-item-thumb').html(product.image);
					}
					$template.find('.category-search-results-item-title')
						.text(product.title);
					$template.find('.category-search-results-item-excerpt')
						.text(product.excerpt);
					$template.find('.category-search-results-item-price')
						.html(product.price);

					return $template;
				});

				$categoryResults.html($items);
				$categoryResults.show();
			});
	}

	var throttledQuery = debounce(queryProductsAndPopulateResults, 500);

	if ($productSearchForm.hasClass('form-ajax-enabled')) {
		$searchInput.on('change keyup focus', function (event) {
			// Do nothing on arrow up / down as we're using them for navigation
			if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
				return;
			}

			var $this = $(this);
			var string = $this.val();

			if (string.trim().length < 3) {
				dismissSearchResults();
				return;
			}

			throttledQuery($categoriesSelect.val(), $this.val());
		});

		// Bind up / down arrow navigation on search results
		$searchInput.on('keydown', function (event) {
			if (event.key !== 'ArrowDown' && event.key !== 'ArrowUp') {
				return;
			}

			var $items = $categoryResults.children();
			var $highlighted = $categoryResults.find('.highlighted');
			var currentIndex = $highlighted.index();

			if ($items.length === 0 || !$items) {
				return;
			}

			if (event.key === 'ArrowDown') {
				var $next = $items.eq(currentIndex + 1);

				if ($next.length) {
					$items.removeClass('highlighted');
					$next.addClass('highlighted');
				}
			}

			if (event.key === 'ArrowUp') {
				var $prev = $items.eq(currentIndex - 1);

				if ($prev.length) {
					$items.removeClass('highlighted');
					$prev.addClass('highlighted');
				}
			}
		});

		// Bind form submit to go the highlighted item on submit
		// instead of normal search
		$productSearchForm.on('submit', function (event) {
			var $highlighted = $categoryResults.find('.highlighted');

			if ($highlighted.length > 0) {
				event.preventDefault();
				window.location = $highlighted.find('a').attr('href');
			}
		});
	}

	$body.on('click', function () {
		dismissSearchResults();
	}).find('.category-search-input, .category-search-select').on('click', function (event) {
		event.stopPropagation();
	});

	// Returns a function, that, as long as it continues to be invoked, will not
	// be triggered. The function will be called after it stops being called for
	// N milliseconds. If `immediate` is passed, trigger the function on the
	// leading edge, instead of the trailing.
	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	}
} );
