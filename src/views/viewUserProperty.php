<?php

use src\utils\Location;

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
 
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    if(count($response) > 0) {
                        foreach($response as $key => $value) {
                            echo "<tr>"; 
                            echo "<td>".$value['code']."</td>";
                            echo "<td>".$value['title']."</td>";
                            echo "<td>".Location::getFullLocation($value['id'])."</td>";

                            if($value['status'] == -1) echo '<td><span class="badge bg-danger">Inactive</span></td>';
                            if($value['status'] == 1) echo '<td><span class="badge bg-success">Active</span></td>';
                            if($value['status'] == 2) echo '<td><span class="badge btn-secondary">On request</span></td>';
                            if($value['status'] == 3) echo '<td><span class="badge btn-success">Rented</span></td>';

                            echo '<td>
                            <button data-code="'.$value["code"].'" class="btn icon icon-left btn-danger btn-sm delete_propBtn" style="margin: 3px;">
                            <i data-feather="alert-circle"></i>Delete
                            </button>
                            <a href="/user-add-lodge?prop_code='.$value["code"].'" class="btn icon icon-left btn-primary btn-sm edit_propBtn" style="margin: 3px;"><i data-feather="alert-circle">
                            </i>Edit</a></td>';
                        }
                    }

                    else {
                        echo '<div class="card-header">
                       No Data! <a href="/user-add-lodge"><strong>Add Lodge</strong></a>
                    </div>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>