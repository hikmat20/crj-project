<!DOCTYPE html>
<html>

<head>
    <title><?= $header->customer_name; ?>[<?= $header->id; ?>]</title>
    <style>
        body {
            width: 100%;
            font-family: Arial;
            font-size: 8pt;
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
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            border-spacing: 0;
            border-collapse: collapse;

        }

        table.bordered td,
        table.bordered th {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2px;
        }

        th {
            text-align: left;
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
            /* font-size: 9pt; */
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
    </style>
</head>

<body>
    <h2 style='margin:0px'><u>ESTIMATION OF COST IMPORT (QUOTATION)</u></h2>
    <br><br><br>
    <table width="100%">
        <tr>
            <td width="55%" style="vertical-align: top;">
                <h3>To: <?= $header->customer_name; ?></h3>
            </td>
            <td>
                <table class="bordered" style="font-size: 7pt;">
                    <tr>
                        <th width="150" class="text-center" style="background-color:lightgray">QUOTATION NUMBER</th>
                        <th width="150" class="text-center" style="background-color:lightgray">DATE</th>
                    </tr>
                    <tr>
                        <td class="text-center"><?= (isset($header)) ? $header->number : null; ?></td>
                        <td class="text-center"><?= (isset($header) && $header->date) ? date('d/m/Y', strtotime($header->date)) : date('d/m/Y'); ?></td>
                    </tr>
                    <tr>
                        <th width="150" class="text-center" style="background-color:lightgray">CARGO DIMENSION</th>
                        <th width="150" class="text-center" style="background-color:lightgray">SIZE CONTAINER</th>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"><?= $header->container_name; ?></td>
                    </tr>
                    <tr>
                        <th class="text-center" style="background-color:lightgray">CURRENCY</th>
                        <th class="text-center" style="background-color:lightgray">EXCHANGE RATE (Rp)</th>
                    </tr>
                    <tr>
                        <td class="text-center"><?= $header->currency; ?></td>
                        <td class="text-center"><?= number_format($header->exchange); ?></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <!-- details -->
    <!-- <hr> -->
    <br>
    <table class="bordered" width="100%">
        <thead>
            <tr style="background-color:lightgray">
                <th class="text-center align-middle" rowspan="2">No. <span class="fontA">序号</span></th>
                <th class="text-center align-middle" rowspan="2">Items <span style="font-family: sun-exta">货物品名</span></th>
                <th class="text-center align-middle" rowspan="2">Specification</th>
                <th class="text-center align-middle" rowspan="2">HS Code <span style="font-family: sun-exta">海关编码</span></th>
                <!-- <th class="text-center align-middle" rowspan="2">Indonesia HS Code</th> -->
                <th class="text-center align-middle" rowspan="2">Add Doc.</th>
                <!-- <th class="text-center align-middle" rowspan="2">Select</th> -->
                <th class="text-center align-middle" rowspan="2">BM without form E</th>
                <th class="text-center align-middle" rowspan="2">BM with form E</th>
                <th class="text-center align-middle" rowspan="2">PPH</th>
                <th class="text-center align-middle" colspan="">AMOUNT <span style="font-family: sun-exta">总价</span></th>
                <th class="text-center align-middle" rowspan="2">BM <span style="font-family: sun-exta">进口税</span></th>
                <th class="text-center align-middle" rowspan="2">PPh <span style="font-family: sun-exta">预付税</span></th>
                <th class="text-center align-middle" rowspan="2">Remark</th>
            </tr>
            <tr style="background-color:lightgray">
                <th class="text-center border border-top-0 border-right-0">FOB</th>
                <!-- <th class="text-center"></th> -->
            </tr>
        </thead>
        <tbody>
            <?php $n = $totalPrice = $totalPPH = $totalBM = $gtotalBM = $gtotalPPH = 0;
            $no_image = base_url('assets/no-image.jpg');
            if ($details) foreach ($details as $dt) : $n++;
                $totalPrice   += $dt->price;
                $totalBM    = $dt->price * ($ArrHscode[$dt->origin_hscode]->bm_e / 100);
                $totalPPH   = ($dt->price + $totalBM) * ($ArrHscode[$dt->origin_hscode]->pph_api / 100);
                $gtotalBM   += $totalBM;
                $gtotalPPH  += $totalPPH;
                $img = '';
                if ($dt->image) {
                    $img = $dt->image;
                }
            ?>
                <tr class="tx-dark">
                    <td class="text-center"><?= $n; ?></td>
                    <td style="font-family: sun-exta"><?= $dt->product_name; ?></td>
                    <td class="fontA"><?= $dt->specification; ?></td>
                    <td class="text-center"><?= $dt->origin_hscode; ?></td>
                    <td class="text-center"></td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>%</td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>%</td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>%</td>
                    <td class="text-right"><?= ($dt->price) ? number_format($dt->price) : '0' ?></td>
                    <td class="text-right"><?= ($totalBM) ? number_format($totalBM) : '0' ?></td>
                    <td class="text-right"><?= ($totalPPH) ? number_format($totalPPH)  : '0' ?></td>
                    <td><?= $dt->remarks; ?></td>
                    <!-- <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid"></td> -->
                </tr>
            <?php endforeach; ?>
            <tr class="bg-light" style="background-color:lightgray">
                <th class="text-center tx-dark font-weight-bold tx-uppercase" colspan="8">Total</th>
                <th class="text-right tx-dark font-weight-bold" id="totalPrice"><?= number_format(($totalPrice) ?: '0'); ?></th>
                <!-- <th class="text-right tx-dark font-weight-bold" id="totalCIF"><?= number_format(($totalCIF) ?: '0'); ?></th> -->
                <th class="text-right tx-dark font-weight-bold"><?= number_format($gtotalBM); ?></th>
                <th class="text-right tx-dark font-weight-bold"><?= number_format(($gtotalPPH) ?: '0'); ?></th>
                <th></th>
            </tr>
        </tbody>
    </table>
    <br>
    <?php
    $totalProduct   = ($header->price_type == 'FOB') ? ($totalPrice) : ($totalCIF);
    $totalAllIn     = ($gtotalPPH + $header->total_custom_clearance + $header->fee_value + $header->fee_customer);
    $subtotal       = ($totalAllIn + $totalProduct);
    $Tax            = (($subtotal + $gtotalBM) * 11) / 100;
    $GrandTotal     = ($subtotal + $Tax);
    $GrandTotalEx   = ($GrandTotal - $totalProduct);
    ?>
    <table class="" width="100%">
        <tr>
            <td width="60%"></td>
            <td width="40%">
                <table class="bordered" width="100%">
                    <tr>
                        <td colspan="2" width="100">Total Product Price
                            <span class="fontA">产品价格</span>
                        </td>
                        <td class="text-right" width="100"><?= number_format($totalProduct); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="word-wrap: break-word;">
                            Ocean Freight <span class="fontA">海运费</span>
                        </td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="word-wrap: break-word;">THC, Handling, undername fee and others (ALL IN)
                            <span class="fontA">码头处理费、码头操作费、借抬头费、等 (全包)</span>
                        </td>
                        <td class="text-right" style="display: flex;justify-content: space-between;">
                            <?= number_format(($totalAllIn) ?: '0'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">SUB TOTAL <span class="fontA">小计</span></th>
                        <th class="text-right" style="background-color:lightgray"><?= number_format($subtotal); ?></th>
                    </tr>
                    <tr>
                        <td colspan="2">BM <span class="fontA">进口税</span></td>
                        <td class="text-right"><?= ($gtotalBM) ? number_format($gtotalBM) : 0; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">PPh <span class="fontA">所得税</span></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td>Tax (PPN)</td>
                        <td width="10" class="text-center" style="border-left: 0 !important;">11%</td>
                        <td class="text-right"><?= ($Tax) ? number_format($Tax) : 0; ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">Grand Total Include PPn <span class="fontA">合计 (含PPn税)</span></th>
                        <th class="text-right" style="background-color:lightgray"><?= ($GrandTotal) ? number_format($GrandTotal) : 0; ?></th>
                    </tr>
                    <tr>
                        <td colspan="2">CFR/CIF/FOB <span class="fontA">销项成本</span></td>
                        <td class="text-right">(<?= number_format($totalProduct); ?>)</td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">TOTAL COST (Exclude CFR/CIF/FOB) <span class="fontA">总清关费 （不含货物）</span></th>
                        <th class="text-right" style="background-color:lightgray"><?= ($GrandTotalEx) ? number_format($GrandTotalEx) : 0; ?></th>
                    </tr>
                </table>
                <br><br><br><br><br>
                <br><br><br><br><br>
                <table width="100%" class="bordered">
                    <tr>
                        <th class="text-center" style="background-color:lightgray">Maked By,</th>
                        <th class="text-center" style="background-color:lightgray">Verify By,</th>
                        <th class="text-center" style="background-color:lightgray">Approved Go,</th>
                    </tr>
                    <tr>
                        <td><br><br><br><br></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="text-center"> <?php for ($i = 0; $i < 24; $i++) {
                                                        echo "&nbsp;";
                                                    }; ?> </th>
                        <th class="text-center"> <?php for ($i = 0; $i < 24; $i++) {
                                                        echo "&nbsp;";
                                                    }; ?> </th>
                        <th class="text-center"> <?php for ($i = 0; $i < 24; $i++) {
                                                        echo "&nbsp;";
                                                    }; ?> </th>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>

</html>