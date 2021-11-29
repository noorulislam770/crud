<?php include("header.php");

global $conn = new mysqli("localhost","root","","school") ;
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


function addUpdate($name,$fatherName,$dob,$class){
    if(!empty( $name && $fatherName &&  $dob && $class)){
        $createSql = "INSERT INTO students (name, fathername, dob, class) VALUES ('$name', '$fatherName','$dob',$class)";
        // echo $ssql;

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

    addUpdate($name,$fatherName,$dob,$class);

   
}

if(isset($_POST['update'])){
    $name = $_POST['studentName'];
    $fatherName = $_POST['fatherName'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];

}



if(isset($_POST['delete'])){
    echo $_POST['studentId'] ;
}



?>

</div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php include("footer.php") ?>