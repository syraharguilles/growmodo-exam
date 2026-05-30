// Theme JS entry file.

document.addEventListener('DOMContentLoaded', () => {
	const banner = document.querySelector('[data-site-banner]');
	const closeButton = document.querySelector('[data-site-banner-close]');

	if (!banner || !closeButton) {
		return;
	}

	closeButton.addEventListener('click', () => {
		banner.hidden = true;
	});
});
