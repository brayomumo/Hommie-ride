$(document).ready(function(){
  var objDiv = document.getElementsByClassName("news");
objDiv.scrollTop = objDiv.scrollHeight;
  getPosts()
  getDetails()
})
 //leaving Group
  function leavegroup(user_id){
    $.ajax({
      type: "POST",
      url: "api/group_functions.php",
      data: {"user_id": user_id},
      success: function(response){
        alert(response)
        location.reload(true)
      }
    })
  }
function join(g_id){  
    console.log("Button clicked....executing ajax..");
    console.log(g_id);
    $.ajax({
        url: 'api/group_functions.php',
        type: 'post',
        data: { "g_id": g_id},
        success: function(response) { 
          alert(response);
          window.location.href = "dashboard.php";
          // console.log(response);
         }
    });
  }

 

//  posting News
  function postnews() {
    // var g_id = document.getElementById("transition").getAttribute("value");
    var pst = document.getElementById("post").value
    $.ajax({
        type: "POST",
        url: "api/group_functions.php",
        data: { "post": pst },
        success: function(data){
          $("#post_form")[0].reset()
          getPosts()
        }
    })
  }

  //fetching posts
    function getPosts(){
      var getPostID = $(".transition").attr("id");
      $.ajax({
        type: "POST",
        url: "api/group_functions.php",
        data: { "getPostID": getPostID },
        success: function(data){
          $("#post_form")[0].reset()
        }    
    }).done(function (data) {
        var result = $.parseJSON(data);
        var allposts = "";        
        /* from result create a string of data and append to the div */
        $.each(result, function (key, value) {
          allposts += "<div class='msg'><h4>" + value['username'] + "</h4> <h6>" + value['post'] + "</h6> <p style='text-align:right;'>"+ value['whenPosted']+"</p> </div> <br>"
        });
        $(".transition").html(allposts);
        var objDiv = document.getElementsByClassName("news");
        objDiv.scrollTop = objDiv.scrollHeight;

    });
  }

  // getting Group details
    function getDetails(){
      var getDetailsID = $(".transition").attr("id");
      var members = "<table style='width: 70%; text-align:center;'><tr><th>username</th><th>Place of work</th></tr>";
      var cars = "<table style='width: 70%; text-align:center;'><tr><th>car type</th><th>car plate number</th></tr>";
      $.ajax({
        type: "POST",
        url: "api/group_functions.php",
        data: { "getDetailsID": getDetailsID },
        success: function(data){
          console.log(data)
        }    
      }).done(function (data) {
        var result = $.parseJSON(data);
      // get members
      // get vehicles       
        $.each(result, function (key, value) {
          // allposts += "<div class='card'><div class='container'><h4>" + value['username'] + "</h4> <h6>" + value['post'] + "</h6> <p>"+ value['whenPosted']+"</p> </div></div>"
          members += "<tr><td> " +value['username'] + "</td><td> "+value['placeofwork'] +"</td></tr>"
          cars +="<tr><td> " +value['cartype'] + "</td><td> "+value['carplatenumber'] +"</td></tr>";
        });
        members += "</table>";
        cars +="</table>"
        $(".members").html(members);
        $(".cars").html(cars);
    });
    }
    