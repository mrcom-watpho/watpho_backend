<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ข้อมูล Stock ตู้น้ำ</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">water dispenser Stock</a></li>
</ol>

<h1 class="page-header">water dispenser stock<small>ข้อมูล Stock ตู้น้ำ</small></h1>
<a href="main.php?t=setting&page=water_stock_add" class="btn btn-info"><i class="fa fa-edit"></i> เพิ่มข้อมูล</a>
<hr>
<a href="main.php?t=setting&page=water_reset&id=1" class="btn btn-success">Reset ตู้น้ำ 1</a>
<a href="main.php?t=setting&page=water_reset&id=2" class="btn btn-danger">Reset ตู้น้ำ 2</a>
<hr>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">ข้อมูล Stock ตู้น้ำ</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                    class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                    class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                    class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                    class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="dgv-table" class="table table-striped table-bordered align-middle" >
            <thead>
                <tr>
                    <th width="100px">แก้ไข/ลบ</th>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">รหัสตู้น้ำ</th>
                    <th class="text-nowrap">Station</th>
                    <th class="text-nowrap">จำนวนทั้งหมด</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $db_category = new DB();
                    $sql_category = " SELECT  tb_water_stock.id, tb_water_stock.water_id, tb_water_stock.station_id, tb_water_stock.total, tb_water_stock.status, tb_water.id AS Expr1, tb_water.water_name  ";
                    $sql_category .= " FROM tb_water_stock INNER JOIN  tb_water ON tb_water_stock.water_id = tb_water.id ORDER BY tb_water_stock.water_id, tb_water_stock.id asc ";

                    $db_category->Execute($sql_category);
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['id'];
                        $gen_ids = $data_category['water_id'];
                ?>
                <tr>
                    <td><a href="main.php?t=setup&page=water_stock_edit&id=<?php echo $gen_id;?>&idwaters=<?php echo $gen_ids;?>"
                            class="btn btn-info"><i class="fa fa-edit"></i></a>
                        
                        </td>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['water_name'];?></td>
                    <td><?php echo $data_category['station_id'];?></td>
                    <td><?php echo $data_category['total'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--
    <a href="main.php?t=setup&page=water_stock_delete&id=<?php echo $gen_id;?>&idwaters=<?php echo $gen_ids;?>" onclick="return confirm('Are you sure delete?')"
                            class="btn btn-danger"><i class="fa fa-times"></i></a>
                            //-->