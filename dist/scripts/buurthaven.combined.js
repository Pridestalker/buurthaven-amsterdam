window.addEventListener("scroll", () => {
	let header = document.querySelector('header[data-sticky="header"]')

	let sticky = header.offsetTop

	if( window.pageYOffset > sticky ) {
		header.classList.add('fixme')
	} else {
		header.classList.remove('fixme')
	}
})