
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
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <a href="/agent-details?id="<?php echo 2 ?>>
            
               

                <?php
                    if(count($response) > 0) {
                        foreach($response as $key => $value) {
                          
                            echo "<tr>"; 
                            echo "<td>".( $key+1)."</td>";
                            echo "<td>".$value['agent_title']."</td>";
                            echo "<td>".$value['email']."</td>";
                            echo "<td>".$value['phone']."</td>";
                            echo "<td>".$value['address']."</td>";
                            echo "<td>".$value['avg_rating']."</td>";
                            // echo ' </a>';

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