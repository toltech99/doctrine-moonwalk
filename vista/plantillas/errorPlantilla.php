<?php
//https://www.phptutorial.net/php-tutorial/php-select-option/
$html = "<!DOCTYPE html>
<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <p>$this->error</p>


        <form  method='get'>


             
<label for='option'>Selecciona una opció:</label>

<select id='option'>
  <option value='ref'>Referència de validació de l'entrada</option>
  <option value='data'>Espectacles del dia</option>
  
</select> <br><br>

<Select id='colorselector'>
   <option value='red-1'>Red</option>
   <option value='yellow-2'>Yellow</option>
   <option value='blue-2'>Blue</option>
   <option value='black-1'>Black</option>
</Select>  <br><br>
<div id='-1' class='colors' style='display:none'> Div1... </div>
<div id='-2' class='colors' style='display:none'> Div2.. </div>

  <input type='radio' id='html' name='fav_language' value='HTML'>
  <label for='html'>HTML</label><br>
  <input type='radio' id='css' name='fav_language' value='CSS'>
  <label for='css'>CSS</label><br>
  <input type='radio' id='javascript' name='fav_language' value='JavaScript'>
  <label for='javascript'>JavaScript</label>
 <br><br>

<label for='ref'>Referència:</label><br>
  <input type='text' id='ref' name='ref' value='John'><br>
  <label for='data'>Last name:</label><br>
  <input type='text' id='data' name='data' value='Doe'><br><br>
  <input type='submit' value='Submit'>
</form>  <br><br>


  <script type='text/javascript'>
  alert('GeeksforGeeks!');
  $('#colorselector').change(function(){
    if((this.options[this.selectedIndex].value).indexOf('-1') > -1) {
        $('#-2').hide();
        $('#-1').show();
    }
    else {
        $('#-1').hide();
        $('#-2').show();
    }
  });
  $(function() {
    $('#colorselector').change(function() {
      $('.colors').hide();
      $('#-' + $(this).val().split('-')[1]).show();
    });
  });
</script>
    </body>
</html>";

?>