<?php include("header.php");

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


function update($id,$name,$fatherName,$dob,$class){
    if(!empty($id && $name && $fatherName &&  $dob && $class)){
        $createSql = " UPDATE students SET name='$name', fatherName='$fatherName', dob='$dob', class='$class' WHERE id=$id ";
        // echo $ssql;
        global $conn;
        if(mysqli_query($conn,$createSql)){
            // echo "Record Added Successfully!";
            $tempSql = "SELECT id FROM students WHERE name LIKE '$name' AND fathername LIKE '$fatherName' ";
            // echo "Sql " . $tempSql;
            $tempResult = $conn->query($tempSql);
            
            
            echo '
        <div class="card">
        <h5 class="card-header">Record Updated Successfully!</h5>
            <div class="card-body">
                <h5 class="card-title">Note Student ID</h5>
                <p class="card-text">Please Remember the student ID.</p>
                <h5 class="card-header">'. $id .'</h5>
                <a href="index.php" class="btn btn-lg btn-success">Main Page</a>
            </div>
        </div>
        ';

        displayForm($id,$name,$fatherName,$dob,$class);

        }else{
            echo "Some problem";
        }

    }else{
        echo '
        <div class="card">
        <h5 class="card-header">Warning</h5>
            <div class="card-body">
                <h5 class="card-title">Give Complete Info</h5>
                <p class="card-text">Please Enter full Information. click below to go back.</p>
                <a href="update.php" class="btn btn-warning">Go Back</a>
            </div>
        </div>
        ';
    }
}

function displayForm($id,$name,$fatherName,$dob,$class){

    echo '
    <form action="#">
    <div class="form-group">
        <label for="studentId">Student ID</label>
        <input type="number" class="form-control " disabled name="studentId" value="'.$id.'"  id="studentId" aria-describedby="helpId" placeholder="Student ID">
        <small id="helpId" class="form-text text-muted">ID</small>
    </div>
    <div class="form-group">
        <label for="studentName">Name</label>
        <input type="text" class="form-control " disabled name="studentName" value="'.$name.'"  id="studentName" aria-describedby="helpId" placeholder="Your Name">
        <small id="helpId" class="form-text text-muted">Name</small>
    </div>
    <div class="form-group">
        <label for="fatherName">Father Name</label>
        <input type="text" class="form-control " disabled name="fatherName" id="fatherName" value="'.$fatherName.'" aria-describedby="helpId" placeholder="Father Name">
        <small id="helpId" class="form-text text-muted">Father Name</small>
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth</label>
    <input type="date" class="form-control " disabled value="'.$dob.'" name="dob" id="dob" >
    </div>
    <div class="form-group">
        <label for="class">Class</label>
        <input type="number" class="form-control " disabled value="'.$class.'"  name="class" id="class" placeholder="1-10">
    </div>

</form>
    ';
    

}


function add($name,$fatherName,$dob,$class){
    if(!empty( $name && $fatherName &&  $dob && $class)){
        $createSql = "INSERT INTO students (name, fathername, dob, class) VALUES ('$name', '$fatherName','$dob',$class)";
        // echo $ssql;
        global $conn;
        if(mysqli_query($conn,$createSql)){
            // echo "Record Added Successfully!";
            $tempSql = "SELECT id FROM students WHERE name LIKE '$name' AND fathername LIKE '$fatherName' ";
            // echo "Sql " . $tempSql;
            $tempResult = $conn->query($tempSql);
            $stId = 0 ;
            if($tempResult->num_rows > 0){
                while($tempRow =  $tempResult->fetch_assoc()){
                    $stId = $tempRow['id'];
                }
            }
            
            echo '
        <div class="card">
        <h5 class="card-header">Record Added Successfully!</h5>
            <div class="card-body">
                <h5 class="card-title">Note Student ID</h5>
                <p class="card-text">Please Remember the student ID.</p>
                <h5 class="card-header">'. $stId .'</h5>
                <a href="index.php" class="btn btn-lg btn-success">Main Page</a>
            </div>
        </div>

        
        ';
        displayForm($stId,$name,$fatherName,$dob,$class);




        }else{
            echo "Some problem";
        }

    }else{
        echo '
        <div class="card">
        <h5 class="card-header">Warning</h5>
            <div class="card-body">
                <h5 class="card-title">Give Complete Info</h5>
                <p class="card-text">Please Enter full Information. click below to go back.</p>
                <a href="update.php" class="btn btn-warning">Go Back</a>
            </div>
        </div>
        ';
    }
}

?>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

<?php 

if(isset($_POST['create'])){
    $name = $_POST['studentName'];
    $fatherName = $_POST['fatherName'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];

    add($name,$fatherName,$dob,$class);

   
}

if(isset($_POST['update'])){
    $id = $_POST['studentId'];
    $name = $_POST['studentName'];
    $fatherName = $_POST['fatherName'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];
    update($id,$name,$fatherName,$dob,$class);

}



if(isset($_GET['delete'])){
    $id = $_GET['studentId'];
    $tempSql = "SELECT * FROM students WHERE id=$id ";
            // echo "Sql " . $tempSql;
            $tempResult = $conn->query($tempSql);
            $stId = 0 ;
            if($tempResult-> num_rows > 0){
                while($tempRow =  $tempResult->fetch_assoc()){
                    $stId = $tempRow['id'];
                    echo '<h1 class="text-center"> Confirm Deletion! </h1>';
                    displayForm($tempRow['id'],$tempRow['name'],$tempRow['fathername'],$tempRow['dob'],$tempRow['class']);
                }
                echo '
                <form action="server.php" method="post">
                <input type="number"  name="delStdId" class="form-control"  value='. $id .'>
                <input name="confirmDelete" id="confrimDelete" class="btn btn-danger mt-2" type="submit" value="Delete Student!">
                    <a class= "btn btn-success mt-2" href="delete.php">Go Back</a> 
                </form>
                ';
            }
            else {
                showError("Invalid Id","Student with that id doesnt exists to delete.","delete");
            }

    

}

if (isset($_POST['confirmDelete'])){
    $id = $_POST["delStdId"];
    $tempSql = "DELETE FROM students WHERE id=$id ";
    // echo "Sql " . $tempSql;
    global $conn;
    if(mysqli_query($conn,$tempSql)){
        echo '
        <div class="card">
        <h5 class="card-header">Success</h5>
            <div class="card-body">
                <h5 class="card-title">Student Delted Successfully.</h5>
                <p class="card-text">Student data was successfully Removed.</p>
                <a href="index.php" class="btn btn-warning">Go Back</a>
            </div>
        </div>
        ';
    }
    else{
        echo "Some Error Occured!";
    }
}
    
    


if(isset($_POST['read'])){
    // var_dump($_POST);
    if ($_POST['studentId'] != ""){

        $id = $_POST['studentId'];
        $tempSql = "SELECT * FROM students WHERE id=$id ";
        // echo "Sql " . $tempSql;
        $tempResult = $conn->query($tempSql);
        $stId = 0 ;
        if($tempResult->num_rows > 0){
            renderTable($tempResult);

        }
        else{
            showError("Invalid Student ID","No student with that id is available","read");
        }
    }
    else if ($_POST['name'] != ""){
        $name = $_POST['name'];
        $tempSql = "SELECT * FROM students WHERE name LIKE '%$name%' ";
        // echo "Sql " . $tempSql;
        $tempResult = $conn->query($tempSql);
        $stId = 0 ;
        if($tempResult->num_rows > 0){
            renderTable($tempResult);
        }
        else{
            showError("Invalid Student ID","No student with that id is available","read");
        }
    }else{
        showError("Empty Request","Either Enter a Student name or student ID","read");
    }
}

function renderTable($tempResult){
    
    echo'
    <div class="container">
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
        </div>
    ';
}

function showError($title,$message,$page){
    echo '
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
        <div class="card-header">Danger</div>
        <div class="card-body">
        <h5 class="card-title">'.$title.'</h5>
        <p class="card-text">'.$message.'</p>
        <a href="'.$page.'.php" class="btn btn-primary mt-2" > Go Back </a>

    </div>
  </div>    
    ';
}

?>



</div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include("footer.php") ?>