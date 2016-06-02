

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Final</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
    </head>
    <body>

    <?php 

        require '../../global/scripts/db-connection.php';

        $gender = "F";
        $sql = "SELECT * FROM m_students WHERE gender = :gender ORDER BY lastName ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute(array(":gender" => $gender));

        $femaleRecord = $stmt -> fetchAll();

        echo "<h1>List of all female students</h1>";
        foreach ($femaleRecord as $femaleStudent) {
            echo "<p>$femaleStudent[lastName], $femaleStudent[firstName]</p>";
        }


        $sql = "SELECT firstName, lastName, grade FROM m_students, m_gradebook WHERE m_gradebook.grade < :grade ORDER BY m_gradebook.grade ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute(array(":grade" => 50));

        $gradeRecord = $stmt -> fetchAll();

        echo "<h1>List of students that have assignments with a grade lower than 50</h1>";
        foreach ($gradeRecord as $student) {
            echo "<p>Last Name: $student[lastName], First Name: $student[firstName], Grade: $student[grade]</p>";
        }


        $sql = "SELECT * from m_assignments left join m_gradebook on m_assignments.assignmentId = m_gradebook.assignmentId where m_gradebook.assignmentId is null ORDER BY m_assignments.dueDate ASC";
       // $sql = "SELECT DISTINCT(title), dueDate FROM m_gradebook, m_assignments WHERE m_gradebook.assignmentId = m_assignments.assignmentId ORDER BY m_assignments.dueDate ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $date = $stmt -> fetchAll();

        echo "<h1>List of assignments that have not been graded </h1>";
        foreach ($date as $dueDate) {
            echo "<p>Title: $dueDate[title], Due Date: $dueDate[dueDate]</p>";
        }



        $sql = "SELECT * FROM m_students, m_gradebook, m_assignments WHERE m_students.studentId = m_gradebook.studentId AND m_gradebook.assignmentId = m_assignments.assignmentId ORDER BY m_students.lastName, m_assignments.title ASC";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();
        $gradeBook = $stmt -> fetchAll();

        echo "<h1>Gradebook</h1>";
        foreach ($gradeBook as $student) {
            echo "<p>Last Name: $student[lastName], First Name: $student[firstName], Title: $student[title], Grade: $student[grade]</p>";
        }





        $sql = "SELECT m_students.studentId, firstName, lastName, AVG(grade) AS average FROM m_students, m_gradebook WHERE m_students.studentId = m_gradebook.studentId GROUP BY m_students.studentId ORDER BY average DESC";
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute();

        $record = $stmt -> fetchAll();

        echo "<h1>List of average grade per student</h1>";
        foreach ($record as $student) {
            echo "<p>$student[studentId], $student[firstName], $student[lastName], $student[average]</p>";
        }
    ?>

    </body>
</html>
