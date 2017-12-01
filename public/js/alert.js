/**
 * Created by TommyLin on 2017/6/16.
 */
$(document).ready(function() {

    var status=$('#status').val();

    if (status='過期'){
        $('#status').css('color', 'red');
    }else if(status='已到'){
        $('#status').css('color', 'yellow');
    }
});




















//     var today= new Date();
//     var enddate=$( "#nextdate" ).val();
//     var num=$('#number').val();
//     var difference = today- enddate;
//     difference /= 86400000;
//     // el.textContent =  Math.floor(difference) + ' 天';
//     var el = document.getElementById('status');
//     if(today=enddate){
//         el.textContent ='到期';
//     }
//     else if(today>enddate){
//         el.textContent='過期';
//     }
//     else {
//         el.textContent= Math.floor(difference) + ' 天'+'未到期';
//     }
//
// });



// function Date_substr()
// {
// //定義起始 年月日
//     var StartDate=$( "#from_date" ).val();
// //定義結束 年月日
//     var EndDate=$( "#to_date" ).val();
//
//
//     alert('相差 '+ (DateDifference(StartDate,EndDate))+'天');
// }
// // 算出日期與日期間的差距有幾天
// function DateDifference(StartDate,EndDate) {
//
//     var myStartDate = new Date(StartDate);
//     var myEndDate = new Date(EndDate);
//
//     // 天數，86400000是24*60*60*1000，除以86400000就是有幾天
//     return (myEndDate - myStartDate) / 86400000;


