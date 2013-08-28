	var oldpwd = false;
  var newpwd = false;
  document.getElementById('change').disabled = true;

	function checkFields(){
  		if (newpwd){
    		document.getElementById('change').disabled = false;
  		} else {
   			document.getElementById('change').disabled = true;
  		}
  	}

 	function checkNewPwd(){
  		if(document.getElementById('newpwd').value != document.getElementById('newpwdagain').value){
  			document.getElementById('newcor').style.color = 'red';
    		document.getElementById('newcor').innerHTML = 'not the same as above!';
    		newpwd = false;
  		} else{
  			document.getElementById('newcor').style.color = 'green';
    		document.getElementById('newcor').innerHTML = 'correct!';
    		newpwd = true;
  		}
      checkFields();
  	}

  function checkPwd(session){ 
      if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
      } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          document.getElementById("cor").innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","/webeng/admin/user/getpwd.php?session="+session+"&pwd="+document.getElementById("oldpwd").value,true);
      xmlhttp.send();
      checkFields();
  }