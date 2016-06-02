
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Lab 6</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      
      <style>

         .subBTN{
          padding: 30px 0 0;
         }
         img{ 
            float: left;
            width: 100px;
            margin-right: 15px;
            cursor: pointer;
          }
          h2, h3 { 
            font-size: 2.4em;
            text-shadow:none;
          }
          .block{
            float: left;
            width: 100%;
          }
      </style>
  </head> 

<body>
<section> 

  <div class="wrapper">

      <h2>Vocabulary Quiz</h2>

      <div id="q1" class="block">
        <h3>1. Click on "El Pollo"</h3>
        <img id="cat" src="media/images/cat.png" >
        <img id="dog" src="media/images/dog.png" >
        <img id="chicken" src="media/images/chicken.png" >
        <img id="mouse" src="media/images/mouse.png" >
      </div>


      <div class="block">
        <h3>2. What is cat in Spanish?</h3>
        <input type="text" id="q2" />
      </div>

      <div class="block">
        <h3>3. What is dog in Spanish?</h3>
        <input type="radio" name="q3" value="cat">
        Gato
        <br />
        <input type="radio" name="q3" value="dog">
        Perro
        <br />
        <input type="radio" name="q3" value="chicken">
        Pollo
        <br />
        <input type="radio" name="q3" value="mouse">
        Raton
      </div>
      
      <div class="block">
        <h3>4. What is chicken in German?</h3>
        <select id="q4">
          <option value="mouse">Maus</option>
          <option value="chicken">Hühnchen</option>
          <option value="dog">Hund</option>
          <option value="cat">Katze</option>
        </select>
      </div>
      
      <div class="block">
        <h3>5. Which of these animals do not lay an eggs?</h3>
        <input type="checkbox" name="q5" value="cat">
        Katze
        <br />
        <input type="checkbox" name="q5" value="dog">
        Hund
        <br />
        <input type="checkbox" name="q5" value="chicken">
        Hühnchen
        <br />
        <input type="checkbox" name="q5" value="mouse">
        Maus
      </div>
      
      <div class="block subBTN">
        <input type="button" value="Submit Quiz!" id="submitQuiz" />
      </div>

      <div class="block">
        <h2 id="grade"></h2>
        <h3>Max. 100</h3>
      </div>

  </div>
</section>
  
  <script>

      // cached vars
      var answer1;
      var answer2;
      var answer3;
      var answer4;
      var grade;
      var imgs$ = $("#q1 img");
      var grade$ = $("#grade");

      imgs$.mouseenter(function() {
        $(this).css("width", "125px")
      });

      imgs$.mouseleave(function() {
        $(this).css("width", "100px")
      });

      imgs$.click(function() {

        imgs$.css("border", "");
        $(this).css("border", "5px solid green")
        answer1 = $(this).attr("id");

      });

      $("#submitQuiz").click(function() {
        grade = 0;

        if (answer1 == "chicken") {
          grade += 20;
        }

        answer2 = $("#q2").val().toUpperCase();
        if (answer2 == "GATO") {
          grade += 20;
        }

        answer3 = $("input:radio:checked").val();
        if (answer3 == "dog") {
          grade += 20;
        }
        
        answer4 = $("#q4 option:selected").val();
        if (answer4 == "chicken") {
          grade += 20;
        }
        
        $("input[name='q5']").each( function () {
          if($(this).is(':checked')){
            if($(this).val() == "cat") grade += 5;
            if($(this).val() == "dog") grade += 5;
            if($(this).val() == "mouse") grade += 5;
            if($(this).val() == "chicken"){
              grade = (grade > 0) ? grade -= 5 : 0;
            }
          }
        });
        
        grade$.html("Grade: " + grade);

      });

  </script>

  
</body>
</html>
