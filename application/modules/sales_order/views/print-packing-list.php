<!DOCTYPE html>
<html>

<head>
    <title><?= $header->supplier_name; ?> [<?= $header->invoice_number; ?>]</title>
    <style>
    body {
        width: 100%;
        font-family: Arial;
        font-size: 9pt;
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .page {
        height: 297mm;
        width: 210mm;
        page-break-after: always;
    }

    table.bordered {
        border: 1px solid #aaa;
        border-spacing: 0;
        border-collapse: collapse;
    }

    table.bordered td,
    table.bordered th {
        border-right: 1px solid #aaa;
        border-bottom: 1px solid #aaa;
        padding: 2px;
    }

    table.colored tr:nth-child(even) {
        background-color: #eee;
    }

    th {
        text-align: left;
        text-transform: uppercase;
        font-size: 9.5px;
    }

    table.heading {
        height: 20mm;
    }

    h1.heading {
        font-size: 14pt;
        color: #000;
        font-weight: normal;
    }

    h2.heading {
        font-size: 9pt;
        color: #000;
        font-weight: normal;
    }

    hr {
        color: #ccc;
        background: #ccc;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    #footer {
        /*width:180mm;*/
        margin: 0 15mm;
        padding-bottom: 3mm;
    }

    #footer table {
        width: 100%;
        border-left: 1px solid #ccc;
        border-top: 1px solid #ccc;
        background: #eee;
        border-spacing: 0;
        border-collapse: collapse;
    }

    #footer table td {
        width: 25%;
        text-align: center;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    img.resize {
        max-width: 12%;
        max-height: 12%;
    }

    .fontA {
        font-family: "Sun-ExtA";
    }

    .fontB {
        font-family: "Sun-ExtB";
    }

    .font-normal {
        font-weight: normal;
    }

    .tx-bold {
        font-weight: bold;
    }

    .pt-3 {
        padding-top: 3px;
    }
    </style>
</head>

<body>
    <div style="padding: 0px 25px;">
        <hr style='margin:0px;color:black;'>
        <hr style='margin-top:1px;color:black;'>
        <h2 style='margin:0px' class="text-center"><u>PACKING LIST</u></h2>
        <br>
        <table width="100%">
            <tr>
                <td width="70%">
                    <table>
                        <?php if ($header->third_party == 'Y') : ?>
                        <tr>
                            <td class="tx-bold" style="vertical-align: top;">SUPPLIER:</td>
                            <td></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style="vertical-align: top;">
                                <?php if ($header->third_party == 'Y') : ?>
                                <p class="tx-bold"><?= $header->trd_company_name; ?></p>
                                <p><?= $header->trd_company_address; ?></p>
                                <?php endif; ?>
                            </td>
                            <td class="">

                            </td>
                        </tr>
                        <tr>
                            <td><strong><span class="">CONSIGNEE</span>:</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <p class="tx-bold"><?= $header->company_name; ?></p>
                                <p>
                                    <?= $header->company_address; ?><br>
                                    NPWP : <?= $header->vat; ?> <br>
                                </p>
                            </td>
                            <td></td>
                        </tr>

                        <?php if ($header->qq == 'Y') : ?>
                        <tr>
                            <td class="tx-bold" style="padding-top: 15px;">
                                PEMILIK BARANG:
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <p class="tx-bold"><?= $header->qq_company_name; ?></p>
                                <p><?= $header->qq_company_address; ?></p>
                            </td>
                            <td></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <th width="100">INVOICE NUMBER</th>
                            <td>:</td>
                            <td class="text-left"><?= (isset($header)) ? $header->pl_number : null; ?></td>
                        </tr>
                        <tr>
                            <th width="100">INVOICE DATE</th>
                            <td>:</td>
                            <td width="120" class="text-left">
                                <?= (isset($header) && $header->pl_date) ? date('F, d Y', strtotime($header->invoice_date)) : date('d/m/Y'); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <th width="70%" style="padding-top:10px"><strong><span class="">FROM</span>:
                        <?= $header->from; ?></strong></th>
                <th>TO : <?= $header->to; ?><br>
                    INCOTERM : <?= $header->incoterm; ?></th>
            </tr>
        </table>

        <!-- details -->
        <br>
        <table class="bordered colored" width="100%">
            <thead>
                <tr style="background-color: #ccc;">
                    <th class="align-middle text-center" width="30">NO</th>
                    <th class="align-middle text-center">DESCRIPTION OF GOODS</th>
                    <th class="align-middle text-center">SPECIFICATION</th>
                    <th class="align-middle text-center" width="50">QTY</th>
                    <th class="align-middle text-center" width="50">UNIT</th>
                    <th class="align-middle text-center" width="80">PACKAGE</th>
                    <th class="align-middle text-center" width="50">UNIT PACKAGE</th>
                    <th class="align-middle text-center" width="80">N.W (KGS)</th>
                    <th class="align-middle text-center" width="80">G.W (KGS)</th>
                    <th class="align-middle text-center" width="80">CBM</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = $subtotal = $pkg = 0;
                foreach ($details as $dtl) :
                    $vPkg = ($dtl->package == 0) ? $pkg++ : 0;
                    $n++; ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td class="fontA"><?= $dtl->product_name; ?></td>
                    <td class="fontA"><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->qty; ?></td>
                    <td class="text-center"><?= $dtl->unit; ?></td>
                    <td class="text-center"><?= $dtl->package; ?></td>
                    <td class="text-center"><?= $dtl->unit_package; ?></td>
                    <td class="text-center"><?= $dtl->nett_weight; ?></td>
                    <td class="text-center"><?= $dtl->gross_weight; ?></td>
                    <td class="text-center"><?= $dtl->cbm; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="">
                <tr class="">
                    <td colspan="5" class="align-middle text-center tx-bold">TOTAL</td>
                    <td class="text-center tx-bold border-right-0 border tx-bold"><?= ($header->total_package); ?></td>
                    <td class="text-center tx-bold"><?= $header->package; ?></td>
                    <td class="text-center tx-bold border-right-0 border tx-bold"><?= ($header->total_nett_weight); ?>
                    </td>
                    <td class="text-center tx-bold border-right-0 border tx-bold"><?= ($header->total_gross_weight); ?>
                    </td>
                    <td class="text-center tx-bold border-right-0 border tx-bold"><?= ($header->total_cbm); ?></td>
                </tr>
            </tfoot>
        </table>

        <!-- Array
(
    [1] => Array
        (
            [1] => 20
            [2] => 0
            [3] => 0
            [4] => 0
        )

    [2] => Array
        (
            [5] => 20
        )

    [3] => Array
        (
            [6] => 20
            [7] => 0
            [8] => 0
        )

    [4] => Array
        (
            [9] => 20
        )

) -->
        <!-- <table cellspacing="0" cellpadding="0" border="1" bordercolor="#000000">
            <thead>
                <th style="width:10px; text-align:right">Count</th>
                <th>Detail 1</th>
                <th>Head 2</th>
                <th>Head 3</th>
                <th>Head 4</th>
                <th>Head 5</th>
                <th>Head 6</th>
                <th>Detail 2</th>
            </thead>

            <tbody>
                <?php
                $arr_detail_1 = array("angelo", "philip", "raymond", "jonathan", "pedro");
                $arr_detail_2  = array("Cavite", "Laguna", "Quezon", "Japan", "Surigao");
                $arr_detail_3 = array("10-dec", "11-Sep", "12-Feb", "22-July", "15-Oct");
                $arr_detail_4  = array("Pink", "blue", "Green", "White", "Purple");
                $arr_detail_5  = array("Computer", "Door Lock", "Pencil", "Cup", "Jeans");

                $a = array("screw");
                $b = array("ball", "paper", "Big", "Liquid", "id");
                $c = array("Sewing");
                $d = array("Running", "Biking", "Swimming");
                $e = array("Tree", "planting", "root", "fruits", "Rain", "Grass");

                $f = array("driver");
                $g = array("Pen", "bag", "Brother", "eraser", "lace");
                $h = array("machine");
                $i = array("barefoot", "with no bike", "technique");
                $j = array("planting", "tree", "crops", "bearig-trees", "Forest", "Hopper");

                $arr1 = array($a, $b, $c, $d, $e);
                $arr2 = array($f, $g, $h, $i, $j);


                $rowcount = 1;
                for ($i = 0; $i < count($arr1); $i++) {
                    // echo "The number is " . $i . "<br />";

                    $temp_arr_1 = $arr1[$i];
                    $temp_arr_2 = $arr2[$i];
                    for ($x = 0; $x < count($temp_arr_1); $x++) {

                ?>
                        <tr>
                            <td align="right"><?php echo $rowcount; ?>.</td>
                            <td><?php echo $temp_arr_1[$x]; ?></td>
                            <td><?php echo $temp_arr_2[$x]; ?></td>
                            <?php
                            $span_count = count($temp_arr_1);
                            if ($span_count > 1 && $x == 0) {

                            ?>
                                <td rowspan="<?php echo count($temp_arr_1); ?>"><?php echo $arr_detail_1[$i]; ?></td>
                                <td rowspan="<?php echo count($temp_arr_1); ?>"><?php echo $arr_detail_2[$i]; ?></td>
                                <td rowspan="<?php echo count($temp_arr_1); ?>"><?php echo $arr_detail_3[$i]; ?></td>
                                <td rowspan="<?php echo count($temp_arr_1); ?>"><?php echo $arr_detail_4[$i]; ?></td>
                                <td rowspan="<?php echo count($temp_arr_1); ?>"><?php echo $arr_detail_5[$i]; ?></td>
                            <?php
                            } else if ($span_count > 1 && $x > 0) {
                                //
                            } else {
                            ?>
                                <td><?php echo $arr_detail_1[$i]; ?></td>
                                <td><?php echo $arr_detail_2[$i]; ?></td>
                                <td><?php echo $arr_detail_3[$i]; ?></td>
                                <td><?php echo $arr_detail_4[$i]; ?></td>
                                <td><?php echo $arr_detail_5[$i]; ?></td>
                            <?php
                            }
                            ?>
                        </tr>
                <?php
                        $rowcount++;
                    }
                }
                ?>
            </tbody>
        </table> -->
    </div>
</body>

</html>