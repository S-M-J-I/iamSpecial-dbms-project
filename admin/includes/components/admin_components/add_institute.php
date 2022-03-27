<form action="institutions.php?target=add" method="POST" enctype="multipart/form-data">
    <div class="col-lg-6">
        <div class="form-group">
            <h5>Details</h5>
        </div>
        <hr>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Name</strong> </span>
            </div>
            <input name="name" class="form-control" placeholder="Write institute name" type="text">
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>About</strong> </span>
            </div>
            <textarea name="about" class="form-control" placeholder="Write institute details" cols="30" rows="10"></textarea>
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Phone</strong> </span>
            </div>
            <input name="phone" class="form-control" placeholder="Write institute phone" type="text">
        </div>
        <br>
        <br>
        <div class="form-group">
            <h5>Address</h5>
        </div>
        <hr>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Street</strong> </span>
            </div>
            <input name="street" class="form-control" placeholder="Street" type="text">
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Area</strong> </span>
            </div>
            <input name="area" class="form-control" placeholder="Area" type="text">
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>City</strong> </span>
            </div>
            <input name="city" class="form-control" placeholder="City" type="text">
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>State</strong> </span>
            </div>
            <select name="city">
                <option value="Dhaka">Dhaka</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Khulna">Khulna</option>
                <option value="Barisal">Barisal</option>
                <option value="Mymensingh">Mymensingh</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Rangpur">Rangpur</option>
            </select>
        </div>
        <br>
        <br>
        <div class="form-group">
            <h5>Institution type & Picture</h5>
        </div>
        <hr>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Type</strong> </span>
            </div>
            <input name="type" class="form-control" placeholder="Insitution type" type="text">
        </div>
        <br>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <strong>Upload institution image (850x350)</strong> </span>
            </div>
            <input name="picture" class="form-control" id="img" placeholder="Add picture" type="file">
        </div>
        <br>
        <div class="form-group">
            <button name="add" type="submit" class="btn btn-primary btn-block"> Add Institution </button>
        </div>
        <br>
        <br>
    </div>
    <?php

    // TODO: TEST IF THIS WORKS OR NOT

    ?>
    <?php addInstitute() ?>
</form>