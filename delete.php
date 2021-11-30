<?php require_once("header.php") ?>



<div class="container p-3">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form method="post" action="server.php">
                <div class="form-group">
                    <label for="studentId">Student.ID Number</label>
                    <input type="number" class="form-control" name="studentId" id="studentId" aria-describedby="helpId" placeholder="Student ID">
                    <small id="helpId" class="form-text text-muted">ID</small>
                </div>
                
                <input name="delete" id="delete" class="btn btn-danger" type="submit" value="Delete Student">
            
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>






<?php require_once("footer.php") ?>