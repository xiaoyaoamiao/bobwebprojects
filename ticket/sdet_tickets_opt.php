<html>
<head>
<?php
function createNonceStr($length = 8){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return "z".$str;
    }

function arithmetic($timeStamp,$randomStr){
        $arr['timeStamp'] = $timeStamp;
        $arr['randomStr'] = $randomStr;
        $arr['token'] = 'SDETTICKETTOKEN';
        //按照首字母大小写顺序排序
        sort($arr,SORT_STRING);
        //拼接成字符串
        $str = implode($arr);
        //进行加密
        #$signature = sha1($str);
        $signature = md5($signature);
        //转换成大写
        $signature = strtoupper($signature);
        return $signature;
    }

function lang($key){
	$randomstr = createNonceStr();
	$timeStamp = time();
		$lang = array (
		"randomStr" => $randomstr,
		"timeStamp" => $timeStamp,
		"signature" => arithmetic($timeStamp, $randomStr)
		);
		return $lang[$key];
	}

	$language_code_available= array("randomStr", "timeStamp", "signature");
	$langs = array();
	for($i=0; $i <= count($language_code_available) - 1; $i++){
	    $langs[$language_code_available[$i]] = lang($language_code_available[$i]);
		}
?>



<script type="text/javascript">
var temple_edit_ticket_value = "";
function showUser(loadtype) {
	var js_lang = <?php echo json_encode($langs) ?>;
	if (verify_token("t="+js_lang["timeStamp"]+"&r="+js_lang["randomStr"]+"&s="+js_lang["signature"]) == false){
		alert("Not authorization Access!")
		return
	}
	var ticket_no = document.forms['unpark']['addTicket'].value
	var ticket_type = document.forms['unpark']['type'].value
	if (loadtype != 0){
		if (verify_ticket(ticket_no)){
			ajax_operation("opt=add&q="+ticket_no+"&t="+ticket_type)
		}
	}
    ajax_operation("opt=&q=&t=")
}


function verify_ticket(ticket_no=""){
	if (ticket_no == ""){
		alert("Please enter ticket number!")
		return false
	}
	if (isNaN(ticket_no)){
		alert("Please enter numberic ticket number!")
		return false
	}
	return true
}

function edit_ticket(id){
	var input_element = document.getElementById('input_unpark_text' + id);
	var type_element = document.getElementById('type' + id);
	var edit_btn_element = document.getElementById('edit_unpark_btn' + id);
	var input_element_value = document.getElementById('input_unpark_text' + id).value;
	var status_element_value = document.getElementById('type' + id).value;

	if (temple_edit_ticket_value == input_element_value)
		return
	if (verify_ticket(input_element_value)){
		ajax_operation("opt=update&q="+input_element_value+"&id="+id+"&status="+status_element_value)
	}
	
}

function delete_ticket(id=""){
	var result = confirm("Want to delete?");
	if (result) {
	    //Logic to delete the item
	    ajax_operation("opt=delete&q="+id)
	}
}

function entry_ticket(ticketid=""){
	var result = confirm("Want to Entry?");
	if (result) {
	    //Logic to delete the item
	    ajax_operation("opt=entry&ticketid="+ticketid);
	}
}

function edit_text_in(id=""){
	text_element = document.getElementById("input_unpark_text"+id)
	text_element.style.background = "yellow";
	temple_edit_ticket_value = text_element.value;
	
}

function edit_text_out(id=""){
	var ticket_element = document.getElementById("input_unpark_text"+id);
	ticket_element.style.background = "";
	if (!isNaN(id))
		{	
			edit_ticket(id);
		}
}

function edit_textfield_in(id=""){
	document.getElementById(id).style.background = "yellow";
}

function edit_textfield_out(id="",optid=''){
	document.getElementById(id).style.background = "";
	if (!isNaN(optid))
		{	
			var des = document.getElementById(id).value;
			ajax_operation("opt=editdes&ticketid="+optid+"&des="+des);
		}
}

function change_type(id=""){
		select_element = document.getElementById("type"+id).value;
		ajax_operation("opt=changetype&id="+id+"&select_value="+select_element);

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
	        document.getElementById("txtHint").innerHTML = this.responseText;
	    }
    };
    xmlhttp.open("GET","add_unpark_ticket.php?"+parameters,true);
    xmlhttp.send();
}

function verify_token(parameters){
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
	    	if (this.responseText == "1"){
	    		return true
	    	}else{
	    		return false
	    	}
	    	
	    }
    };

    xmlhttp.open("GET","authorization.php?"+parameters,true);
    xmlhttp.send();
}

</script>
</head>
<body onload="showUser(0)">
<br>
<div><h1>Not in Park Tickets</h1></div>
<br>
<form name="unpark">
<input type="text" name="addTicket" required>
<select name="type" required>
	 <option value="a">A</option>
	 <option value="b">B</option>
	 <option value="c">C</option>
	 <option value="d">D</option>
	 <option value="e">E</option>
	 <option value="f">F</option>
	 <option value="g">G</option>
</select>
<input type="button" value="Add" onclick="showUser()">
<div><a href="tickets_server.php?format=xml">View All Tickets - XML</a>
	<?php
	$types = array('a','b','c','d','e','f','g');
		foreach($types as $t){
			echo "<a href=\"tickets_server.php?format=xml&type=".strtolower($t)."\"> -".strtoupper($t)."- </a>";
		}
	 ?>
	</div>
<div><a href="tickets_server.php?format=json">View All Tickets - JSON</a>
<?php
	$types = array('a','b','c','d','e','f','g');
		foreach($types as $t){
			echo "<a href=\"tickets_server.php?format=json&type=".strtolower($t)."\"> -".strtoupper($t)."- </a>";
		}
	 ?></div>
</form>

<div id="txtHint"><b></b></div>

</body>
</html>