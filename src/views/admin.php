<?php 
echo '<pre>'; var_dump($response); echo '</pre>';;

?>
<div class="page-heading">
                <h3>Welcome <strong><?php

use src\models\ModelDAO\AgentDAO;

 echo $response['full_name'] ?? 0; ?></strong> </h3>
            </div>
          
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Lodges</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $response['total_lodges'] ?? 0?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Requests</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $response['total_request'] ?? 0?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pending Requests</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $response['total_pending_request'] ?? 0?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Completed Requests</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $response['total_completed_request'] ?? 0?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Latest Activities</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th><strong>DATE</strong></th>
                                                        <th><strong>ACTIVITY</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                    if(count($response['activities']) > 0) {
                                                        foreach($response['activities'] as $activity) {
                                                            
                                                            echo "<tr>";
                                                            echo '<td class="col-3">';
                                                            echo '<div class="d-flex align-items-center">';
                                                            echo '<p class="font-bold ms-3 mb-0">'.date('d-M-Y', strtotime($activity['date_added'])).'</p>';
                                                            echo '</div>';
                                                            echo '</td>';
                                                            echo '<td class="col-auto">';
                                                            echo '<p class=" mb-0">'.$activity['activity'].'</p>';
                                                            echo '</td>';
                                                            echo "<tr>";
                                                        }
                                                    }

                                                    else {
                                                            echo "<tr>";
                                                            echo '<td class="col-auto">';
                                                            echo '<p class=" mb-0">No recent activity!</p>';
                                                            echo '</td>';
                                                            echo "<tr>";
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <a href="/modify-agent">
                                        <div class="avatar avatar-xl">
                                            <img src="assets/user/assets/images/faces/1.jpg" alt="Face 1">
                                        </div>
                                        <div class="ms-3 name">
                                            <h5 class="font-bold"><?php echo $response['full_name'] ?? 'User'?></h5>
                                            <h6 class="text-muted mb-0"><?php echo $response['email'] ?? 0?></h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Requests</h4>
                            </div>
                            <div class="card-content pb-4">

                            <?php 
                                if(count($response['recent_request']) > 0 ) {
                                    foreach($response['recent_request'] as $req) {
                                        echo '<div class="recent-message d-flex px-4 py-3">';
                                        echo '<div class="name ms-4">';
                                        echo '<h5 class="mb-1">'.$req.'</h5>';
                                        echo '</div>';
                                        echo '</div>';

                                    }
                                }
                            ?>

                            </div>
                        </div>

                    </div>
                </section>
            </div>