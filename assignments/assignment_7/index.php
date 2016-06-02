

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Book Ratings</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.13/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.13/angular-resource.min.js"></script>
        <script src="media/js/app.js"></script>
    </head>
    <body>
        <section id="header"> 
            <div class="wrapper">
                <h1>Book Ratings<br><span>Roll over to get more info</span></h1>
                <p>Notes: Book info data is retrieved on each rollover. If you add your own rating (select the star you want to give it) you can see the calculations evaluate and update.</p>
            </div>
        </section>

        <section ng-controller="bookCntrl">
            <ul class="books">
                <li ng-repeat="book in booksList">
                    <div class="book-wrapper">
                        <div class="book-img">
                            <img ng-src="{{book.img}}" alt="{{book.title}}" />
                        </div>
                        <div class="book-info" data-book-id="{{book.id}}" cm-get-info></div>
                    </div>

                </li>
            </ul>
        </section>

    </body>
</html>
