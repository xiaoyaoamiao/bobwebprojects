function add_club() {
		var club_name = document.forms['club_management']['club_name'].value
		var captain_name = document.forms['club_management']['captain_name'].value
		ajax_operation("opt=add&club_name="+club_name+"&captain_name="+captain_name+"&t=club")
	}

function delete_club(club_id) {
		var result = confirm("Want to delete?");
		if (result) {
			ajax_operation("opt=delete&club_id="+club_id+"&t=club")
		}
	}

function edit_club(id){
	var club_element = document.getElementById('club' + id);
	var captain_element = document.getElementById('captain' + id);
	var credibility_element = document.getElementById('credibility' + id);
	var edit_btn_element = document.getElementById('edit_club_btn' + id); 
	var club_element_status = club_element.disabled;
	if (club_element_status == true) {
		edit_btn_element.value = "Update";
		club_element.disabled = false;
		captain_element.disabled = false;
		credibility_element.disabled = false;
		club_element.className = "player_input_list_edit";
		captain_element.className = "player_input_list_edit";
		credibility_element.className = "player_input_list_edit";
	}else{
		var club_name = club_element.value
		var captain_name = captain_element.value
		var credibility = credibility_element.value
		if (verify_tcredibility(credibility)){
			edit_btn_element.value = "Edit";
			club_element.disabled = true;
			captain_element.disabled = true;
			credibility_element.disabled = true;
			club_element.className = "player_input_list";
			captain_element.className = "player_input_list";
			credibility_element.className = "player_input_list";
			ajax_operation("opt=update&club_name="+club_name+"&captain_name="+captain_name+"&credibility="+credibility+"&t=club&id="+id)
		}
	}
}

function verify_tcredibility(credibility){
	if (credibility == ""){
		alert("Please enter credibility number!")
		return false
	}
	if (isNaN(credibility)){
		alert("Please enter numberic credibility number!")
		return false
	}
	return true
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
		ajax_operation("opt=update&club_name="+club_name+"&captain_name="+captain_name+"&credibility="+credibility+"&t=player")
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