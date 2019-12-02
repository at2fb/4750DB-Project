//ul in html
var sections = document.getElementById('sections');

//adds the section(li) to ul in html
function add(){

	//li of section that the user inputs
	var indivSection = document.createElement("li");

	//content consis of sectionID & delete button
	var content = document.createElement('div');
	var deleteBtn = document.createElement("button");

	content.innerHTML = document.getElementById('userInput').value;
	deleteBtn.innerText = 'delete';

	//appen the li to the ul
	indivSection.appendChild(content);
	indivSection.appendChild(deleteBtn);
	document.getElementById('sections').appendChild(indivSection);

	//delete the entry in the input box
	document.getElementById('userInput').value = '';


};


//removes the section(li) when click on the delete button
$("ul").on("click", "button", function(e) {
    e.preventDefault();
    $(this).parent().remove();
});