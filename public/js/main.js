var check_check = '0';
function sel_all2(name_of_form){
   if( !document.getElementById(name_of_form).cheks ) return;
   if( !document.getElementById(name_of_form).cheks.length )
      document.getElementById(name_of_form).cheks.checked = document.getElementById(name_of_form).cheks.checked ? false : true;
   else {
      for(var i=0;i<document.getElementById(name_of_form).cheks.length;i++) {
         if (check_check=='0')
            document.getElementById(name_of_form).cheks[i].checked = true;
         else 
            document.getElementById(name_of_form).cheks[i].checked = false;
      }
      if (check_check=='0') check_check = '1';
      else check_check = '0';
   }
}


// Настройки => Персональные данные //

/* День / Месяц / Год */
$(function() {
for(var i = 1; i <= 31; i++){
  $('#day').append('<option value="'+i+'">'+i+'</option>');
}
var month = ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
for(var i = 0; i < month.length; i++){
  $('#month').append('<option value="'+month[i]+'">'+month[i]+'</option>');
}

var myDate = new Date();
var year = myDate.getFullYear();
for(var i = 1960; i < year+1; i++){
   $('#year').append('<option value="'+i+'">'+i+'</option>');
}


for(var i = 1; i <=20; i++){
  if(i==1){
   $('#work').append('<option value="'+i+'">'+i+" год"+'</option>');
}
else if(i==2||i==3||i==4){
  $('#work').append('<option value="'+i+'">'+i+" года"+'</option>');
}
else{
  $('#work').append('<option value="'+i+'">'+i+" лет"+'</option>');
}
}

});



//END Настройки => Персональные данные //