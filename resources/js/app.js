import './bootstrap';

const root = document.documentElement;
const storedTheme = localStorage.getItem('theme');
const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
const initialTheme = storedTheme || (prefersDark ? 'dark' : 'light');

root.setAttribute('data-theme', initialTheme);

const toggle = document.getElementById('theme-toggle');

if (toggle) {
	const lightLabel = toggle.dataset.light || 'Light mode';
	const darkLabel = toggle.dataset.dark || 'Dark mode';
	const label = toggle.querySelector('.theme-label');

	const setLabel = (theme) => {
		const nextLabel = theme === 'dark' ? darkLabel : lightLabel;
		if (label) {
			label.textContent = nextLabel;
		} else {
			toggle.textContent = nextLabel;
		}
		toggle.setAttribute('aria-pressed', theme === 'dark');
	};

	setLabel(initialTheme);

	toggle.addEventListener('click', () => {
		const current = root.getAttribute('data-theme');
		const next = current === 'dark' ? 'light' : 'dark';
		root.setAttribute('data-theme', next);
		localStorage.setItem('theme', next);
		setLabel(next);
	});
}
