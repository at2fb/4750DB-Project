document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
  });

var e = document.getElementById("position");
var stud = document.getElementById("studentF");
var instr = document.getElementById("instructorF");

function change() {
	var i = e.options[e.selectedIndex].value;
	if(i == 1){
		stud.style.display = "block";
		instr.style.display = "none";
	} else {
		instr.style.display = "block";
		stud.style.display = "none";
	}
}

// console.log("instance is: " + strUser);