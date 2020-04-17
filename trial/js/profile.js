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
    var allposts = "";        
    /* from result create a string of data and append to the div */
      allposts += "<div class='card column content'>\
      <h2 class='profile ' > <img src='images/user.png'> &nbsp " + value['username'] + " Profile </h2>\
      <header> Personal Details</header> \
      <div class='grid-container'> \
            <h4 class='grid-item1'> <b> First Name:</b>  " + value['firstname'] + "</h4> \
            <h4 class='grid-item11'> <b> Last Name:</b>  " + value['lastname'] + "</h4> \
            <h4 class='grid-item2'> <b> Email:</b>  " + value['email'] + "</h4> \
            <h4 class='grid-item21'> <b> Phone number:</b>  +254" + value['phonenumber'] + "</h4> \
        </div> \
        <header> Work details</header>\
        <div class='grid-container'> \
            <h4 class='grid-item3'> <b> place of work:</b>  " + value['placeofwork'] + "</h4> \
            <h4 class='grid-item31'> <b> Area of work:</b>  " + value['workArea'] + "</h4> \
            <h4 class='grid-item32'> <b> Home Area:</b>  " + value['homeArea'] + "</h4> \
        </div> \
        <header> Car details </header>\
        <div class='grid-container'> \
            <h4 class='grid-item4'> <b> car type:</b>  " + value['cartype'] + "</h4> \
            <h4 class='grid-item41'> <b> car plate number:</b>  " + value['carplatenumber'] + "</h4> \
            <h4 class='grid-item42'> <b> Licence number:</b>  " + value['licencenumber'] + "</h4>\
        </div>\
        </div>"
      $(".user_id").html(allposts);
    });

}