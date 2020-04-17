$(document).ready(function(){
  var objDiv = document.getElementsByClassName("news");
objDiv.scrollTop = objDiv.scrollHeight;
  getPosts()
})
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
      var g_id = $(".transition").attr("id");
      console.log(g_id)
      $.ajax({
        type: "POST",
        url: "api/group_functions.php",
        data: { "getID": g_id },
        success: function(data){
          $("#post_form")[0].reset()
          console.log(data)
        }    
    }).done(function (data) {
        var result = $.parseJSON(data);
        console.log(result)
        var allposts = "";        
        /* from result create a string of data and append to the div */
        $.each(result, function (key, value) {
          allposts += "<div class='card'><div class='container'><h4>" + value['username'] + "</h4> <h6>" + value['post'] + "</h6> <p>"+ value['whenPosted']+"</p> </div></div>"
        });
        $(".transition").html(allposts);
        var objDiv = document.getElementsByClassName("news");
        objDiv.scrollTop = objDiv.scrollHeight;

    });

    
}