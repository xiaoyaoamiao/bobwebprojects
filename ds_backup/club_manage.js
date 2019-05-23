function add_club() {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		ajax_operation("opt=add&club_name="+club_name+"&captain_name="+captain_name)
	}
function delete_club(club_id) {
		var club_id = club_id
		ajax_operation("opt=delete&club_id="+club_id)
	}
function edit_club(club_id) {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		var credibility = document.forms['club_management']['credibility'].value
		ajax_operation("opt=edit&club_name="+club_name+"&captain_name="+captain_name+"&credibility="+credibility)
	}	
		
function ajax_operation(parameters){
	if (window.XMLHttpRequest) {
	    	// code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp = new XMLHttpRequest();
		} 
	else{
		    // code for IE6, IE5
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
    xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("content").innerHTML = this.responseText;
	    }
    };
    xmlhttp.open("GET","player_manage.php?"+parameters,true);
    xmlhttp.send();
}