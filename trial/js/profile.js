$("document").ready(function(){
    // alert ("ready")
    getDetails()
})
// get user id 
// pass to php
// get results
// display

function getDetails(){
    var user_id = $(".user_id").attr("id");
    $.ajax({
      type: "POST",
      url: "api/profile.php",
      data: { "user_id": user_id },   
  }).done(function (data) {
    var value = $.parseJSON(data);
    console.log(value)
    var personal = "";   
    var work = "";
    var car = "";   
    var name = "";  
    /* from result create a string of data and append to the div */
      name += "<h2 class='name ' ><img src='images/user.png'>  &nbsp " + value['username'] + "'s   Profile </h2> " 
      personal += "<div class='grid-container'> \
            <h4 class='grid-item1'> <b> First Name:</b>  " + value['firstname'] + "</h4> \
            <h4 class='grid-item11'> <b> Last Name:</b>  " + value['lastname'] + "</h4> \
            <h4 class='grid-item2'> <b> Email:</b>  " + value['email'] + "</h4> \
            <h4 class='grid-item21'> <b> Phone number:</b>  +254" + value['phonenumber'] + "</h4> \
        </div> "
       
        work += "<div class='grid-container'> \
            <h4 class='grid-item3'> <b> place of work:</b>  " + value['placeofwork'] + "</h4> \
            <h4 class='grid-item31'> <b> Area of work:</b>  " + value['workArea'] + "</h4> \
            <h4 class='grid-item32'> <b> Home Area:</b>  " + value['homeArea'] + "</h4> \
        </div> "
        
        car += "<div class='grid-container'> \
            <h4 class='grid-item4'> <b> car type:</b>  " + value['cartype'] + "</h4> \
            <h4 class='grid-item41'> <b> car plate number:</b>  " + value['carplatenumber'] + "</h4> \
            <h4 class='grid-item42'> <b> Licence number:</b>  " + value['licencenumber'] + "</h4>\
        </div>"
        $("#person").html(name)
        $("#personal").html(personal);
        $("#work").html(work)
        $("#car").html(car) 
    });
}
function updateProfile(){
  var user_id = $(".user_id").attr("id");
  var username = document.getElementById("username").value;
  var firstname = document.getElementById("firstname").value;
  var lastname = document.getElementById("lastname").value;
  var email = document.getElementById("email").value;
  var phonenumber = document.getElementById("phonenumber").value;
  var licencenumber = document.getElementById("licencenumber").value;
  var placeofwork = document.getElementById("placeofwork").value;
  var workarea = document.getElementById("workarea").value;
  var homearea = document.getElementById("homearea").value;
  var carplatenumber = document.getElementById("carplatenumber").value;
  var cartype = document.getElementById("cartype").value;
  var user = [user_id,username,firstname,lastname,email,phonenumber,licencenumber,placeofwork,workarea,homearea,carplatenumber,cartype]
  console.log(user)
}
function valLicence(licencenumber){
  
}
function submitform()
{
    console.log(document.forms["updateProfile"].submit());
}