function saveChanges(){
    var HTMLtbl  =
      {
          getData: function (table) {
              var data = [];
              table.find('tr').not(':first, :last').each(function (rowIndex, r) {
                  var cols = [];
                  $(this).find('td').each(function (colIndex, c) {
                      	if ($(this).text().length > 0){
                      		var textcontent = $(this).text().trim();
							textcontent=textcontent.replace(/\r?\n|\r/g, "");
							textcontent = textcontent.replace(/ /g,'');
							cols.push(textcontent);
                      	}
                  });
                  cols.push('separatechr');
                  data.push(cols);
              });
              return data;
          }
      }

    var data = HTMLtbl.getData($('#data_table'));  // passing that table's ID //
    var parameters = {};
    parameters.array = data;

    if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
        request = new XMLHttpRequest();
    } else {
	    // code for IE6, IE5
        request = new ActiveXObject("Microsoft.XMLHTTP");
	}

    request.open("GET", "saveTriggers.php?data="+data, false);

    request.send();
    swal({
        title: "Congratulation!",
        text: "your changes is applied successfully",
        timer: 3000,
        showConfirmButton: false
    });
    document.getElementById('savechange').style.pointerEvents = 'none';
}

function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="inline-block";
	
 var name=document.getElementById("name_row"+no);
 var distance=document.getElementById("distance"+no);
 var frole=document.getElementById("frole"+no);
 var timeofday=document.getElementById("timeofday"+no);
 var lrole=document.getElementById("lrole"+no);
 var delay=document.getElementById("delay"+no);
			
 var name_data=name.innerHTML;
 var distance_data=distance.innerHTML;
 var delay_data=delay.innerHTML;
 var frole_data=frole.innerHTML;
 var timeofday_data=timeofday.textContent.replace(/\r?\n|\r/g, "");
 timeofday_data = timeofday_data.replace(/ /g,'');

 var lrole_data=lrole.innerHTML;

 name.innerHTML="<input type='text' id='name"+no+"' value='"+name_data+"'>";
 if(frole_data == "AND"){
 	frole.innerHTML = "<td id=\"frole"+no+"\"><select id=\"new12role"+no+"\"><option value=\"AND\" selected>AND</option><option value=\"OR\">OR</option></select></td>";
 } else if(frole_data == "OR"){
 	frole.innerHTML = "<td id=\"frole"+no+"\"><select id=\"new12role"+no+"\"><option value=\"AND\">AND</option><option value=\"OR\" selected>OR</option></select></td>";
 }
 if(lrole_data == "AND"){
	lrole.innerHTML = "<td id=\"lrole"+no+"\"><select id=\"new23role"+no+"\"><option value=\"AND\" selected>AND</option><option value=\"OR\">OR</option></select></td>";
 } else if(lrole_data == "OR"){
 	lrole.innerHTML = "<td id=\"lrole"+no+"\"><select id=\"new23role"+no+"\"><option value=\"AND\">AND</option><option value=\"OR\" selected>OR</option></select></td>";
 }
 distance.innerHTML="<input type='text' id='dist"+no+"' value='"+distance_data+"'>";
 delay.innerHTML="<input type='text' id='dly"+no+"' value='"+delay_data+"'>";
 timerows = timeofday_data.length/5;
 var innerHTML="";
 var start = 0; 
 var end = 5;
 var i = 0;
if(timeofday_data.length % 5 == 0){
	for(i=1;i<timerows+1;i++){
		timevalue = timeofday_data.substring(start, end);
	 	start = start + 5; 
	 	end = end + 5;
	 	id = "time" + no + i;
	 	innerHTML += "<label id=\""+id+"\" name=\""+id+"\">"+timevalue+"</label><a name=\"minus"+no+i+"\" id=\"minus"+no+i+"\" class=\"btn btn-link\" onclick=\"delete_time("+no+i+")\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></a><br>";
	}
}
innerHTML += "<input type=\"time\" id=\"time"+no+i+"\" name=\"time"+no+i+"\"><a class=\"btn btn-link\" onclick=\"add_time("+no+")\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>";;
timeofday.innerHTML=innerHTML;

 document.getElementById('savechange').style.pointerEvents = 'auto';
 }

function save_row(no)
{
 var new_name=document.getElementById("name"+no).value;
 var new_distance=document.getElementById("dist"+no).value;
 var new_frole=document.getElementById("new12role"+no);
 var frole = new_frole.options[new_frole.selectedIndex].text;
 var new_lrole=document.getElementById("new23role"+no);
 var lrole = new_frole.options[new_lrole.selectedIndex].text;
 var new_delay=document.getElementById("dly"+no).value;
 var innerText=document.getElementById("timeofday"+no).innerText.replace(/\r?\n|\r/g, "");
 innerText = innerText.replace(/ /g,'');
 document.getElementById("name_row"+no).innerHTML = new_name;
 document.getElementById("distance"+no).innerHTML = new_distance;
 document.getElementById("frole"+no).innerHTML = frole;
 document.getElementById("lrole"+no).innerHTML = lrole;
 document.getElementById("delay"+no).innerHTML = new_delay;


 var table=document.getElementById("data_table");
 var table_len=no;

 str = innerText.match(/.{1,5}/g);
 timecell = "<td id=\"timeofday"+table_len+"\" name=\"timeofday"+table_len+"\">";
 for (i=0;i<str.length;i++){
 	timecell += "<label id=\"time"+table_len+i+"\" name=\"time"+table_len+i+"\">"+str[i]+"</label><br>";
 }
 timecell += "</td>";
 document.getElementById("timeofday"+no).outerHTML = timecell;

 document.getElementById('savechange').style.pointerEvents = 'auto';
 document.getElementById("edit_button"+no).style.display="inline-block";
 document.getElementById("save_button"+no).style.display="none";
}

function delete_row(no){
 document.getElementById("row"+no+"").outerHTML="";
 document.getElementById('savechange').style.pointerEvents = 'auto';
}

function add_row(){
 var new_name=document.getElementById("new_name").value;
 var new_distance=document.getElementById("new_distance").value;
 var new_frole=document.getElementById("newfrole");
 var frole = new_frole.options[new_frole.selectedIndex].text;
 var new_lrole=document.getElementById("newlrole");
 var lrole = new_frole.options[new_lrole.selectedIndex].text;
 var new_delay=document.getElementById("new_delay").value;
 var innerText=document.getElementById("timeofday100").innerText.replace(/\r?\n|\r/g, "");
 innerText = innerText.replace(/ /g,'');
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;

 str = innerText.match(/.{1,5}/g);
 timecell = "<td id=\"timeofday"+table_len+"\" name=\"timeofday"+table_len+"\">";
 for (i=0;i<str.length;i++){
 	timecell += "<label id=\"time"+table_len+i+"\" name=\"time"+table_len+i+"\">"+str[i]+"</label><br>";
 }
 timecell += "</td>";
 /*var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='name_row"+table_len+"'>"+new_name+"</td><td id='country_row"+table_len+"'>"+new_country+"</td><td id='age_row"+table_len+"'>"+new_age+"</td><td><input type='button' id='edit_button"+table_len+"' value='Edit' class='edit' onclick='edit_row("+table_len+")'> <input type='button' id='save_button"+table_len+"' value='Save' class='save' style=\"display:none\"onclick='save_row("+table_len+")'> <input type='button' value='Delete' class='delete' onclick='delete_row("+table_len+")'></td></tr>";*/

 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='name_row"+table_len+"'>"+new_name+"</td><td id='distance"+table_len+"'>"+new_distance+"</td><td id='frole"+table_len+"'>"+frole+"</td>"+timecell+"<td id='lrole"+table_len+"'>"+lrole+"</td><td id='delay"+table_len+"'>"+new_delay+"</td><td><a id='edit_button"+table_len+"' class=\"btn btn-link\" onclick='edit_row("+table_len+")'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a><a id='save_button"+table_len+"' class=\"btn btn-link\" onclick='save_row("+table_len+")' style=\"display:none\"><i class=\"fa fa-floppy-o\" aria-hidden=\"true\"></i></a><a class=\"btn btn-link\" onclick='delete_row("+table_len+")'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td></tr>";

 document.getElementById("new_name").value="";
 document.getElementById("new_distance").value="";
 document.getElementById("new_delay").value="";
 document.getElementById("timeofday100").outerHTML="<td id=\"timeofday100\" name=\"timeofday100\">"+"<input type=\"time\" id=\"time1001\" name=\"time1001\"><a id=\"minus1001\" class=\"btn btn-link\" onclick=\"add_time(100)\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>";

 document.getElementById('savechange').style.pointerEvents = 'auto';
}

function delete_time(no){
	var removeid = "time" + no;

	var removerow = document.getElementById(removeid);

	removerow.parentNode.removeChild(removerow);
	var removebtn = "minus" + no;
	var removerow = document.getElementById(removebtn);
	if(removerow.nextSibling.tagName == "BR")
		removerow.nextSibling.remove();

	removerow.parentNode.removeChild(removerow);
}

function add_time(no){
	var parentNode;
	var parentNodeId = "timeofday" + no;
	parentNode = document.getElementById(parentNodeId);
	var child = parentNode.children;
	var length = child.length;
	var innerHTML = "";
	var id = "";
	var j = 0;
	var k = 0;
	if(length>3){
		for(i=1;i<length/3+1;i++){
			k = i + j;
			id = "time" + no + k;
			//alert(length/3+1);
			//alert(k);
			while(!document.getElementById(id)){
				j++;
				k = i + j;
				id = "time" + no + k;
			}
			if (document.getElementById(id).tagName == "INPUT"){
				timevalue = document.getElementById(id).value;
				if(document.getElementById(id).value == ""){
					break;
				}
			}
			else if (document.getElementById(id).tagName == "LABEL"){
				timevalue = document.getElementById(id).textContent;
			}
			innerHTML += "<label id=\""+id+"\" name=\""+id+"\">"+timevalue+"</label><a id=\"minus"+no+k+"\" class=\"btn btn-link\" onclick=\"delete_time("+no+k+")\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></a><br>";
			//alert(innerHTML);
		}
		k++;
		innerHTML += "<input type=\"time\" id=\"time"+no+k+"\" name=\"time"+no+k+"\"><a class=\"btn btn-link\" onclick=\"add_time("+no+")\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>";
	} else {
		i = 1;
		id = "time" + no + i;
		while(!document.getElementById(id)){
			i++;
			id = "time" + no + i;
		}
		timevalue = document.getElementById(id).value;
		if(document.getElementById(id).value == "")
			innerHTML += "<input type=\"time\" id=\"time"+no+"1\" name=\"time"+no+"1\"><a id=\"time"+no+"1\" class=\"btn btn-link\" onclick=\"add_time("+no+")\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a><br>";
		else{
			innerHTML += "<label id=\"time"+no+"1\" name=\"time"+no+"1\">"+timevalue+"</label><a id=\"minus"+no+"1\" class=\"btn btn-link\" onclick=\"delete_time("+no+"1)\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></a><br>";
			innerHTML += "<input type=\"time\" id=\"time"+no+"2\" name=\"time"+no+"2\"><a class=\"btn btn-link\" onclick=\"add_time("+no+")\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i></a>";
		}
	}
	parentNode.innerHTML = innerHTML;
}
