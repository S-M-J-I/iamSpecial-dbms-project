<div class="sb-sidenav-menu-heading">Core</div>
<a class="nav-link" href="index.php">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Dashboard
</a>

<!-- ADMIN TOOLS CONTROLS -->
<div class="sb-sidenav-menu-heading">Admin Tools</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdminToolsLayouts" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-duotone fa-plus"></i></div>
    Create
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseAdminToolsLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="view_admin.php">Admit Admin</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="categories.php">Blog Categories</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="forum-categories.php">Forum Categories</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="institutions.php">Institution</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="fundraiser.php">Fundraiser</a>
    </nav>
</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
    Profile
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
        <a class="nav-link" href="profile.php">Edit Profile</a>
    </nav>
</div>


<!-- ADMIN INTERACTION CONTROLS -->
<div class="sb-sidenav-menu-heading">Interaction</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayout" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    Featured Posts
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLayout" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="posts.php">Create a Post</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="layout-sidenav-light.php">Create a Forum Discussion</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="layout-sidenav-light.php">Create a Notification</a>
    </nav>
</div>


<!-- ADMIN VERIFICATION CONTROLS -->
<div class="sb-sidenav-menu-heading">Verifications</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVerify" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-solid fa-user-check"></i></div>
    Verify
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseVerify" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="verification.php?type=user">Users</a>
    </nav>
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="verification.php?type=counselor">Counselors</a>
    </nav>
</div>
<a class="nav-link" href="approve-fundraiser.php">
    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
    Approve Fundraisers
</a>