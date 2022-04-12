<div class="sb-sidenav-menu-heading">Core</div>
<a style="color: white;" class="nav-link" href="index.php">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<!-- USER CONTROLS -->
<div class="sb-sidenav-menu-heading">Profile Settings</div>
<a style="color: white;" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    Profile
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        <a style="color: white;" class="nav-link" href="profile.php">Edit Profile</a>
    </nav>
    <?php

    if (!isVerified($_SESSION["id"])) {
        echo "
        <nav class='sb-sidenav-menu-nested nav accordion' id='sidenavAccordionPages'>
            <a style='color: white;' class='nav-link' href='profile-verify.php'>Verify My Profile</a>
        </nav>
        ";
    }

    ?>
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        <a style="color: white;" class="nav-link" href="">Delete Profile</a>
    </nav>
</div>



<!-- USER EXPERIENCE CONTROLS -->
<div class="sb-sidenav-menu-heading">My Interactions</div>
<a style="color: white;" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayout" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-duotone fa-thumbs-up"></i></div>
    My Favourites
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayout" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a style="color: white;" class="nav-link" href="layout-sidenav-light.php">Posts</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a style="color: white;" class="nav-link" href="layout-sidenav-light.php">Forums</a>
    </nav>
</div>
<a style="color: white;" class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMyPosts" aria-expanded="false" aria-controls="collapsePages">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    My Posts
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseMyPosts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        <a style="color: white;" class="nav-link" href="">Forum Posts</a>
    </nav>
</div>
<a style="color: white;" class="nav-link" href="#">
    <div class="sb-nav-link-icon"><i class="fas fa-duotone fa-book-medical"></i></div>
    Counsilor Bookings
</a>