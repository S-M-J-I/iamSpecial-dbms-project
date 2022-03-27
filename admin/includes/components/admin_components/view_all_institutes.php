<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>About</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Type</th>
            <th>Picture</th>
        </tr>
    </thead>
    <tbody><?php getAllInstitutions(); ?>
    </tbody>
</table>

<br>
<div style="text-align: left;" class="col-lg-12">
    <a class="btn btn-primary" href="institutions.php?target=add"> <i class="fas fa-plus"></i> Add Institution</a>
    <br>
</div>