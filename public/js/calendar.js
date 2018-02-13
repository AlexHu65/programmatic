/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*$(document).ready(function () {
 $.datepicker.setDefaults($.datepicker.regional["en"]);
 $("#datepickerStart").datepicker({
 firstDay: 1
 });
 });
 
 $(document).ready(function () {
 $.datepicker.setDefaults($.datepicker.regional["en"]);
 $("#datepickerFinal").datepicker({
 firstDay: 1
 
 
 });
 });*/

$(document).ready(function ()
{

    $("#datepickerStart").datetimepicker(
            {
                changeMonth: false,
                changeYear: false,
                timeFormat: 'HH:mm:ss',
                showSecond: true,
                dateFormat: 'yy-mm-dd',
                separator: ' '
            });

    $("#datepickerFinal").datetimepicker(
            {
                changeMonth: false,
                changeYear: false,
                timeFormat: 'HH:mm:ss',
                showSecond: true,
                dateFormat: 'yy-mm-dd',
                separator: ' '
            });
});
