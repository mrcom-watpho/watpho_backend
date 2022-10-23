<?php
//include("ReportWatpho/includes/database.php");
//include_once("ReportWatpho/includes/database.php");
?>
<div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        เวลาดึงข้อมูล
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="SetTime(1)">1S</a>
                        <a class="dropdown-item" href="#" onclick="SetTime(5)">5S</a>
                        <a class="dropdown-item" href="#" onclick="SetTime(10)">10S</a>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="widget widget-stats bg-blue">
                       <div class="stats-icon"><i class="fas fa-clock"></i></div>
                         <div class="stats-info">
                          <h2>เวลาล่าสุด</h2>
                          <p><div class="h3 mb-0 font-weight-bold text-gray-800" id="updateTime"></div></p>
                         </div>
                       <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                   </div>
                  </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="widget widget-stats bg-yellow">
                        <div class="stats-icon"><i class="fas fa-dollar-sign"></i></div>
                           <div class="stats-info">
                             <h2>ยอดขาย(วัน)</h2>
                            <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_price"></div></p>
                    </div>
                    <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                   </div>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fas fa-sign-in-alt"></i></div>
                <div class="stats-info">
                <h2>ผ่านประตู</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_Door"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>


                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="stats-info">
                <h2>คืนตั๋ว</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_Reticket"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>
               

                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="stats-info">
                <h2>ยอดรวมตั๋วทั้งหมด</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_ticket"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="stats-info">
                <h2>ยอดรวมตั๋ว(ลูกค้าทั่วไป)</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_diff"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="stats-info">
                <h2>ยอดรวมตั๋ว(กรุ๊ปทัวร์)</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_group"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>


                <div class="col-xl-3 col-md-6 mb-4">
                <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fas fa-tint"></i></div>
                <div class="stats-info">
                <h2>น้ำ</h2>
                <p> <div class="h3 mb-0 font-weight-bold text-gray-800" id="Total_Water"></div></p>
                </div>
                <div class="stats-link">
                <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
                </div>
                </div>

                
               
            </div>


            <?php
            $colorBorder = array('','border-left-success','border-left-warning','border-left-primary','border-left-danger');
            $icon = array('','fa-user','fa-desktop','fa-ticket-alt');
            $db = new DB();
            $txtSQL = "SELECT pos_zone as door_zone
            FROM tb_pos_station
            GROUP BY pos_zone";
            $db->Execute($txtSQL);
            $DataZone = array();
            $POSStation = array();
            while ($row = $db->getData()) {
                $DataZone[] =  $row['door_zone'];
                $POSStation[$row['door_zone']] = array();
                $DoorStation[$row['door_zone']]=array();
            }
            $txtSQL = "SELECT pos_id,pos_zone,pos_location,pos_type FROM tb_pos_station  ORDER BY pos_type";
            $db->Execute($txtSQL);
            while ($row = $db->getData()) {
                $PosZone = $row['pos_zone'];
                $POSStation[$PosZone][] = array($row['pos_id'], $row['pos_location'], $row['pos_type']);
            }
            $txtSQL = "SELECT door_ip,door_zone FROM tb_door ORDER BY door_ip";
            $db->Execute($txtSQL);
            while ($row = $db->getData()) {
                $door_zone = $row['door_zone'];
                $DoorStation[$door_zone][] = array($row['door_ip']);
            }
            for ($i = 0; $i < count($DataZone); $i++) {
            ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h2 class="m-0 font-weight-bold text-primary" Name="Zone"><?php echo $DataZone[$i]; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            //////////////POS,KIOSK
                            for ($j = 0; $j < count($POSStation[$DataZone[$i]]); $j++) {
                            ?>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-0 text-truncate mb-3 bg-gray-800 text-white">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2" style="padding:10px">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h2><font color="#FFF"><?php echo $POSStation[$DataZone[$i]][$j][1]; ?></font></h2>
                                                        </div>

                                                        <div class="col-md-6" style="float: right; text-align: right;">
                                                            <h2 class="text-white mb-0"><span id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>price">0.00</span></h2>
                                                        </div>
                                                    </div>
                                                    
    
                                                    <hr class="bg-white bg-opacity-50">
                                                    <h5><i class="fa fa-circle text-red fs-8px me-2"></i>&nbsp;พนักงาน<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>fname"></span></h5>
                                                    <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;ลูกค้าทั่วไป<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket_diff"></span></h5>
                                                    <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;กรุ๊ปทัวร์<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket_group"></span></h5>
                                                    <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;ยอดรวมตั๋วทั้งหมด<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket"></span></h5>
                                                    <h5><i class="fa fa-circle text-yellow fs-8px me-2"></i>&nbsp;ประตู<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>door"></span></h5>
                                                    <h5><i class="fa fa-circle text-orange fs-8px me-2"></i>&nbsp;น้ำ<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>water"></span></h5>
                                                    <h5><i class="fa fa-circle text-info fs-8px me-2"></i>&nbsp;คืนตั๋ว<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>reticket"></span></h5>
                                                </div>
                                                <div class="col-auto">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ///////////////DOOR
                            /*
                            for ($j = 0; $j < count($DoorStation[$DataZone[$i]]); $j++) {
                            ?>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card <?php echo $colorBorder[3];?> shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-lg font-weight-bold text-success text-uppercase mb-1"><?php echo 'Door '.$DoorStation[$DataZone[$i]][$j][0]; ?></div>
                                                    <h4 class="small font-weight-bold">ผ่านประตู<span class="float-right" id="DOOR<?php echo $POSStation[$DataZone[$i]][$j][0];?>"></span></h4>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }*/
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
          
                         
                         


            
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->


        </div>

   
