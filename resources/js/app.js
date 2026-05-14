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

	const setLabel = (theme) => {
		const nextLabel = theme === 'dark' ? darkLabel : lightLabel;
		toggle.setAttribute('aria-label', nextLabel);
		toggle.setAttribute('title', nextLabel);
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

const pageLoader = document.getElementById('page-loader');

if (pageLoader) {
	window.addEventListener('load', () => {
		pageLoader.classList.add('is-hidden');
		setTimeout(() => {
			pageLoader.remove();
		}, 500);
	});
}

const toasts = document.querySelectorAll('[data-toast]');

toasts.forEach((toast) => {
	const closeButton = toast.querySelector('[data-toast-close]');
	let dismissed = false;

	const dismiss = () => {
		if (dismissed) {
			return;
		}
		dismissed = true;
		toast.classList.add('is-hidden');
		setTimeout(() => {
			toast.remove();
		}, 250);
	};

	if (closeButton) {
		closeButton.addEventListener('click', dismiss);
	}

	setTimeout(dismiss, 5000);
});

const projectModal = document.getElementById('project-modal');

if (projectModal) {
	const openButtons = document.querySelectorAll('[data-modal-open="project-modal"]');
	const closeButtons = projectModal.querySelectorAll('[data-modal-close]');
	const steps = Array.from(projectModal.querySelectorAll('.modal-step'));
	const nextButton = projectModal.querySelector('[data-step-next]');
	const prevButton = projectModal.querySelector('[data-step-prev]');
	const submitButton = projectModal.querySelector('[data-step-submit]');
	let currentStep = 0;

	const updateSteps = () => {
		steps.forEach((step, index) => {
			step.classList.toggle('is-active', index === currentStep);
		});
		if (prevButton) {
			prevButton.disabled = currentStep === 0;
		}
		if (nextButton) {
			nextButton.style.display = currentStep < steps.length - 1 ? '' : 'none';
		}
		if (submitButton) {
			submitButton.style.display = currentStep === steps.length - 1 ? '' : 'none';
		}
	};

	const openModal = () => {
		projectModal.classList.add('is-open');
		document.body.classList.add('modal-open');
		currentStep = 0;
		updateSteps();
	};

	const closeModal = () => {
		projectModal.classList.remove('is-open');
		document.body.classList.remove('modal-open');
	};

	openButtons.forEach((button) => {
		button.addEventListener('click', openModal);
	});

	closeButtons.forEach((button) => {
		button.addEventListener('click', closeModal);
	});

	projectModal.addEventListener('click', (event) => {
		if (event.target === projectModal) {
			closeModal();
		}
	});

	if (nextButton) {
		nextButton.addEventListener('click', () => {
			currentStep = Math.min(currentStep + 1, steps.length - 1);
			updateSteps();
		});
	}

	if (prevButton) {
		prevButton.addEventListener('click', () => {
			currentStep = Math.max(currentStep - 1, 0);
			updateSteps();
		});
	}

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && projectModal.classList.contains('is-open')) {
			closeModal();
		}
	});
}
