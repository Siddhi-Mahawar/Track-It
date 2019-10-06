function createfolder() {

let x=document.getElementById('form1').value;
if(window.XMLHttpRequest)
{
    xmlhttp = new XMLHttpRequest();
} else {
    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        console.log(x);
        location.reload();
    }
}
if(x!=""){
xmlhttp.open('GET','createfolder.php?foldername='+x,true);
xmlhttp.send();
location.reload();}
}


function searchingshows(fold_id) {

    let x=document.getElementById('show_keyword').value;
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var response= xmlhttp.responseText;
            document.getElementById("srchshows").style.display = "initial";
            
            if(response!="")
            {
                document.getElementById('srchshows').innerHTML= xmlhttp.responseText;
                document.getElementById("prevshows").style.display = "none";
                document.getElementById("srchshows").style.display = "initial";
            }
            else{
                if(x==""){
                
                document.getElementById("prevshows").style.display = "initial";
                document.getElementById("srchshows").style.display = "none";
                
            }
                
                document.getElementById('srchshows').innerHTML= "No Result";
                
                
            }
        }
    }
    if(true){
    xmlhttp.open('GET','searchshowfold.php?fold_id='+fold_id+'&keyword='+x,true);
    xmlhttp.send();
    }
}

function addshowtofolder(){
    var x= arguments[0];
    var fold_id = arguments[1];
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            location.reload();
            console.log('addshowtofolder.php?fold_id='+fold_id+'&show_id='+x);
        }
    }
    if(x!=""){
    xmlhttp.open('GET','addshowtofolder.php?fold_id='+fold_id+'&show_id='+x,true);
    xmlhttp.send();
    }
}
    