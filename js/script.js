/* increment button*/

let count = 0;
const button = document.getElementById("ajouter");
const text = document.getElementById("count");
text.innerHTML = count;

button.addEventListener("count", function() {
	// body... 
	text.innerHTML= ++count;
});

/**/