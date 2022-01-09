<?php require_once("header.php");

$conn = new mysqli("localhost","root","","school") ;
// $results = $conn->query("Select * FROM students");
// if($results->num_rows > 0 ){
//     while($row = $results->fetch_assoc()){
//         echo $row['id'] . $row['name'] . $row['fathername'] . $row['dob'] . $row['class'];
//     }
// }

if($conn){
    // echo "Successfull: ";
}else{
    echo "Connection To DataBase Failed! ";
}

?>


<div class="container p-3">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form method="post" action="server.php">
                <div class="form-group">
                    <label for="studentId">Student.ID Number</label>
                    <input type="number"  class="form-control" name="studentId" id="studentId" aria-describedby="helpId" placeholder="Student ID">
                    <small id="helpId" class="form-text text-muted">ID</small>
                </div>
                <span class="text-center"><strong>OR</strong></span>
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text"  class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Student Name">
                    <small id="helpId" class="form-text text-muted">Name</small>
                </div>
                
                <input name="read" id="read" class="btn btn-primary" type="submit" value="Show Student">

            </form>
            <form method="get" action="read.php">
                <input class="form-control btn btn-primary mt-2" type="submit" name="readall" value="Show All Students">
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php 
    if(isset($_GET['readall'])){
        $tempSql = "SELECT * FROM students  ";
        // echo "Sql " . $tempSql;
        $tempResult = $conn->query($tempSql);
        $stId = 0 ;
        if($tempResult->num_rows > 0){
            renderTable($tempResult);
        }
    }

    function renderTable($tempResult){
        echo'
        <div class="container" >
        <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Studdent ID </th>
          <th scope="col">Name</th>
          <th scope="col">Father Name</th>
          <th scope="col">DOB</th>
          <th scope="col">Class</th>
          <th scope="col">Update</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>';
            while($tempRow =  $tempResult->fetch_assoc()){
                echo '<tr>
                <th scope="row">'.$tempRow['id'].'</th>
                <td>'.$tempRow['name'].'</td>
                <td>'.$tempRow['fathername'].'</td>
                <td>'.$tempRow['dob'].'</td>
                <td>'.$tempRow['class'].'</td>
                <td><a href="update.php?studentId='.$tempRow['id'].'&read=Show+Student">Update </a></td>
                <td><a href="server.php?studentId='.$tempRow['id'].'&delete=Delete+Student">Delete </a></td>
            </tr>';
            }
        echo '</tbody>
        </div>';
    }

?>


<?php require_once("footer.php") ?>