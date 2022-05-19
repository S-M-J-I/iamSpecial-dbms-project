<?php $title = "Home" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>
<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <!-- Page Features-->
        <div class="row lg-2">
            <div>
                <h2 style="text-align:center;"><strong>Contact Us</strong></h2>
                <div class="card bg-light border-0 h-100">
                    <div class="container px-lg-5">
                        <form action="contact.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSubject1">Subject</label>
                                <input name="subject" type="text" class="form-control" id="exampleInputSubject1" placeholder="Enter Subject" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputbody1">Body</label>
                                <textarea name="body" type="text" class="form-control" rows="10" id="exampleInputbody1" placeholder="Enter body" required></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
                <?php

                ?>
                <br>
            </div>
            <br>
        </div>
    </div>
</section>
<br>
<br>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>