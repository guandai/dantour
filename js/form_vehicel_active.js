document.addEventListener('DOMContentLoaded', function () {
	function setActive(inputs) {
		inputs.forEach(b => {
			b.addEventListener('click', () => {
				inputs.forEach(x => {
					x.parentElement.classList.remove('active');
					x.classList.remove('active');
				});
				b.parentElement.classList.add('active');
				b.classList.add('active');
			});
		});
	}
	
	setTimeout(() => {
		const bigTypeInputs = document.querySelectorAll('#book-big-type label input');
		setActive(bigTypeInputs);
	
		const bigInputs = document.querySelectorAll('#book-type label input');
		setActive(bigInputs);
	}, 1000);	
});
