<!DOCTYPE html>
<html>
    <head>
        <title>Import dari file CSV</title>
        <?php
        $this->load->view("commons/headcontent");
        ?>
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <?php $this->load->view("commons/topmenu");?>
        <!-- main / large navbar -->
        <?php $this->load->view("commons/level2menu");?>
        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <?php $this->load->view("commons/horizontalmenu");?>
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="head panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Excel Import</div>
                                    <button class="xright btn btn-sm btn-default" id="btnsavedata">
                                        <i class="glyphicon glyphicon-plus"></i> Simpan
                                    </button>
                                    <button class="xright btn btn-sm btn-default" id="btnoutput">
                                        <i class="glyphicon glyphicon-plus"></i> Output
                                    </button>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                <input type="hidden" id="record_id" value="<?php echo $record_id;?>">
                                    <table class="table table-striped table-bordered" id="tProcess">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Jumlah</th>
                                                <th>Nama</th>
                                                <th>Kode 1</th>
                                                <th>Kode 2</th>
                                                <th>Kode 3</th>
                                                <th>Bulan</th>
                                                <th>Tahun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($results as $obj){?>
                                            <tr class="odd gradeX">
                                                <td class="data"><?php echo $obj["id"];?></td>
                                                <td class="data"><?php echo $obj["idr"];?></td>
                                                <td class="data"><?php echo $obj["name"];?></td>
                                                <td class="data"><?php echo $obj["kd1"];?></td>
                                                <td class="data"><?php echo $obj["kd2"];?></td>
                                                <td class="data"><?php echo $obj["kd3"];?></td>
                                                <td class="data"><?php echo $obj["month"];?></td>
                                                <td class="data"><?php echo $obj["year"];?></td>
                                                <td class="center">
                                                <div class="btn-group">
                                                    <button class="btn">Action</button>
                                                    <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../recorddetails/edit/<?php echo "test";?>">Edit</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="../recorddetails/remove/<?php echo "test";?>">Hapus</a></li>
                                                    </ul>
                                                </div>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php $this->load->view("commons/footer");?>
        <?php $this->load->view("commons/assets");?>
        <script type="text/javascript" src="/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/js/DT_bootstrap.js"></script>
        <script type="text/javascript">
            console.log("Heoll");
            record = [];
            detail = [];
            $("#btnsavedata").click(function(){
                $("#tProcess tbody").each(function(){
                    tr = $(this);
                    tr.find("td.data").each(function(){
                        td = $(this);
                        detail.push(td.html());
                        console.log("TD",td.html());
                    });
                    record.push(detail);
                });
                $.ajax({
                    url:'/processcontroller/updatedetails',
                    data:{
                        record: record,
                        record_id: 1
                    },
                    type:"post"
                });
            });
            $("#btnoutput").click(function(){
                console.log("btn output clicked");
                $.ajax({
                    url:'/processcontroller/print_out',
                    data:{
                        text:[
                            ['D0001','IDR0009','Agus','001','002','004','Tes doang','NOV','2017'],
                            ['D0002','IDR0009','Bambang','001','002','004','Tes doang','NOV','2017'],
                            ['D0003','IDR0009','Yudi','001','002','004','Tes doang','NOV','2017'],
                            ['D0004','IDR0009','Joko','001','002','004','Tes doang','NOV','2017']
                        ]
                    },
                    type:'post'
                })
                .done(function(res){
                    console.log("Res",res);
                })
                .fail(function(err){
                    console.log("Err",err);
                });
            });
        </script>
    </body>
</html>

