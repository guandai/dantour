document.addEventListener('DOMContentLoaded', function() {
	
	setTimeout( () => {
		if (window.wpUserData) {
			document.querySelector('.menu_user_login').remove();
		} else {
			document.querySelector('.menu_user_edit').remove();
			document.querySelector('.menu_user_history').remove();
			document.querySelector('.menu_user_logout').remove();
		}
	}, 1000 );
});

//menu_user_profile
