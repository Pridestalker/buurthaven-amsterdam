window.addEventListener("scroll", () => {
	let header = document.querySelector('header[data-sticky="header"]')

	let sticky = header.offsetTop

	if( window.pageYOffset > sticky ) {
		header.classList.add('fixme')
		document.querySelector('.main').classList.add('header_fixed')
	} else {
		header.classList.remove('fixme')
		document.querySelector('.main').classList.remove('header_fixed')
	}
})
document.querySelector('[data-menu-target]').addEventListener('click', function () {
	document.querySelector('.menu-container').classList.add('active')
});