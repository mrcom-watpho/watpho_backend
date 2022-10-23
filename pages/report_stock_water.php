<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">รายงานข้อมูลน้ำในตู้</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Report stock water</a></li>
</ol>

<h1 class="page-header">Report <small>Stock water</small></h1>

<hr>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">รายงานข้อมูลน้ำในตู้แต่ละโซน</h4>
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
        <table id="dgv-table" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">ชื่อตู้น้ำ</th>
                    <th class="text-nowrap">Zone</th>
                    <th class="text-nowrap">น้ำคงเหลือ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db_category = new DB();
                $sql_category = "SELECT sum(tb_water_stock.total) as stock_total, tb_water.id AS id_water, tb_water.water_name, 
                tb_water.water_zone, tb_water_stock.water_id
                FROM  tb_water_stock INNER JOIN tb_water ON tb_water_stock.water_id = tb_water.id
                group by tb_water.id,tb_water.water_name, tb_water.water_zone, tb_water_stock.water_id ";
                $db_category->Execute($sql_category);
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['pos_id'];
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['water_name'];?></td>
                    <td><?php echo $data_category['water_zone'];?></td>
                    <td><?php echo $data_category['stock_total'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>