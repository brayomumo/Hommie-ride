function join(g_id){  
    console.log("Button clicked....executing ajax..");
    console.log(g_id);
    $.ajax({
        url: 'group_functions.php',
        type: 'post',
        data: { "g_id": g_id},
        success: function(response) { 
          alert(response);
          window.location.href = "dashboard.php";
          // console.log(response);
         }
    });
  }