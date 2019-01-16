document.querySelector('[data-menu-target]').addEventListener('click', () => {
	document.querySelector('.menu-container').classList.add('active')
});

document.querySelector('[data-menu-close]').addEventListener('click', () => {
	document.querySelector('.menu-container').classList.remove('active')
})