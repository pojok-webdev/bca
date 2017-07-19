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
                                                <td><?php echo $obj["id"];?></td>
                                                <td><?php echo $obj["idr"];?></td>
                                                <td><?php echo $obj["name"];?></td>
                                                <td><?php echo $obj["kd1"];?></td>
                                                <td><?php echo $obj["kd2"];?></td>
                                                <td><?php echo $obj["kd3"];?></td>
                                                <td><?php echo $obj["month"];?></td>
                                                <td><?php echo $obj["year"];?></td>
                                                <td class="center">
                                                <div class="btn-group">
                                                    <button class="btn">Action</button>
                                                    <button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="../bimbelgroups/edit/<?php echo "test";?>">Edit</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="../bimbelgroups/remove/<?php echo "test";?>">Hapus</a></li>
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
            /*
            $('#tProcess').dataTable( {
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "iDisplayLength": 5,
                "oLanguage": {
                    //"sLengthMenu": "_MENU_ records per page"
                    "sLengthMenu": 'Display <select>'+
                        '<option value="5">5</option>'+
                        '<option value="10">10</option>'+
                        '<option value="20">20</option>'+
                        '<option value="30">30</option>'+
                        '<option value="40">40</option>'+
                        '<option value="50">50</option>'+
                        '<option value="-1">All</option>'+
                        '</select> records'
                    }
            } );
            */
            $("#btnsavedata").click(function(){
                window.location.href = "/processcontroller/save";
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

