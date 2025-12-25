jQuery(document).ready(function ($) {

	function isMobile() {
		return window.matchMedia('(max-width: 768px)').matches;
	}

	$('.strategy-steps li').on('click', function () {

		var target = $(this).data('target');
		var $li = $(this);

		$('.strategy-steps, .strategy-wrapper, .custom-timeline').addClass('is-click');

		if (isMobile()) {

			var $mobileContainer = $li.find('.mobile-content');
			var $contentSource = $('#' + target).clone(true, true);

			$('.strategy-steps li')
				.not($li)
				.removeClass('active')
				.find('.mobile-content')
				.slideUp(200)
				.empty();

			if ($li.hasClass('active')) {
				$li.removeClass('active');
				$mobileContainer.slideUp(200).empty();
				return;
			}

			$li.addClass('active');
			$mobileContainer.html($contentSource).slideDown(250);
			return;
		}

		$('.strategy-steps li').removeClass('active');
		$li.addClass('active');

		$('.strategy-right').removeClass('is-hidden is-open');
		$('.strategy-content').removeClass('active slide-in');

		$('#' + target).addClass('active slide-in');
	});
});
