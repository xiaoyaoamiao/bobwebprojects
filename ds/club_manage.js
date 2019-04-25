function add_club() {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		ajax_operation("opt=add&club_name="+club_name+"&captain_name="+captain_name+"&t=club")
	}
function delete_club(club_id) {
		var club_id = club_id
		ajax_operation("opt=delete&club_id="+club_id+"&t=club")
	}
function edit_club(club_id) {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		var credibility = document.forms['club_management']['credibility'].value
		ajax_operation("opt=edit&club_name="+club_name+"&captain_name="+captain_name+"&credibility="+credibility+"&t=club")
	}
function add_player() {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		ajax_operation("opt=add&club_name="+club_name+"&captain_name="+captain_name+"&t=player")
	}
function delete_player(player_id) {
		var club_id = club_id
		ajax_operation("opt=delete&club_id="+club_id+"&t=player")
	}
function edit_player(player_id) {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		var credibility = document.forms['club_management']['credibility'].value
		ajax_operation("opt=edit&club_name="+club_name+"&captain_name="+captain_name+"&credibility="+credibility+"&t=player")
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