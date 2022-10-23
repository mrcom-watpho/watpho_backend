<?php
class menu
{
    function Show($MenuActiveId)
    {
        /*$str='[{
            "icon":"fa-folder",
            "name":"Components",
            "link":"#",
            "sub":[{
                "icon":"fa-folder",
                "name":"Components",
                "link":"#"    
            },{
                "icon":"fa-folder",
                "name":"Components",
                "link":"#"    
            }]

        }]';
        $menu = json_decode($str);*/
        $menu = array(
            array('type' => 0, 'name' => 'Report'),//Head
            array(
                'type' => 1,'id' => '0100', 'icon' => 'fa-table', 'name' => 'รายงาน', 'link' => '#',
                'sub' => array(
                    array('type' => 0,'id' => '0101', 'name' => 'Report Sub'), //Head sub
                    array('type' => 1,'id' => '0102', 'name' => 'รายงานยอดขายรายวัน', 'link' => 'index.php?page=reportsale'),
                    array('type' => 1,'id' => '0103', 'name' => 'รายงานจำนวนตั๋ว', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_ticket'),
                    array('type' => 1,'id' => '0104', 'name' => 'รายงานการเข้าประตู', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_ticket_door'),
                    array('type' => 1,'id' => '0105', 'name' => 'รายงานการแลกน้ำ', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_ticket_water'),
                    array('type' => 1,'id' => '0106', 'name' => 'รายงาน Stock น้ำในตู้', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_stock_water'),
                    array('type' => 1,'id' => '0107', 'name' => 'รายงานการคืนตั๋ว', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_ticket_des'),
                    array('type' => 1,'id' => '0108', 'name' => 'รายงานจองตั๋ว Online', 'link' => 'https://watphotickets.com/main.php?t=setup&page=report_ticket_online')
                )
            ),
        //    array(
        //        'type' => 1,'id' => '0200', 'icon' => 'fa-folder', 'name' => 'Report', 'link' => '#',
        //        'sub' => array(
        //            array('type' => 0,'id' => '0201', 'name' => 'Report Sub'), //Head sub
         //           array('type' => 1,'id' => '0202', 'name' => 'ทดสอบ1', 'link' => '#'),
         //           array('type' => 1,'id' => '0203', 'name' => 'ทดสอบ2', 'link' => '#')
         //       )
         //   ),
        );
        //var_dump($menu);
        $Icon = 'fa-folder';
        $Link = '#';
        $Name = 'Components';
        for ($i = 0; $i < count($menu); $i++) {
            if ($menu[$i]['type'] == 0) {
?>
                <div class="sidebar-heading"><?php echo $menu[$i]['name']; ?></div>
            <?php } else if ($menu[$i]['type'] == 1) { ?>
                <li class="nav-item <?php if(substr($MenuActiveId,0,2)==substr($menu[$i]['id'],0,2)) echo 'active';?>">
                    <a class="nav-link collapsed" href="<?php echo $menu[$i]['link']; ?>" data-toggle="collapse" data-target="#collapseTwo<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseTwo<?php echo $i; ?>">
                        <i class="fas fa-fw <?php echo $menu[$i]['icon']; ?>"></i>
                        <span><?php echo $menu[$i]['name']; ?></span>
                    </a>
                    <?php if (isset($menu[$i]['sub'])) { ?>
                        <div id="collapseTwo<?php echo $i; ?>" class="collapse <?php if(substr($MenuActiveId,0,2)==substr($menu[$i]['id'],0,2)) echo 'show';?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <?php for ($j = 0; $j < count($menu[$i]['sub']); $j++) {
                                    if ($menu[$i]['sub'][$j]['type'] == 0) { ?>
                                        <h6 class="collapse-header"><?php echo $menu[$i]['sub'][$j]['name']; ?></h6>
                                    <?php } else if ($menu[$i]['sub'][$j]['type'] == 1) { ?>
                                        <a class="collapse-item <?php if($MenuActiveId==$menu[$i]['sub'][$j]['id']) echo 'active';?>" href="<?php echo $menu[$i]['sub'][$j]['link']; ?>"><?php echo $menu[$i]['sub'][$j]['name']; ?></a>
                                <?php }
                                } ?>
                            </div>
                        </div>
                </li>
<?php
                    }
                }
            }
        }
    }
   // $obmenu = new menu();
   // $obmenu->show();
?>