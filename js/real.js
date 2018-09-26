function filterList(str) {
	console.log("var:"+str);

	var xhttp;

	if (str == "") {
		document.getElementById("filteredList").innerHTML="";
		return;
	}
	xmlhttp=new XMLHttpRequest();

	  xmlhttp.onreadystatechange=function() {
	    if (this.readyState==4 && this.status==200) {
	      document.getElementById("filteredList").innerHTML=this.responseText;
	    }
	  }

	xmlhttp.open("GET", "controller.php?filter="+str, true);
	xmlhttp.send();
}