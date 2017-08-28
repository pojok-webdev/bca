<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $formtitle;?></title>
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
                                    <div class="text-muted bootstrap-admin-box-title"><?php echo $formtitle;?></div>
                                    
                                    <form name="import" method="POST" enctype="multipart/form-data" action="/processcontroller/importexisting">
                                        <input class="btn btn-sm btn-default"  type="file" name="file">
                                        <input type="hidden" name="record_id" value="<?php echo $record_id;?>" />
                                        <button class="btn btn-sm btn-default" id="import" type="submit" name="submit">
                                            <i class="glyphicon glyphicon-import"></i> Import
                                        </button>
                                        <button class="btn btn-sm btn-default" id="import" type="submit" name="download">
                                            <i class="glyphicon glyphicon-import"></i> Download
                                        </button>
                                    </form>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="tblrecorddetail">
                                        <thead>
                                            <tr>
                                                <th>Tipe Detail</th>
                                                <th>Akun</th>
                                                <th>Mata Uang</th>
                                                <th>Jumlah</th>
                                                <th>Nama</th>
                                                <th>Nomor Pelanggan</th>
                                                <th>Berita</th>
                                                <th>Filler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($objs as $obj){?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $obj->tipedetail;?></td>
                                                <td><?php echo $obj->akun;?></td>
                                                <td class="rightaligned number"><?php echo $obj->matauang;?></td>
                                                <td><?php echo $obj->jumlah;?></td>
                                                <td><?php echo $obj->nama;?></td>
                                                <td><?php echo $obj->nomorpelanggan;?></td>
                                                <td><?php echo $obj->berita;?></td>
                                                <td><?php echo $obj->filler;?></td>
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
            $('#tblrecorddetail').dataTable( {
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
            $("#addRecord").click(function(){
                window.location.href = "/records/add";
            });
        </script>
    </body>
</html>
