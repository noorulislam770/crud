<?php 
require_once("header.php");
$conn = new mysqli("localhost","root","","school") ;


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

            

        

<?php
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


if (isset($_GET['read'])){
    $id = $_GET['studentId'];
    $tempSql = "SELECT * FROM students WHERE id=$id ";
    // echo "Sql " . $tempSql;
    $tempResult = $conn->query($tempSql);
    $stId = 0 ;
    if($tempResult->num_rows > 0){
        $tempResult = $tempResult->fetch_assoc();
        echo '
        
        
        
        
            
            <form method="post" action="server.php">
                <div class="form-group">
                    <label for="studentId">Student ID</label>
                    <input type="number" class="form-control" name="studentId" id="studentId" aria-describedby="helpId" value="'.$tempResult['id'].'" placeholder="Student ID">
                    <small id="helpId" class="form-text text-muted">ID</small>
                </div>
                <div class="form-group">
                    <label for="studentName">Name</label>
                    <input type="text" class="form-control" name="studentName" id="studentName" value="'.$tempResult['name'].'"  aria-describedby="helpId" placeholder="Your Name">
                    <small id="helpId" class="form-text text-muted">Name</small>
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" class="form-control" name="fatherName" id="fatherName" aria-describedby="helpId" value="'.$tempResult['fathername'].'"  placeholder="Father Name">
                    <small id="helpId" class="form-text text-muted">Father Name</small>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" value="'.$tempResult['dob'].'"  name="dob" id="dob" >
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="number" class="form-control" name="class"  value="'.$tempResult['class'].'"  id="class" placeholder="1-10">
                </div>
                <input name="update" id="update" class="btn btn-primary" type="submit" value="Update Student">
                
            </form>
            
            
            
        

    ';
    }else {
        showError("ID Doesnt Exists","Ensure to put a valid student ID ","update");
    }
}else{
    echo '
    <form method="get" action="update.php">
                <div class="form-group">
                    <label for="studentId">Student.ID Number</label>
                    <input type="number" required class="form-control" name="studentId" id="studentId" aria-describedby="helpId" placeholder="Student ID">
                    <small id="helpId" class="form-text text-muted">ID</small>
                </div>
                
                <input name="read" id="read" class="btn btn-primary" type="submit" value="Show Student">

            </form>
            <form method="get" action="read.php">
                <input class="form-control btn btn-primary mt-2" type="submit" name="readall" value="Show All Students">
            </form>
    ';
}
?>

</div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php require_once("footer.php") ?>