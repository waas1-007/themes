jQuery(document).ready(function () {
	// SUBMIT AJAX REQUEST FOR ADD TO CART.
	jQuery(".single_add_to_cart_button").on("click", function (e) {
		e.preventDefault();
		$thisbutton = $(this);
		$form = $thisbutton.closest('form.cart');
		id = $thisbutton.val();
		product_qty = $form.find('input[name=quantity]').val() || 1;
		product_id = $form.find('input[name=product_id]').val() || id;
		variation_id = $form.find('input[name=variation_id]').val() || 0;
		var data = {
			action: 'ql_woocommerce_ajax_add_to_cart',
			product_id: product_id,
			product_sku: '',
			quantity: product_qty,
			variation_id: variation_id,
		};
		console.log(data);
		$.ajax({
			type: 'post',
			url: wc_add_to_cart_params.ajax_url,
			data: data,
			beforeSend: function (response) {
				$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				$thisbutton.addClass('added').removeClass('loading');
			},

			success: function (response) {

				if (response.error & response.product_url) {
					swal({
						title: "Oh No!",
						text: "Sorry, some error occurred. Please try again.",
						icon: "error",
					});
				} else {
					$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
					console.log(response.fragments);
					var tl = new TimelineLite({
						paused: true,
						reversed: true
					});
					tl.fromTo(
						".mobile-slider",
						0.3, {
						x: 200,
						autoAlpha: 0
					}, {
						x: 0,
						autoAlpha: 1,
						ease: Power4.easeOut
					}
					);
					tl.to(
						".filter",
						0.3, {
						autoAlpha: 1
					},
						0
					);
					tl.play();
					$(".close-menu").click(function () {
						tl.reverse();
					});
					// Also close slider when clicking outside of the menu
					$(".filter").click(function () {
						tl.reverse();
					});
				}
			},
		});
	});
});
