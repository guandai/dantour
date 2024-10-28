document.addEventListener('DOMContentLoaded', function() {
	let dayCount = 1; 
	const posDayField = document.getElementById('day_city_group');
	const buttonWrapper = document.createElement('div');
	buttonWrapper.style.display = 'flex';
	buttonWrapper.style.justifyContent  = 'start';
			var style = document.createElement('style');
			document.head.appendChild(style);
			var sheet = style.sheet;
       sheet.insertRule(`
					.day-btn {
						 max-width: 200px; 
						 border-radius: 12px; 
						 font-size: 30px; 
						 boarder-size: 1px solid #888888;
						 boarder: 1px solid #888888;
						 margin: 10px;
						 font-size: 16px;
					}
			`, sheet.cssRules.length);



	const addDayBtn = document.createElement('button');
	addDayBtn.type = 'button';
	addDayBtn.id = 'add-day-btn';
	addDayBtn.className = 'add-day-btn day-btn';
	addDayBtn.textContent = '+ 添加行程';
	buttonWrapper.append(addDayBtn);
	
	const removeBtn = document.createElement('button');
	removeBtn.type = 'button';
	removeBtn.id = 'remove-day-btn';
	removeBtn.className = 'remove-day-btn day-btn';
	removeBtn.textContent = '- 删除行程';
	buttonWrapper.append(removeBtn);
	
	posDayField.insertAdjacentElement('afterend', buttonWrapper);

	function addDayCityField() {
		dayCount++;
		const template = document.querySelector('#day_city_group').children[0];
		const dayDiv = document.createElement('div');
		dayDiv.className = `row-group day_city_group_${dayCount}`;
		dayDiv.id = `day_city_group_${dayCount}`;  
		const newHtml = template.innerHTML.replace(/day_city_(\w*)_1/g, `day_city_$1_${dayCount}`)
			.replaceAll('第1天', `第${dayCount}天`);

		dayDiv.innerHTML = newHtml;

		posDayField.append(dayDiv);
		removeBtn.disabled=(!!(dayCount<=0))
	}
	removeBtn.addEventListener('click', function() {
			document.querySelector(`.day_city_group_${dayCount}`).remove(); 
			dayCount--;
			removeBtn.disabled=(!!(dayCount<=1))
	});
	addDayBtn.addEventListener('click', addDayCityField);
});

