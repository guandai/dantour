document.addEventListener('DOMContentLoaded', function () {
	function assignUserData () {
		const el = document.querySelector('.contact-form .contact-info');
		el.querySelector('.wechat_name').value = wpUserData.wechat_name;
		el.querySelector('.phone_number').value = wpUserData.phone_number;
		el.querySelector('.username').value = wpUserData.username;
		el.querySelector('.email').value = wpUserData.email;
	}
	
	setTimeout(() => {
		assignUserData();
		const submit = document.querySelector('input.wpcf7-form-control[type="submit"]');
		submit.addEventListener('click', ()=> {
			setTimeout(() => {
				assignUserData();
			}, 4000)
		} ) 
	}, 2000);
});
