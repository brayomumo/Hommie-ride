$(document).ready(function () {
    getTodaytripdetails();
})
    function joinTrip(g_id) {
        
        $.ajax({
            method: "POST",
            url: "api/trips.php",
            data: {
                "joinID": g_id
            },
            success: function (response) {
               $("#" + g_id).hide()
                getTodaytripdetails();

            }
        })
    }
    function getTodaytripdetails() {
        var g_id = document.getElementById("transition").getAttribute("value");
        console.log(g_id)
        $.ajax({
            method: "POST",
            url: "api/trips.php",
            data: { "todayID": g_id },

        }).done(function (data) {
            var result = $.parseJSON(data);
            console.log(result)
            var string = '<table style="width: 50%; text-align:center";> <tr>\
                                    <th>Name</th>\
                                    <th>place of work</th>\
                                    <th>status</th>\
                                </tr>';

            /* from result create a string of data and append to the div */

            $.each(result, function (key, value) {

                string += "<tr> <td>" + value['name'] + "</td> \
                        <td>"+ value['place'] + '</td>  \
                        <td>'+ value['state'] + "</td> </tr>";
            });

            string += '</table>';
            $("#transition").html(string);
        });
    }