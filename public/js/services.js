/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var nextinput = 0;
var services = Array();

$(document).ready(function () {

    /* Im use this function to disable or enable the add button*/

    $("#service").on("keyup", function (event) {

        var lengthField = $("#service").val();

        if (lengthField != '') {
            $("#addService").removeAttr("disabled");

        } else {
            $("#addService").attr("disabled", "disabled");
        }
    });

    $("#searchLog").on("keyup", function (event) {

        var lengthField = $("#searchLog").val();

        if (lengthField != '') {
            $("#datepickerStart").attr("disabled", "disabled");
            $("#datepickerFinal").attr("disabled", "disabled");
            $("#service").attr("disabled", "disabled");
        } else {

            $("#datepickerStart").removeAttr("disabled");
            $("#datepickerFinal").removeAttr("disabled");
            $("#service").removeAttr("disabled");

        }
    });





});

function cleanServices()
{
    /**/
}

//Function is used to add a filter when the client use the button enter
function addServiceEnter(e) {
    x = $('#service').val();

    if (e.keyCode == 13 && x != '')
    {
        addServices();
        return false;
    }
}


function addServices(val) {
    $("#addService").attr("disabled", "disabled");
    $("#request_http").hide();
    if (val == null || val == '')
    {
        var value = checkBannedWords($('#service').val().trim());
    } else
    {
        var value = checkBannedWords(val);
    }

    if (value == '')
    {
        alert('We have a problem with your filter, we can\'t process this filter because you\'re using a banned word');
        $('#info').val('');
    } else
    {
        var id = "inputArea_" + nextinput;
        var id2 = "remove_" + nextinput;
        var removeButton = "<a href='#' onclick=\"removeInputs('" + id + "', '" + id2 + "','" + value + "');\" > <span class='glyphicon glyphicon-remove'></span>";
        //var div = "<input id='cantServ' name='cantServ' type='text' value='" + setCant() + "'/><li style='list-style:none; display: inline;' class='input-service1' id='" + id + "'><input type='text' value='" + value + "' id=ser_" + nextinput + " name=ser_" + nextinput + " class='input-service' readonly='readonly' /> " + removeButton + " </li>";
        var div = "<li style='list-style:none; display: inline;' class='input-service1' id='" + id + "'><input type='text' value='" + value + "' id=ser_" + nextinput + " name=ser_" + nextinput + " class='input-service' readonly='readonly' /> " + removeButton + " </li>";

        $("#services").append(div);
        $('#service').val('');
        saveServices(value);
        nextinput++;

    }
}

//Save services on the request
function saveServices(service) {
 
 $.post('http://localhost:8080/programmatic/request.php', {service2: service}, function (htmlexterno) {
 $("#cargaexterna").html(htmlexterno);
 });
 
 }

function submitForm() {

    if (nextinput !== 0) {

        for (i = 0; i < nextinput; i++) {
            if ($("#ser_" + i).length > 0 && $("#ser_" + i).is(':visible'))
            {
                //Fill the service array from the input #ser
                services[i] = $('#ser_' + i).val();

            }
        }
    }
}

//Function is used to clear the input text fields
function checkBannedWords(wordToEval)
{
    return wordToEval.replace(/[*'";\\^$#]|<script[^>]*\>|<\/script[^>]*>?|eval/g, '');
}

//Function is used to remove the input of filters
function removeInputs(id, id2)
{
    $("#" + id).remove();
    $("#" + id2).remove();
    nextinput--;




}

function setCant()
{
    return nextinput;
}


