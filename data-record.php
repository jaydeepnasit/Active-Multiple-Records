<?php

include_once 'UDF/config.php';
$data_config = new Userfunction;

$count = 1;
$data_val = $data_config->showall('userdata', 'id');


?>

<table class="table table-hover table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Action</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data_val as $fetch_data){ ?>
        <tr>
            <td><?= $count;$count++ ?></td>
            <td>
                <input type="checkbox" name="status" class="check-box" data-dataid="<?= $fetch_data['id']; ?>">
            </td>
            <td><?= $fetch_data['u_name']; ?></td>
            <td><?= $fetch_data['u_email']; ?></td>
            <td>
                <?php
                    if($fetch_data['u_status'] == 0){
                        echo '<i class="far fa-times-circle fa-2x" style="color: red"></i>';
                    }
                    else{
                        echo '<i class="far fa-check-circle fa-2x" style="color: green"></i>';
                    }
                ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<script>

</script>
