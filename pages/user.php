<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ข้อมูลผู้ใช้งาน</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Data User</a></li>
</ol>

<h1 class="page-header">User <small>ข้อมูลผู้ใช้งาน</small></h1>
<a href="main.php?t=setting&page=user_add" class="btn btn-info"><i class="fa fa-edit"></i> เพิ่มข้อมูล</a>
<hr>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">ข้อมูลผู้ใช้งาน</h4>
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
                    <th class="text-nowrap">รูป</th>
                    <th class="text-nowrap">ชื่อ - นามสกุล</th>
                    <th class="text-nowrap">Email/User</th>
                    <th class="text-nowrap">Station</th>
                    <th class="text-nowrap">ระดับ</th>
                    <th width="70px">แก้ไข</th>
                    <th width="70px">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $db_category = new DB();
                    $sql_category = " SELECT * FROM  tb_user ORDER BY id asc  ";

                    $db_category->Execute($sql_category);
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['id'];
                ?>
                <tr>
                    
                    <td><?php echo $i;?></td>
                    <td><img src="uploads/<?php echo $data_category['user_image'];?>" alt="" class="box"  /></td>
                    <td><?php echo $data_category['fname'];?> <?php echo $data_category['lname'];?></td>
                    <td><?php echo $data_category['email'];?></td>
                    <td><?php echo $data_category['station'];?></td>
                    <td><?php echo $data_category['type_name_th'];?></td>
                    <td><a href="main.php?t=setup&page=user_edit&id=<?php echo $gen_id;?>"
                            class="btn btn-yellow"><i class="fa fa-edit"></i>แก้ไข</a></td>
                     <td>   <a href="main.php?t=setup&page=user_delete&id=<?php echo $gen_id;?>" onclick="return confirm('Are you sure delete?')"
                            class="btn btn-danger"><i class="fa fa-times"></i>ลบ</a>
                        </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>