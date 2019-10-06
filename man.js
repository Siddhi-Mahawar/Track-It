
var name="";
var id="";
var genre = "";
var total = 0;
var s = "";
// This function is used to search for the series by the name of the series

function getseries() {

let x=document.getElementById('seriesname').value;
if(window.XMLHttpRequest)
{
    xmlhttp = new XMLHttpRequest();
} else {
    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
}
xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        myObj = JSON.parse(this.responseText);
        name =myObj.Title;
        id = myObj.imdbID;
        genre = myObj.Genre;
        s = myObj.Poster;
        console.log(myObj);
        // This is used to display the image and name of the tv show searched by the user
        document.getElementById('headSeriesName').innerHTML=myObj.Title+'('+myObj.Year+'):'+'('+myObj.Type+')';
        document.getElementById('seriesimg').src=myObj.Poster;
        if(myObj.Response=="False")
        {
            document.getElementById('headSeriesName').innerHTML="Not Available";
            document.getElementById('seriesimg').src="img/avtar.jpg";    
        }
        if(x=="")
        { 
            document.getElementById('headSeriesName').innerHTML="Series Name";
            document.getElementById('seriesimg').src="img/avtar.jpg";
        }
    }
}

xmlhttp.open('GET','http://www.omdbapi.com/?t='+x+'&apikey=91d69910',true);
xmlhttp.send();
}


// This function showresult() is used to open the tv show page after inserting in the tv shows added by the user
function showresult()
{
    console.log(s);
    var datastring = 'name='+ name + '&id=' +id+'&genre='+genre+'&s='+s;
    console.log(datastring);

    $.ajax({
                    type: "POST",
                    url: 'name1.php',
                    data: datastring,
                    success: function(data)
                    {
                        console.log(data);
                        window.location = "http://localhost/Tvtracker/tv_show.php?t="+id;
                    }
                });
}

function showresult2(name,id,genre,s)
{
    var datastring = 'name='+ name + '&id=' +id+'&genre='+genre+'&s='+s;
    console.log(datastring);

    $.ajax({
                    type: "POST",
                    url: 'name1.php',
                    data: datastring,
                    success: function(data)
                    {
                        console.log(data);
                        // alert("hey");
                        // window.location = "http://localhost/TvTracker/tv_show.php?t="+id;
                    }
                });
}
   
function addresult(id)
{
    console.log(id);
    
    var datastring = 'id=' +id;
    console.log(datastring);

    $.ajax({
                    type: "POST",
                    url: 'name.php',
                    data: datastring,
                    success: function(data)
                    {
                        window.location = "http://localhost/Tvtracker/tv_show.php?t="+id;
                    }
                });
}


function removeresult(id)
{
    console.log(id);
    
    var datastring = 'id=' +id;
    console.log(datastring);

    $.ajax({
                    type: "POST",
                    url: 'remove.php',
                    data: datastring,
                    success: function(data)
                    {
                        window.location = "http://localhost/Tvtracker/tv_show.php?t="+id;
                    }
                });
}

//  this function is used to get the details of the tv show and to get the number of seasons of the series 
function getseason(show_id,show_name,a) {

    var no_of_seasons = "";
    
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            no_of_seasons = myObj.totalSeasons;

            document.getElementById('seriesbackground').style.background = "url('"+myObj.Poster+"')";

                if(a!='-')
                {
                    showseasons(1,show_id,no_of_seasons,a);
                }
        }
    }
    
    
    xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_name+'&apikey=91d69910',true);
    xmlhttp.send();
    
}


// This function is used to get the details of a particular episode of a tv show added by the user
function showseason(season_no,show_id,no) {
    
            
                if(window.XMLHttpRequest)
                {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                }
                
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        myObj = JSON.parse(this.responseText);
                        var a = myObj.Episodes;
                        console.log(myObj);
                        console.log(a[no-1]);
                        document.getElementById('over').innerHTML=a[no-1].Title;
                        document.getElementById('release').innerHTML=a[no-1].Released;
                        document.getElementById('imdb').innerHTML=a[no-1].imdbRating/2;

                    }
                
                }
    
                xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_id+'&season='+season_no+'&apikey=91d69910',true);
                xmlhttp.send();
                
    
}


// This function is used to get the image and other details of the tv series
function showpart(show_id,show_name,season_no,epi_no) {
        
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                
    
                document.getElementById('seriesbackground').style.background = "url('"+myObj.Poster+"')";
                showseason(season_no,show_id,epi_no);

            }
        }
        xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_name+'&apikey=91d69910',true);
        xmlhttp.send();

}

function public(idof)
{
    
    console.log(idof);
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById(idof).innerHTML='<i class="fa fa-lock-open" aria-hidden="true">';
                    document.getElementById(idof).onclick=function(){private(idof)};
            }
        }
    
        xmlhttp.open('GET','decision.php?id='+idof+'&p=0',true);
        xmlhttp.send();
}

function private(show_id)
{
    console.log(show_id);
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    document.getElementById(show_id).innerHTML='<i class="fa fa-lock" aria-hidden="true">';
                    document.getElementById(show_id).onclick=function(){public(show_id)};
            }
        }
    
        xmlhttp.open('GET','decision.php?id='+show_id+'&p=1',true);
        xmlhttp.send();
}

// This function is used to display each and every episode of a particular season of the tv show

function showseasons(season_no,show_id,no,ar) {
    
        var data = "\n";
        if(season_no <= no)
        {
            
                if(window.XMLHttpRequest)
                {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                }

                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        myObj = JSON.parse(this.responseText);
                        var a = myObj.Episodes;
                        var b = a.length;
                       
                        //  to convert the data from js to html 
                        data+= '<thead>';
                        data += '<tr >';
                        data += '<th> Season '+season_no+'</th>';
                        data += '</tr>';
                        data += '</thead>';

                        data+= '<thead>';
                        data += '<tr >';
                        data += '<th> Episode </th>';
                        
                        data += '<th> Title </th>';
                        
                        data += '<th> Release Date </th>';
                        
                        data += '<th> Watched it?</th>';
                        data += '</tr>';
                        data+= '</thead>';
                        
                        
                        data+= '<tbody>';

                        // loop for all the episodes of the particular season of the tv series
                        for(i=0;i<b;i++)
                        {

                            var c = "S"+season_no+"E";
                            c+=(i+1);
                            
                            data += '<tr >';
                            data += '<td>'+a[i].Episode+'</td>';
                            data += "<td><a href='rating.php?id="+show_id+"&sno="+season_no+"&epino="+(i+1)+"' title='decision'>"+a[i].Title+"</a></td>";          
                            // data += '<td>'+a[i].Title+'</td>';
                            data += '<td>'+a[i].Released+'</td>';

                            if(ar.includes(c)==false)
                            {
                                var j = i+1;
                                var k = show_id+"S"+season_no+"E"+j;
                                // console.log(k);
                                data += "<td><a href='#' title='decision' onclick=markepi('"+show_id+"',"+season_no+","+j+","+0+") id="+k+"><i class=\'material-icons\'>help-circle</i></a></td>";                                                                                  
                            }
                            else
                            {
                                var j = i+1;
                                var k = show_id+"S"+season_no+"E"+j;
                                data+="<td><a href='#' title='decision' onclick=removeepi('"+show_id+"',"+season_no+","+j+","+1+") id="+k+"><i class=\"material-icons\">done</i></a></td>";
                            }
                            data += '</tr>';
            
                        }

                        // recursive call for the next season of the tv series
                        showseasons(season_no+1,show_id,no,ar);                       
                    }
                    data+= '</tbody>\n';

                    $("#season").append(data);
                }
                
               
    
                xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_id+'&season='+season_no+'&apikey=91d69910',true);
                xmlhttp.send();
                
    
        }
    }

    function markepi(showid,season_no,epino,i)
    {
        console.log("mark");
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    var k = showid+"S"+season_no+"E"+epino;
                    document.getElementById(k).innerHTML='<i class="fa fa-check" aria-hidden="true"></i>';
                    document.getElementById(k).onclick=function(){removeepi(showid,season_no,epino,1)};
            }
        }
    
        xmlhttp.open('GET','mark.php?id='+showid+'&sno='+season_no+'&epino='+epino+'&i='+i,true);
        xmlhttp.send();
    }

    function removeepi(showid,season_no,epino,i)
    {
        console.log("unmark");
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    var k = showid+"S"+season_no+"E"+epino;
                    document.getElementById(k).innerHTML='<i class="fa fa-question-circle" aria-hidden="true"></i>';
                    document.getElementById(k).onclick=function(){markepi(showid,season_no,epino,0)};
            }
        }
    
        xmlhttp.open('GET','mark.php?id='+showid+'&sno='+season_no+'&epino='+epino+'&i='+i,true);
        xmlhttp.send();
    }

// to add a friend i.e., to send the friend request to a user 
function searchinfriends(){

    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            var response = xmlhttp.responseText;
            if(response!="")
            {

                document.getElementById('srcfrnd').style.display="initial";
                document.getElementById('prevfrnd').style.visibility="hidden";
                document.getElementById('srcfrnd').innerHTML=response;
                
            }
            else{
                if(document.getElementById('inp').value!="")
                {
                    document.getElementById('srcfrnd').style.display="initial";
                    document.getElementById('prevfrnd').style.visibility="hidden";
                    document.getElementById('srcfrnd').innerHTML="no friend";
                    
                }
                else{
                    location.reload();
                document.getElementById('prevfrnd').style.visibility="visible";
                document.getElementById('srcfrnd').style.display="none";
                }
            }
        }
    }

    xmlhttp.open('GET','searchfriend.php?keyword='+document.getElementById('inp').value,true);
    xmlhttp.send();

}

// to add a friend i.e., to send the friend request to a user 
function addfriend(u_id) {

    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            document.getElementById('icon_'+u_id).innerHTML='<i class="fa fa-times" aria-hidden="true"></i>';
            document.getElementById('icon_'+u_id).onclick= function(){removefriend(u_id)};
        }
    }

    xmlhttp.open('GET','addfriend.php?newfriendId='+u_id,true);
    xmlhttp.send();
    
}

function remove(params) {
    document.getElementById(params).parentElement.style.display='none';
    removefriend(params);
}
// to remove a friend
function removefriend(u_id) {

    if(window.XMLHttpRequest){
 
        xmlhttp = new XMLHttpRequest();
 
    } else {
 
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
 
    }
        xmlhttp.onreadystatechange = function(){
 
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

            document.getElementById('icon_'+u_id).innerHTML='<i class="fa fa-user-plus" aria-hidden="true"></i>';
            document.getElementById('icon_'+u_id).onclick= function(){addfriend(u_id)};
        }
        }

        xmlhttp.open('GET','removefriend.php?friendId='+u_id,true);
        xmlhttp.send();

}

// to accept the friend request of the other user
function acceptrequest(u_id) {

    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            
            document.getElementById('icon_'+u_id).innerHTML="<i class=\"fa fa-users\" aria-hidden=\"true\"></i>";
            document.getElementById(u_id).onclick= function(){remove(u_id)};
        
        }
    }

    xmlhttp.open('GET','acceptrequest.php?f_id='+u_id,true);
    xmlhttp.send();
    
}


//This function is used to show users with given keyword in search bar.The results are shown by first name or username.

function show_results() {
    
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
           
            if(document.getElementById('inp').value!="")
            document.getElementById('prevfrnd').style.visibility="hidden";
            else{
                location.reload();
                document.getElementById('prevfrnd').style.visibility="visible";
            
            }
            document.getElementById('srcfrnd').innerHTML= xmlhttp.responseText;
        }
    }
    xmlhttp.open('GET','search.inc.php?keyword='+document.getElementById('inp').value,true);
    xmlhttp.send();
}




var b;
//This function is used to get the no of seasons in each TV show added by the user
function getnum(id1,name1,epi,i,a)
{

    if(i<a)
    {
        if(i==0)
        {
            b = new Array();      
        }
    var no_of_seasons = 0;
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            no_of_seasons = myObj.totalSeasons;
            b.push(no_of_seasons);
            total = 0;
            getnum(id1,name1,epi,i+1,a);
        }
    }

    xmlhttp.open('GET','http://www.omdbapi.com/?t='+name1[i]+'&apikey=91d69910',true);
    xmlhttp.send();
    }
    else if(i==a)
    {
        getepi(id1,epi,1,0,name1);
    }
}
//This function is used to get the no of episodes of a particular season of a particular show
function getepi(id1,epi,cur,i,name1)
{
        var data="";

    if(cur<=b[i])
    {
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                total +=  myObj.Episodes.length;
                // console.log(myObj);
                getepi(id1,epi,cur+1,i,name1);
            }
        }   
            xmlhttp.open('GET','http://www.omdbapi.com/?t='+id1[i]+'&season='+cur+'&apikey=91d69910',true);
            xmlhttp.send();
    }
    else if(cur>b[i])
    {
        var val = epi[i]/total;
        console.log(total);
        var per = val.toFixed(2)
        console.log(per);
        per = per*100;
        console.log(per);
        var c = per;
        c = Math.trunc(c);
        if(c<10)
            c = "0"+c;
        if(per%10!=0)
        per = per + 10;
        per = per - (per)%10;
        console.log(per);
        // console.log(valueOf(per));

        data+='<div class="col-sm-4 col-lg-4 col-md-2">';
                                    data+='<center>';
                                    data+='<h4>'+name1[i]+'</h4>';
                                    data+='<div class="progress" data-percentage='+per+'>';
                                        data+='<span class="progress-left">';
                                            data+='<span class="progress-bar"></span>';
                                        data+='</span>';
                                        data+='<span class="progress-right">';
                                        data+='<span class="progress-bar"></span>';
                                        data+='</span>';
                                        data+='<div class="progress-value">';
                                        data+='<center>';
                                        data+=(c+'%');
                                        data+='</center>';
                                            
                                        data+='</div>';
                                    data+='</div>';
                                data+='</center>';
                                data+='</div>';
                        console.log(data);
        $("#stats").append(data); 
        b[i] = total;
        total = 0;
        if(i<b.length-1)
            getepi(id1,epi,1,i+1,name1);
        else if(i<b.length)
        {
            


        }
    }
   



}

var e;

//This function is used to get the trending list of TV shows and display the data
function show_trend()
{
    e = new Array();
    // alert("hey");
    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                // alert("trending");
                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                var ans = myObj.results;
            
                for(i=0;i<ans.length && i<18;i++)
                {
                    e.push(ans[i].name);

                    var img = "https://image.tmdb.org/t/p/w500"+ans[i].backdrop_path;
                    document.getElementById("trend"+i).src = img;
                    document.getElementById("trend_name"+i).innerHTML = ans[i].name;
                    document.getElementById("trend_pop"+i).innerHTML = "tmdb "+ans[i].vote_average; 
                }

                getdet(0);
            }
        }   
            xmlhttp.open('GET','https://api.themoviedb.org/3/trending/tv/week?api_key=993dceca3a50f4e4e854202a0095b29e',true);
            xmlhttp.send();
}

function getdet(i) {

    if(i<e.length)
    {
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            document.getElementById("trend_link"+i).href="tv_show.php?t="+myObj.imdbID;
            showresult2(myObj.Title,myObj.imdbID,myObj.Genre,myObj.Poster);
            getdet(i+1);
        }
    }
    
    xmlhttp.open('GET','http://www.omdbapi.com/?t='+e[i]+'&apikey=91d69910',true);
    xmlhttp.send();
    }
}
var c;
var d;
//This function is used to get the upcoming date of the TV show tracked by the user
function show_upcoming(show_id1,i)
{
    console.log("upcomin");
    if(i==0)
    {
        c=new Array();
        d = new Array();
    }
    if(i<show_id1.length)
    {
    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                c.push(myObj.tv_results[0].id);
                d.push(show_id1[i]);
                show_up(myObj.tv_results[0].id);
                show_upcoming(show_id1,i+1);

            }
        }   
            xmlhttp.open('GET','https://api.themoviedb.org/3/find/'+show_id1[i]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US&external_source=imdb_id',true);
            xmlhttp.send();
    }
    else if(i==show_id1.length)
        show_up(0);
}

var data;
function show_up(show_id2)
{
    
    if(show_id2==0)
    {
        data="";
    }
    if(show_id2<c.length)
    {
        console.log(d[show_id2]);

    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                var img = "https://image.tmdb.org/t/p/w500"+myObj.backdrop_path;
                            if(myObj.next_episode_to_air!=null)
                            {
                                data+='<a href ="tv_show.php?t='+d[show_id2]+'"><div class="imgcolumn">';
                                data+='<img src="'+img+'" alt="Snow" style="width:100%">';
                                data+='<div class="bottom-left">'+myObj.name+'</div>';
                                data+='<div class="top-left">Release  '+myObj.next_episode_to_air.air_date+'</div>';
                                data+='</div></a>';
                                console.log(data);
                            }
                            show_up(show_id2+1);

                
            }
        }   

            xmlhttp.open('GET','https://api.themoviedb.org/3/tv/'+c[show_id2]+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US',true);
            xmlhttp.send();
    }
    else if(show_id2==c.length)
    {
        
        $("#upcoming").append(data);
    }
}

// function hashCode(str) {
//     return str.split('').reduce((prevHash, currVal) =>
//       (((prevHash << 5) - prevHash) + currVal.charCodeAt(0))|0, 0);
// }

var rec;

function show_recommend(genres,i,ids,ij)
{
    if(i==0)
    {
        rec = new Array();
    }
        // console.log(genres);
        if(i<genres.length)
        {
            if(window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
            }

            var j = 0;
            
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

                    myObj = JSON.parse(this.responseText);
                    var re = myObj.results;
					console.log(myObj);
                    if(re.length>0)
					{
					for(k=0;k<20;k++)
                    {
                        if(j==5)
                            break;
                        if(rec.includes(re[k].name)==false && ids.includes(re[k].name)==false)
                        {
                            if(ij<18)
                            {
								
								console.log(re[k]);
								var img = "https://image.tmdb.org/t/p/w500"+re[k].backdrop_path;
								document.getElementById("recom"+ij).src = img;
								document.getElementById("recom_name"+ij).innerHTML = re[k].name;
								document.getElementById("recom_pop"+ij).innerHTML = "tmdb "+re[k].vote_average; 
								rec.push(re[k].name);
								++j;
								++ij;
                            }
                        }
                    }
					}
                    show_recommend(genres,i+1,ids,ij);
                    if(i==genres.length-1)
                        getdet2(0);
                }
            }   
                xmlhttp.open('GET','https://api.themoviedb.org/3/discover/tv?api_key=993dceca3a50f4e4e854202a0095b29e&sort_by=popularity.desc&with_genres='+genres[i],true);
                xmlhttp.send();
        }
}

function hey()
{
    alert("hey");
}



function getnum1(id1,name1,epi,i,a,data1,show_url,show_st)
{

    if(i<a)
    {
        if(i==0)
        {
            b = new Array();      
        }
    var no_of_seasons = 0;
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            console.log(myObj);

            

            no_of_seasons = myObj.totalSeasons;
            b.push(no_of_seasons);
            total = 0;
            getnum1(id1,name1,epi,i+1,a,data1,show_url,show_st);
        }
    }

    xmlhttp.open('GET','http://www.omdbapi.com/?t='+name1[i]+'&apikey=91d69910',true);
    xmlhttp.send();
    }
    else if(i==a)
    {
        getepi1(id1,epi,1,0,name1,data1,show_url,show_st);
    }
}
//This function is used to get the no of episodes of a particular season of a particular show
function getepi1(id1,epi,cur,i,name1,data1,show_url)
{

    if(cur<=b[i])
    {
        if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                total +=  myObj.Episodes.length;
                getepi1(id1,epi,cur+1,i,name1,data1,show_url,show_st);
            }
        }   
            xmlhttp.open('GET','http://www.omdbapi.com/?t='+id1[i]+'&season='+cur+'&apikey=91d69910',true);
            xmlhttp.send();
    }
    else if(cur>b[i])
    {
        console.log(show_st[i]);
        console.log(id1[i]);
        data='<div class="col-lg-4 col-md-12 mb-4">';
                    data+='<div class="card card-cascade wider mb-4">';
                      data+='<div class="view view-cascade">';
                        data+='<img src='+show_url[i]+' style="max-height:200px" class="card-img-top" alt="Example photo">';
                        data+='<a href="tv_show.php?t='+id1[i]+'">';
                        data+='<div class="mask rgba-white-slight waves-effect waves-light"></div>';
                        data+='</a>';
                        data+='</div>';
                        data+='<div class="card-body card-body-cascade text-center">';
                        if(show_st[i] == 1)
                        {
                        data+='<h4 class="card-title"><strong>'+name1[i]+'<a class="icons-sm fb-ic" style="padding:2%" onclick=public("'+id1[i]+'") id='+id1[i]+'><i class="fa fa-lock" aria-hidden="true"></i></a>';
                        data+='</strong></h4>';
                        }
                        else
                        {
                            data+='<h4 class="card-title"><strong>'+name1[i]+'<a class="icons-sm fb-ic" style="padding:2%" onclick=private("'+id1[i]+'") id='+id1[i]+'><i class="fa fa-lock-open" aria-hidden="true"></i></a>';
                        data+='</strong></h4>';
                        }
                        data+='<h5 class="indigo-text"><strong>'+data1[i]+'</strong></h5>';
                        console.log(data);
        var val = epi[i]/total;
        val = val*100;
        var per = val.toFixed(2);
        per = Math.trunc(per);
        console.log(per);
        var t = total-epi[i];
        data+='<p class="card-text">';
                            data+='<div style="background-color: #3a3a52;width:'+per+'%;color: white">'+per+'%</div>';
                            data+='<br>';
                            data+=''+t+' episodes left of '+total+'';
                        data+='</p>';
            
            
                      
                        data+='<a href="https://in.pinterest.com/search/pins/?q='+id1[i]+'" class="icons-sm li-ic"><i class="fab fa-pinterest "> </i></a>';
                        data+='<a href="http://twitter.com/intent/tweet/?url=https://www.imdb.com/title/'+id1[i]+'" class="icons-sm tw-ic"><i class="fab fa-twitter"> </i></a>';
                        data+='<a href="http://www.facebook.com/sharer.php?u=https://www.imdb.com/title/'+id1[i]+'" class="icons-sm fb-ic"><i class="fab fa-facebook-f"> </i></a>';
                        data+='<a class="icons-sm fb-ic"><i class="fa fa-user" aria-hidden="true"  onclick=setmodalclass("'+id1[i]+'") data-toggle="modal" data-target="#fluidModalBottomDangerDemo" ></i></a>';
    
    
                        data+='</div>';
            
                        data+='</div>';
                        data+='</div>';
                        // console.log(data);
        $("#show_data").append(data); 
        b[i] = total;
        total = 0;
        if(i<b.length-1)
            getepi1(id1,epi,1,i+1,name1,data1,show_url,show_st);
        else if(i<b.length)
        {
            


        }
    }

}
var o ="";
function show_details(name1,show_id1,check,arr)
{
    o="";
    console.log(show_id1);
    if(window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                myObj = JSON.parse(this.responseText);
                console.log(myObj);
                myObj = myObj.tv_results[0];
                console.log(myObj);
                var img = "https://image.tmdb.org/t/p/w500"+myObj.poster_path;
                var imag = "https://image.tmdb.org/t/p/w500"+myObj.backdrop_path;
                console.log(img);
                document.getElementById("tv_cover").src = img;
                
                document.getElementById("tv_back").style.backgroundImage = "url('assets/img/1.jpg')";
                document.getElementById("likes").textContent=myObj.popularity;
                o = myObj.overview;
                document.getElementById("over").textContent=myObj.overview;
                // c.push(myObj.tv_results[0].id);
               
                // show_up(myObj.tv_results[0].id);
                // show_upcoming(show_id1,i+1);
                getseason1(show_id1,name1,check,arr);
            }
        }   
            xmlhttp.open('GET','https://api.themoviedb.org/3/find/'+show_id1+'?api_key=993dceca3a50f4e4e854202a0095b29e&language=en-US&external_source=imdb_id',true);
            xmlhttp.send();
}

function getseason1(show_id,show_name,check,arr) {


    var no_of_seasons = "";
    
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            console.log(myObj);
            if(o=="")
            {
            document.getElementById("over").textContent=myObj.Plot;
            }
            no_of_seasons = myObj.totalSeasons;
            console.log(no_of_seasons);
            showseasons1(1,show_id,no_of_seasons,check,arr);
        }
    }
    
    
    xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_name+'&apikey=91d69910',true);
    xmlhttp.send();
    
}

function showseasons1(season_no,show_id,no,check,arr) {
    var data = "";
    console.log(show_id);
    console.log(season_no);
    if(season_no <= no)
    {
        
            if(window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
            }

            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    myObj = JSON.parse(this.responseText);
                    console.log(myObj);
                    var a = myObj.Episodes;
                    var b = a.length;
                   
                    data+='<div class="card">';
    
                data+='<div class="card-header" role="tab" id="headingOne'+season_no+'">';
                  data+='<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne'+season_no+'" aria-expanded="false" aria-controls="collapseOne'+season_no+'">';
                    data+='<h5 class="mb-0">';
                    data+='Season '+season_no+'<i class="fas fa-angle-down rotate-icon"></i>';
                    data+='</h5>';
                  data+='</a>';
                data+='</div>';
    
                data+='<div id="collapseOne'+season_no+'" class="collapse" role="tabpanel" aria-labelledby="headingOne'+season_no+'" data-parent="#accordionEx">';
                  data+='<div class="card-body">';
                    data+='<table id="tablePreview" class="table">';
                          data+='<thead>';
                            data+='<tr>';
                              data+='<th>#</th>';
                              data+='<th>Title</th>';
                              data+='<th>Released</th>';
                              data+='<th>Imdb Rating</th>';
                              if(check !=0)
                                data+='<th>Watched It?</th>';
                            data+='</tr>';
                          data+='</thead>';
                          data+='<tbody>';
                    for(i=0;i<b;i++)
                    {

                        var c = "S"+season_no+"E";
                        c+=(i+1);
                        
                        data += '<tr >';
                        data += '<td>'+a[i].Episode+'</td>';
                        data += "<td><a href='rating.php?id="+show_id+"&sno="+season_no+"&epino="+(i+1)+"' title='decision'>"+a[i].Title+"</a></td>";          
                        data += '<td>'+a[i].Released+'</td>';
                        data += '<td>'+a[i].imdbRating+'</td>';
                        if(check !=0)
                        {
                            if(arr.includes(c))
                            {
                                var j = i+1;
                                var k = show_id+"S"+season_no+"E"+j;
                                data+='<td><a title="decision" onclick=removeepi("'+show_id+'","'+season_no+'","'+j+'","'+1+'") id="'+k+'"><i class="fa fa-check" aria-hidden="true"></i></a></td>';
                            }
                            else
                            {
                                var j = i+1;
                                var k = show_id+"S"+season_no+"E"+j;
                                data+='<td><a title="decision" onclick=markepi("'+show_id+'","'+season_no+'","'+j+'","'+0+'") id="'+k+'"><i class="fa fa-question-circle" aria-hidden="true"></i></a></td>';
                            }
                        }
                        data += '</tr>';
                    }
                    data+='</tbody>';
                    data+='</table>';
                    data+='</div>';
                data+='</div>';
                // document.getElementById('accordionEx').append(data);
              $("#accordionEx").append(data);

                    // recursive call for the next season of the tv series
                    showseasons1(season_no+1,show_id,no,check,arr);                       
                }

                
            }
            
           

            xmlhttp.open('GET','http://www.omdbapi.com/?t='+show_id+'&season='+season_no+'&apikey=91d69910',true);
            xmlhttp.send();
            

    }
}

function setmodalclass(tid) {
    
    document.getElementById("fluidModalBottomDangerDemo").className="modal fade bottom";
    var element = document.getElementById("fluidModalBottomDangerDemo");
    element.classList.add(tid);
    element = document.getElementById("fluidModalBottomDangerDemo").className;
   
}

function parseid() {
    var str = document.getElementById("fluidModalBottomDangerDemo").className;
    var res = str.split(" ");
    for(var i = 0 ; i<res.length;i++)
    {
    var n = res[i].startsWith("t");
        if(n){
    
    return res[i];}
    }
}
function suggesttofriend() {
    
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        }
    }

    xmlhttp.open('GET','suggest.php?friendId='+arguments[0]+'&imdb_id='+parseid(),true);
    xmlhttp.send();
   
}



function getdet2(i) {

    if(i<18)
    {
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            myObj = JSON.parse(this.responseText);
            console.log(myObj);
            console.log(myObj.Title);
            console.log(myObj.imdbID);
            console.log(myObj.Genre);
            console.log(myObj.Poster);
            document.getElementById("recom_link"+i).href="tv_show.php?t="+myObj.imdbID;
            showresult2(myObj.Title,myObj.imdbID,myObj.Genre,myObj.Poster);
            getdet2(i+1);
        }
    }
    
    xmlhttp.open('GET','http://www.omdbapi.com/?t='+rec[i]+'&apikey=91d69910',true);
    xmlhttp.send();
    }
}


