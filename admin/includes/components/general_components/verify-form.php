<form action="profile-verify.php" method="POST" enctype="multipart/form-data">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="id1">
                <strong>Add NID Front Part</strong>
            </label>
            <div class="col-lg-5">
                <div class="form-group input-group">
                    <input name="id1" class="form-control" placeholder="Change Photo" type="file">
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="form-label" for="id2">
                <strong>Add NID Back Part</strong>
            </label>
            <div class="col-lg-5">
                <div class="form-group input-group">
                    <input name="id2" class="form-control" placeholder="Change Photo" type="file">
                </div>
            </div>
        </div>

        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Re-enter NID number</strong> </span>
            </div>
            <input name="NID" class="form-control" placeholder="Re-enter your NID number as given on the card" type="text">
        </div>
        <br>
        <div class="form-group">
            <button name="verify" type="submit" class="btn btn-primary btn-block"> Request Verification </button>
        </div>
    </div>
</form>
<?php addToVerificationQueue() ?>