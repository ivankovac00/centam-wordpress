/**
 * CENTAM theme behaviour.
 *
 * Whole news card is clickable, like on the static site. The "Read More →"
 * link stays the real, keyboard-focusable link; a click anywhere else on the
 * card follows it. Clicks on other links (e.g. the category tag) and text
 * selections are left alone.
 */
(function () {
	document.querySelectorAll('.centam-card--news').forEach(function (card) {
		var link = card.querySelector('a.wp-block-read-more');
		if (!link) {
			return;
		}
		card.classList.add('is-clickable');
		card.addEventListener('click', function (event) {
			if (event.target.closest('a') || String(window.getSelection())) {
				return;
			}
			if (event.metaKey || event.ctrlKey) {
				window.open(link.href, '_blank', 'noopener');
				return;
			}
			window.location.href = link.href;
		});
	});
})();
