document.addEventListener('DOMContentLoaded', function () {
		const submitBtn = document.querySelector('input.has-spinner[type="submit"]');
		submitBtn.addEventListener('click', function () {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});

			let form = document.querySelector('form[method="post"]');
			const modal = document.getElementById('successModal');
			form.addEventListener('submit', function (event) {
				event.preventDefault();
				setTimeout(function () {
					form = document.querySelector('form[method="post"]');
					if (form.dataset.status !== 'sent') {
						return;
					}
					modal.style.display = 'block';
					setTimeout(function () {
						modal.style.display = 'none';
					}, 3000);
				}, 3500);
			});
		});
});
