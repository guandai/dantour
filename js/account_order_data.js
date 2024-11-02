document.addEventListener('DOMContentLoaded', function () {
	setTimeout(async () => {
			const links = document.querySelectorAll('.um-account-name .um-account-profile-link a.um-link');
			links.forEach((link) => {
					const href = link.href;

					const anchor = document.createElement('a');
					anchor.href = `${href}/?um_action=edit`;
					anchor.classList.add('um-link');
					anchor.textContent = '编辑资料';

					// Append the div to the link's parent element
					link.parentElement.append(anchor);
			});

			// Insert the new LI element into the UL
			targetUl.appendChild(getBookingSidebarBtn());

			// Load the account tab content
			await loadAccountTabContent();

			document.querySelectorAll('a[href="javascript:void(0);"]').forEach(anchor => {
					anchor.addEventListener('click', event => event.preventDefault());
			});

			// After all setup is done, check the URL to activate the correct tab
			checkAndActivateTabBasedOnURL();
	}, 0);

	const targetUl = document.querySelector('.um-account-side ul');

	function getBookingSidebarBtn() {
			// Create the new LI element with the provided structure
			const newLi = document.createElement('li');
			newLi.innerHTML = `
					<a data-tab="general" href="javascript:void(0);" class="um-account-link current">
							<span class="um-account-icontip uimob800-show um-tip-w" original-title="订单">
									<i class="um-faicon-user"></i>
							</span>
							<span class="um-account-icon uimob800-hide">
									<i class="um-faicon-user"></i>
							</span>
							<span class="um-account-title uimob800-hide">订单</span>
							<span class="um-account-arrow uimob800-hide">
									<i class="um-faicon-angle-right"></i>
							</span>
					</a>
			`;

			// Attach the click event to the new LI's anchor link
			const newLink = newLi.querySelector('a');

			newLink.addEventListener('click', () => {
					document.querySelectorAll('.um-account-tab').forEach(anchor => {
							anchor.style.display = 'none';
					});
					document.querySelector('#booking-tab-list').style.display = 'block';

					// Update the browser history
					history.pushState(null, '', '/account/orders');
			});

			return newLi;
	}

	// Define the function to load content and insert it into .um-account-tab-general
	const loadAccountTabContent = async () => {
			try {
					const response = await fetch('/wp-admin/admin-ajax.php', {
							method: 'POST',
							headers: {
									'Content-Type': 'application/x-www-form-urlencoded'
							},
							body: new URLSearchParams({
									action: 'load_account_tab_content',
									args: JSON.stringify({ /* Add any required args */ })
							})
					});

					if (response.ok) {
							const content = await response.text();
							const account_main = document.querySelector('.um-account-main');
							account_main?.append(getBookingBeforeHtml());
							account_main?.append(getBookingHtml(content));
					} else {
							console.error('Failed to load content');
					}
			} catch (error) {
					console.error('Error loading content:', error);
			}
	};

	function getBookingHtml(content) {
			const div = document.createElement('div');
			div.classList.add('um-account-tab', 'um-account-tab-booking');
			div.dataset.tab = 'booking';
			div.id = 'booking-tab-list';
			div.style.display = 'none';
			div.innerHTML = content;
			return div;
	}

	function getBookingBeforeHtml() {
			// Create the main div
			const div = document.createElement('div');
			div.classList.add('um-account-nav', 'uimob340-show', 'uimob500-show');

			// Create the anchor element
			const anchor = document.createElement('a');
			anchor.href = '#';
			anchor.dataset.tab = 'booking'; // Set data-tab attribute

			// Add text to the anchor
			anchor.textContent = '订单记录';

			// Create the first span with icon
			const spanIcon = document.createElement('span');
			spanIcon.classList.add('ico');

			// Create the i element inside the first span
			const icon = document.createElement('i');
			icon.classList.add('um-faicon-trash-o');

			// Append the i element to the first span
			spanIcon.appendChild(icon);

			// Create the second span with arrow
			const spanArr = document.createElement('span');
			spanArr.classList.add('arr');

			// Create the i element inside the second span
			const arrow = document.createElement('i');
			arrow.classList.add('um-faicon-angle-down');

			// Append the i element to the second span
			spanArr.appendChild(arrow);

			// Append spans to the anchor
			anchor.appendChild(spanIcon);
			anchor.appendChild(spanArr);

			return div;
	}

	// Function to check the URL and activate the appropriate tab
	function checkAndActivateTabBasedOnURL() {
			if (window.location.pathname === '/account/orders') {
					// Activate the '订单' tab
					document.querySelectorAll('.um-account-tab').forEach(anchor => {
							anchor.style.display = 'none';
					});
					document.querySelector('#booking-tab-list').style.display = 'block';
			}
	}

	// Listen for popstate events to handle back/forward navigation
	window.addEventListener('popstate', () => {
			checkAndActivateTabBasedOnURL();
	});
});
