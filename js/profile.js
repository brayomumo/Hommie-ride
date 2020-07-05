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
      personal += "<div class='archive'> \
            <h4 class='article'> <b> First Name:</b>  " + value['firstname'] + "</h4> \
            <h4 class='article'> <b> Last Name:</b>  " + value['lastname'] + "</h4> \
            <h4 class='article'> <b> Email:</b>  " + value['email'] + "</h4> \
            <h4 class='article'> <b> Phone number:</b>  +254" + value['phonenumber'] + "</h4> \
        </div> "
       
        work += "<div class='archive'> \
            <h4 class='article'> <b> place of work:</b>  " + value['placeofwork'] + "</h4> \
            <h4 class='article'> <b> Area of work:</b>  " + value['workArea'] + "</h4> \
            <h4 class='article'> <b> Home Area:</b>  " + value['homeArea'] + "</h4> \
        </div> "
        
        car += "<div class='archive'> \
            <h4 class='article'> <b> car type:</b>  " + value['cartype'] + "</h4> \
            <h4 class='article'> <b> car plate number:</b>  " + value['carplatenumber'] + "</h4> \
            <h4 class='article'> <b> Licence number:</b>  " + value['licencenumber'] + "</h4>\
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
function updateHome(){
    var homeArea = document.getElementById("homearea1").value;
    homeArea = homeArea.charAt(0).toUpperCase() + homeArea.slice(1);
    var x = document.getElementById("homePopup");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
        $.ajax({
            type: "POST",
            url: "api/profile.php",
            data: { "newHomeArea": homeArea },
            success: function(response){
                getDetails()
                alert(response)
            }
        })
      x.style.display = "none";
    }
    // alert(workarea)
}
function updatework(){
    var workplace = document.getElementById("workplace1").value;
    var company = document.getElementById("company1").value;
    workplace = workplace.charAt(0).toUpperCase() + workplace.slice(1);
    company = company.charAt(0).toUpperCase() + company.slice(1);
    var x = document.getElementById("workPopup");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
        $.ajax({
            type: "POST",
            url: "api/profile.php",
            data: { "newWorkArea": workplace, "newCompany":company },
            success: function(response){
                getDetails()
                alert(response)
            }
        })
      x.style.display = "none";
    }
    // alert(workarea)
}