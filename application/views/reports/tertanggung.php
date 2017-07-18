<html>
    <head>
        <title><?php echo $formtitle;?></title>
        <link rel="stylesheet" href="/assets/css/najma.reports.css" />
    </head>
    <body>
        <div class="topnavcenter"><a href="/reports"><img src="/assets/images/home16.png" /></a></div>
        <h1><?php echo $formtitle;?></h1>
        <h3>Tanggal <?php echo date("d")." ".$humanmonth[removezero(date("m"))]." ".date("Y");?></h3>
        <table class="commonreport">
            <thead>
                <tr><th>No</th><th>Siswa</th><th>SPP</th><th>DU</th><th>Buku</th><th>Bimbel</th></tr>
            </thead>
            <tbody>
            <?php $c = 1;$book = 0;$spp = 0; $bimbel = 0; $dupsb = 0;?>
                <?php foreach($students as $student){?>
                <tr><td class="number"><?php echo $c;?></td><td><?php echo $student->nis;?> - <?php echo $student->name;?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->spp);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->dupsb);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->book);?></td>
                    <td class="number"><?php echo "Rp." . number_format($student->bimbel);?></td>
                </tr>
                <?php
                $dupsb+=$student->dupsb;$book+=$student->book;$bimbel+=$student->bimbel;$spp+=$student->spp;
                ?>
                <?php $c++;?>
                <?}?>
            </tbody>
            <tfoot>
                <tr>
                <td colspan=2>Total</td>
                <td class="number"><?php echo "Rp." . number_format($spp);?></td>
                <td class="number"><?php echo "Rp." . number_format($dupsb);?></td>
                <td class="number"><?php echo "Rp." . number_format($book);?></td>
                <td class="number"><?php echo "Rp." . number_format($bimbel);?></td></tr>
            </tfoot>
        </table>
    </body>
</html>