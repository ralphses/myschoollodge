
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Requests</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Requests</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
 
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Customer information</th>
                    <th>Lodge information</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    if(count($response['user requests']) > 0) {
                        foreach($response['user requests'] as $key => $value) {

                            echo "<tr>"; 
                            echo "<td>".( $key+1)."</td>";
                            echo "<td>".$value['fullname']."<br>".$value['contact']."</td>";
                            echo "<td>".$value['prop_name']."</td>";

                            if($value['stage'] == -1) echo '<td><span class="badge bg-danger">Initiated</span></td>';
                            if($value['stage'] == 1) echo '<td><span class="badge bg-success">Accepted</span></td>';
                            if($value['stage'] == 2) echo '<td><span class="badge btn-secondary">Concluded</span></td>';

                            echo '<td>
                            <button data-code="'.$value["code"].'" class="btn icon icon-left btn-primary btn-sm accept_reqBtn" style="margin: 3px;">Accept</button>
                            <button data-code="'.$value["code"].'" class="btn icon icon-left btn-danger btn-sm reject_reqBtn" style="margin: 3px;">Reject</button>
                           </td>';
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