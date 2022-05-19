<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Request for a Fundraiser</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Fundraiser</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="request-fundraiser.php" method="POST">
                            <div class="col-lg-6">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Set Title</strong> </span>
                                    </div>
                                    <input name="title" class="form-control" placeholder="Enter title of fundraiser" type="text" required>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Set Description</strong> </span>
                                    </div>
                                    <input name="description" class="form-control" placeholder="Enter description of fundraiser" type="text" required>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Target Amount</strong> </span>
                                    </div>
                                    <input name="total_target" class="form-control" placeholder="Enter target amount" type="text" required>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Duration</strong> </span>
                                    </div>
                                    <input name="duration" class="form-control" placeholder="Enter duration of fundraiser" type="text" required>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Account type</strong> </span>
                                    </div>
                                    <select name="type">
                                        <option value="MFS">MFS</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Internet Banking">Internet Banking</option>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Bank/MFS name</strong> </span>
                                    </div>
                                    <input name="bank_name" class="form-control" placeholder="eg. Bkash/EBL/Islamia Bank" type="text" required>
                                </div>
                                <br>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Account Number</strong> </span>
                                    </div>
                                    <input name="bank_acc_num" class="form-control" placeholder="Enter Account number" type="text" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button name="add" type="submit" class="btn btn-primary btn-block"> Request for Fundraiser </button>
                                </div>
                                <?php addFundraiser()
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>