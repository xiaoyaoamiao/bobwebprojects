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

function showUser(loadtype) {
	var js_lang = <?php echo json_encode($langs) ?>;
	if (verify_token("t="+js_lang["timeStamp"]+"&r="+js_lang["randomStr"]+"&s="+js_lang["signature"]) == false){
		alert("Not authorization Access!")
		return
	}
	var ticket_no = document.forms['unpark']['addTicket'].value
	if (loadtype != 0){
		if (verify_ticket(ticket_no)){
			ajax_operation("opt=add&q="+ticket_no)
		}
	}
    ajax_operation("opt=&q=")
}


function verify_ticket(ticket_no){
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

function edit_ticket(number, id){
	var input_element = document.getElementById('input_unpark_text' + id);
	var edit_btn_element = document.getElementById('edit_unpark_btn' + number);
	var input_element_status = input_element.disabled;
	if (input_element_status == true) {
		edit_btn_element.value = "Update";
		input_element.disabled = false;
	}else{
		var input_element_value = document.getElementById('input_unpark_text' + id).value;
		if (verify_ticket(input_element_value)){
			ajax_operation("opt=update&q="+input_element_value+"&id="+id)
			edit_btn_element.value = "Edit";
			input_element.disabled = true;
		}
	}
}

function delete_ticket(id){
	var result = confirm("Want to delete?");
	if (result) {
	    //Logic to delete the item
	    ajax_operation("opt=delete&q="+id)
	}
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
<input type="button" value="Add" onclick="showUser()">
<div><a href="tickets_server.php?format=xml">View All Tickets - XML</a></div>
<div><a href="tickets_server.php?format=json">View All Tickets - JSON</a></div>
</form>

<div id="txtHint"><b></b></div>

</body>
</html>