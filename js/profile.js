$("document").ready(function(){
    // alert ("ready")
    getDetails()
})
let carType = " "
let carplatenumber = " "

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
    carplatenumber =  value['carplatenumber']
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
function updatePersonalDetails(){
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var phoneNumber = parseInt(document.getElementById("phoneNumber").value);
    if(phoneNumber.toString().length != 9){
       return  alert("Enter correct Phone Number ")
    }
    var x = document.getElementById("personalPopup");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
        $.ajax({
            type: "POST",
            url: "api/profile.php",
            data: { "newUsername": username, "newEmail":email, "newPhoneNumber": phoneNumber },
            success: function(response){
                getDetails()
                alert(response)
            }
        })
      x.style.display = "none";
    }
}
function updateCarDetails(){
    var cartype = document.getElementById("cartype").value;
    var platenumber = document.getElementById("platenumber").value;
    var x = document.getElementById("carPopup");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      if (platenumber == carplatenumber){
        return alert("Enter the new Registration number");
      }
            if ((parseInt(platenumber.slice(0, 3)) == "Nan") && (parseInt(platenumber.slice(3, 6) == "Nan"))) {
            return alert("Enter correct Car Plate number")
            } else {
              $.ajax({
                  type: "POST",
                  url: "api/profile.php",
                  data: { "newCarType": cartype, "newPlateNumber":platenumber },
                  success: function(response){
                      getDetails()
                      alert(response)
                  }
              })
            x.style.display = "none";
          }
  }
}