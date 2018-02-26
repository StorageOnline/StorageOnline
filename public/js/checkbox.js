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