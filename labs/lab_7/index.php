
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Lab 7</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
      <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

  </head> 

<body>
  <section> 
  <div class="wrapper">
 <!--*********STEP 1********* -->
   <h2> Registration Form</h2>
   
   <form action="catalog.php">
       
        First Name: <input type="text" name="firstName" /> <br /><br />
        Last Name: <input type="text" name="lastName" /> <br /><br />
        Email: <input type="text" name="email" /> <br /><br />
        Zip Code:  <input type="text" id="zipCode" name="zipCode" size="5" /> <br /><br />
        City: <span id="city"></span><br /><br />
        
        State: 
        <select id="state">
            <option value=""> Select One </option>
            <option value="AZ"> Arizona </option>
            <option value="CA"> California </option>
            <option value="IL"> Illinois</option>
            <option value="TX"> Texas </option>
        </select><br /><br />
        
        County:
        <select id="county">
            
        </select>
        <br /><br />
        
        Username:  <input type="text" id="username" name="username" />  
        <span id="checkUsername"></span>
        <br /><br />
        Password: <input type="password" id="password" name="password" />
        
        <br /><br />
        <input type="submit" value="Sign up!" />
        
   </form>
    <p>All zips have been uploaded, but just in case you can test 95133 and Matt</p>
  </div>
  <section> 
  
  <script>
     $("#zipCode").change(  function(){ 
          //alert($("#zipCode").val());
         
          $.ajax({
              type: "get",
              url: "zip.php",
              dataType: "json",
              data: { "zip_code": $("#zipCode").val() },
                success: function(data,status) {
               //alert(data["city"]);
               $("#city").html(data["city"]);
              },
              complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
              }
           });
         
          
     }); //end changeEvent
     
     $("#state").change( function(){ 
         
        //alert( $("#state").val() );
           
        $.ajax({
          type: "get",
          url: "countyList.php",
          dataType: "json",
          data: { "state": $("#state").val() },
          success: function(data,status) {
            //alert(data["counties"]);
            console.log(data["counties"]);
           
            $("#county").html("<option> Select One </option>");
            for (var i=0; i< data['counties'].length; i++){
               $("#county").append("<option>" + data["counties"][i].county + "</option>" );
            }
           
          
          },
          complete: function(data,status) { //optional, used for debugging purposes
             //alert(status);
          }
         });

        
      }); // end state change event
         

     $("#username").change( function(){
        $.ajax({
            type: "post",
            url: "userLookup.php",
            dataType: "json",
            data: { "username": $("#username").val() },
            success: function(data,status) {
           
                 //alert(data['exists']);
               if (data['exists'] == "true")  {
                 $("#checkUsername").html("Username already taken!");
                 $("#checkUsername").css("color","red");
                 $("#username").css("background-color","red");
                 $("#username").focus();
                  
                 
               } else {
                   
                  $("#checkUsername").html("Username available!");
                  $("#checkUsername").css("color","");
                  $("#username").css("background-color","green");                    
                   
               }
            },
            complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
            }
         });
     }); // end of usernsame change
             
      
  </script>
  
</body>
</html>
