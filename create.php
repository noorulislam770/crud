<?php require_once("header.php") ?>


<div class="container p-3">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form method="post" action="server.php">
                <div class="form-group">
                    <label for="studentName">Name</label>
                    <input type="text" class="form-control" name="studentName" id="studentName" aria-describedby="helpId" placeholder="Your Name">
                    <small id="helpId" class="form-text text-muted">Name</small>
                </div>
                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" class="form-control" name="fatherName" id="fatherName" aria-describedby="helpId" placeholder="Father Name">
                    <small id="helpId" class="form-text text-muted">Father Name</small>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" >
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="number" class="form-control" name="class" id="class" placeholder="1-10">
                </div>
                <input name="create" id="create" class="btn btn-primary" type="submit" value="Create Student">
            
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>








<?php require_once("footer.php") ?>