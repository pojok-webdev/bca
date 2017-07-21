<!-- left, vertical navbar -->
<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <li class="<?php echo ($feedData==='processimport')?'active':'';?>">
            <a href="/records"><i class="glyphicon glyphicon-chevron-right"></i> Records</a>
        </li>
        <li class="<?php echo ($feedData==='settings')?'active':'';?>">
            <a href="/settings"><i class="glyphicon glyphicon-chevron-right"></i> Setting</a>
        </li>
        <?php if($role==="1"){?>
        <li class="<?php echo ($feedData==='users')?'active':'';?>">
            <a href="/users"><i class="glyphicon glyphicon-chevron-right"></i> User</a>
        </li>
        <?php }?>
    </ul>
</div>
