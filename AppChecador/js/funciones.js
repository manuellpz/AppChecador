setInterval(function(){tiempo();},1000);

function tiempo()
{
	var time = new Date();
	var h = time.getHours();
	var m = time.getMinutes();
	var s = time.getSeconds();
	var hora = document.getElementById("hora");
    var min = document.getElementById("min");
    var seg = document.getElementById("seg");
    
    if(m<10)
    {
        m = "0"+m;        
    }
    if(s<10)
    {
        s = "0"+s;
    }
    
    /*Se llenan los span*/
	hora.innerHTML = h;
    min.innerHTML = m;
    seg.innerHTML = s;
    
    /*Se llenan los campos de texto con el valor del span*/
    document.getElementById("h").value = h;
    document.getElementById("m").value = m;
    document.getElementById("s").value = s;
    
    
}


var btnLogin = document.getElementById("btnLogin");
btnLogin.addEventListener("click",function(){
   window.location.href = "loginadmin.php"; 
});