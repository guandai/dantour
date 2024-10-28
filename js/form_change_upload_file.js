document.addEventListener('DOMContentLoaded', function () {
	setTimeout(()=> {
		var fileInput = document.getElementById("file-plan");

		// Create a custom label button
		var label = document.createElement("label");
		label.innerHTML = "上传行程文件";
		label.classList.add("custom-upload-btn");
		
		// Style the label as a button
		label.style.display = "inline-block";
		label.style.padding = "10px 20px";
		label.style.border = "1px solid #000000";
	 label.style.backgroundColor = "#efefef"; // Change this color if needed
		label.style.borderRadius = "5px";
		label.style.cursor = "pointer";
		
		// Hide the original file input
		fileInput.style.display = "none";
		
		// Add event listener to open file dialog when label is clicked
		label.addEventListener("click", function() {
			fileInput.click();
		});
		
		// Append the label next to the input field
		fileInput.parentNode.insertBefore(label, fileInput.nextSibling);
		
		// Optionally, display selected file name
		fileInput.addEventListener("change", function() {
	   var fileName = fileInput.files.length > 0 ? fileInput.files[0].name : "空";
	   label.innerHTML = fileName || fileName !== "空" ? `文件已选择: ${fileName}`  : "上传行程文件";
		});
			
	}, 1000);
});
