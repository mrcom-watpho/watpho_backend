<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ข้อมูลตู้น้ำ</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">water date</a></li>
</ol>

<h1 class="page-header">water data <small>ข้อมูลตู้น้ำ</small></h1>
<a href="main.php?t=setting&page=water_add" class="btn btn-info"><i class="fa fa-edit"></i> เพิ่มข้อมูล</a>
<hr>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">ข้อมูลตู้น้ำ</h4>
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
                    <th width="100px">แก้ไข/ลบ</th>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">ชื่อตู้น้ำ</th>
                    <th class="text-nowrap">Lacation</th>
                    <th class="text-nowrap">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $db_category = new DB();
                    $sql_category = " SELECT * FROM tb_water ORDER BY id asc  ";

                    $db_category->Execute($sql_category);
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['id'];
                ?>
                <tr>
                    <td><a href="main.php?t=setup&page=water_edit&id=<?php echo $gen_id;?>"
                            class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="main.php?t=setup&page=water_delete&id=<?php echo $gen_id;?>" onclick="return confirm('Are you sure delete?')"
                            class="btn btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['water_name'];?></td>
                    <td><?php echo $data_category['water_location'];?></td>
                    <td><?php echo $data_category['status'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>