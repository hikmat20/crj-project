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
                        <td class="text-center"><?= $tonase; ?> Ton</td>
                        <td class="text-center"><?= $header->qty_container; ?> x <?= $header->container_name; ?></td>
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
                <th class="text-center align-middle" rowspan="2">Items<br><span style="font-family: sun-exta">货物品名</span></th>
                <th class="text-center align-middle" rowspan="2">Specification</th>
                <th class="text-center align-middle" rowspan="2">HS Code<br><span style="font-family: sun-exta">海关编码</span></th>
                <th class="text-center align-middle" rowspan="2">Add Doc.</th>
                <th class="text-center align-middle" rowspan="2">BM without form E</th>
                <th class="text-center align-middle" rowspan="2">BM with form E</th>
                <th class="text-center align-middle" rowspan="2">PPH</th>
                <th class="text-center align-middle" colspan="6">AMOUNT <span style="font-family: sun-exta">总价</span></th>
                <th class="text-center align-middle" rowspan="2">Remark</th>
            </tr>
            <tr style="background-color:lightgray">
                <th colspan="2" class="text-center border border-top-0 border-right-0">Price (<?= ($header->price_type == 'FOB') ? 'FOB' : 'CFR/CIF'; ?>)</th>
                <th colspan="2" class="text-center align-middle">BM<br><span style="font-family: sun-exta">进口税</span></th>
                <th colspan="2" class="text-center align-middle">PPh<br><span style="font-family: sun-exta">预付税</span></th>
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
                    <td class="fontA"><?= $dt->product_name; ?></td>
                    <td class="fontA"><?= $dt->specification; ?></td>
                    <td class="text-center"><?= $dt->origin_hscode; ?></td>
                    <td class="" style="font-size: 5pt;">
                        <?php if (isset($ArrHscode[$dt->origin_hscode]->id)) :
                            $idHs = $ArrHscode[$dt->origin_hscode]->id;
                        ?>
                            <ul class="pd-l-15">
                                <?php if (isset($ArrDocs[$idHs])) : ?>
                                    <?php if (isset($ArrDocs[$idHs]['RQ1'])) : ?>
                                        <?php foreach ($ArrDocs[$idHs]['RQ1'] as $d) : ?>
                                            <li class="tx-sm"><small><?= $d->name ?></small></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (isset($ArrDocs[$idHs]['RQ2'])) : ?>
                                        <?php foreach ($ArrDocs[$idHs]['RQ2'] as $d) : ?>
                                            <li class="tx-sm"><small><?= $d->name ?></small></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (isset($ArrDocs[$idHs]['RQ3'])) : ?>
                                        <?php foreach ($ArrDocs[$idHs]['RQ3'] as $d) : ?>
                                            <li class="tx-sm"><small><?= $d->name ?></small></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>%</td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>%</td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>%</td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right"><?= ($dt->price) ? number_format($dt->price) : '0' ?></td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right"><?= ($totalBM) ? number_format($totalBM) : '0' ?></td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right"><?= ($totalPPH) ? number_format($totalPPH)  : '0' ?></td>
                    <td><?= $dt->remarks; ?></td>
                </tr>
                <!-- <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid"></td> -->
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="bg-light" style="background-color:lightgray">
                <th class="text-center tx-dark font-weight-bold tx-uppercase" colspan="8">Total</th>
                <td style="border-right:none"><?= $currSymbol; ?></td>
                <th class="text-right tx-dark font-weight-bold" id="totalPrice"><?= number_format(($totalPrice) ?: '0'); ?></th>
                <td style="border-right:none"><?= $currSymbol; ?></td>
                <th class="text-right tx-dark font-weight-bold"><?= number_format($gtotalBM); ?></th>
                <td style="border-right:none"><?= $currSymbol; ?></td>
                <th class="text-right tx-dark font-weight-bold"><?= number_format(($gtotalPPH) ?: '0'); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <br>
    <table class="" width="100%">
        <tr>
            <td width="50%" style="vertical-align: top;">
                <h4>Term of payment include ppn :</h4>
                <br>
                <table width="90%" class="bordered">
                    <thead>
                        <tr style="background-color:#eee">
                            <th>No.</th>
                            <th>Item</th>
                            <th colspan="2" class="text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>DP1</td>
                            <td style="border-right:none"><?= $currSymbol; ?></td>
                            <td class="text-right"><?= $DP['dp1']; ?></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>DP2 Before Shipment</td>
                            <td style="border-right:none"><?= $currSymbol; ?></td>
                            <td class="text-right"><?= $DP['dp2']; ?></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>DP3 Before ETA</td>
                            <td style="border-right:none"><?= $currSymbol; ?></td>
                            <td class="text-right"><?= $DP['dp3']; ?></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Balance Payment</td>
                            <td style="border-right:none"><?= $currSymbol; ?></td>
                            <td class="text-right"><?= $DP['dp4']; ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="background-color:#eee">
                            <th colspan="2" class="text-center">Grand Total</th>
                            <th style="border-right:none"><?= $currSymbol; ?></th>
                            <th class="text-right"><?= number_format($header->grand_total); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <br>
                <br>
                <h4>Note:</h4><br>
                <p class="border:1px solid"><?= $header->note; ?></p>
            </td>
            <td width="50%">
                <?php
                $freight    = $ArrCosting['ocean_freight']->total_foreign_currency;
                $shipping   = $ArrCosting['shipping']->total_foreign_currency;
                $storage    = $ArrCosting['storage']->total_foreign_currency;
                $surveyor   = $ArrCosting['surveyor']->total_foreign_currency;
                $trucking   = $ArrCosting['trucking']->total_foreign_currency;
                $custome_clearance   = $ArrCosting['custom_clearance']->total_foreign_currency;
                $fee_csj   = $ArrCosting['fee_csj']->total_foreign_currency;

                $othFee = 0;
                if ($otherCost) foreach ($otherCost as $othCost) :
                    $othFee += $othCost->total_foreign_currency;
                endforeach;

                $totalAllIn = $shipping + $storage + $surveyor + $trucking + $custome_clearance + $fee_csj + $totalLartas;
                ?>
                <table class="bordered" width="100%">
                    <tr>
                        <td colspan="2" width="100">Total Product Price
                            <span class="fontA">产品价格</span>
                        </td>
                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right" width="100"><?= number_format($header->total_product, 2); ?></td>
                    </tr>
                    <?php if ($header->ocean_freight) : ?>
                        <tr>
                            <td colspan="2" style="word-wrap: break-word;">
                                Ocean Freight <span class="fontA">海运费</span>
                            </td>
                            <td style="border-right:none;"><?= $currSymbol; ?> </td>
                            <td class="text-right"><?= number_format($header->ocean_freight); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="2" style="word-wrap: break-word;">THC, Handling, undername fee and others (ALL IN)
                            <span class="fontA">码头处理费、码头操作费、借抬头费、等 (全包)</span>
                        </td>

                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right"><?= number_format($totalAllIn); ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">SUBTOTAL <span class="fontA">小计</span></th>
                        <td style="border-right:none;background-color:lightgray"><?= $currSymbol; ?> </td>
                        <th class="text-right" style="background-color:lightgray"><?= number_format($header->subtotal); ?></th>
                    </tr>
                    <tr>
                        <td colspan="2">BM <span class="fontA">进口税</span></td>
                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right"><?= ($header->total_bm) ? number_format($header->total_bm) : 0; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">PPh <span class="fontA">所得税</span></td>
                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right"><?= ($header->total_pph) ? number_format($header->total_pph) : 0; ?></td>
                    </tr>
                    <tr>
                        <td style="border: none;">Tax (PPN)</td>
                        <td width="10" class="text-center"><?= $header->tax; ?>%</td>
                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right"><?= ($header->total_tax) ? number_format($header->total_tax) : 0; ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">Grand Total Include Tax <span class="fontA">合计(含PPn税)</span></th>
                        <td style="border-right:none;background-color:lightgray"><?= $currSymbol; ?> </td>
                        <th class="text-right" style="background-color:lightgray"><?= ($header->grand_total) ? number_format($header->grand_total) : 0; ?></th>
                    </tr>
                    <tr>
                        <td colspan="2"><?= ($header->price_type == 'FOB') ? 'FOB' : 'CFR/CIF'; ?> <span class="fontA">销项成本</span></td>
                        <td style="border-right:none;"><?= $currSymbol; ?> </td>
                        <td class="text-right">(<?= number_format($header->total_product); ?>)</td>
                    </tr>
                    <tr>
                        <th colspan="2" style="background-color:lightgray">TOTAL COST (Exclude <?= ($header->price_type == 'FOB') ? 'FOB' : 'CFR/CIF'; ?>) <span class="fontA">总清关费 (不含货物)</span></th>
                        <td style="border-right:none;background-color:lightgray"><?= $currSymbol; ?> </td>
                        <th class="text-right" style="background-color:lightgray"><?= ($header->grand_total_exclude_price) ? number_format($header->grand_total_exclude_price) : 0; ?></th>
                    </tr>
                </table>
                <br><br><br><br><br>
                <table width="100%" class="bordered">
                    <tr>
                        <th class="text-center" style="background-color:lightgray">Maked By,</th>
                        <th class="text-center" style="background-color:lightgray">Approved Go,</th>
                        <th class="text-center" style="background-color:lightgray">Approved By,</th>
                    </tr>
                    <tr>
                        <td><br><br><br><br></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <?= $ArrUsers[$header->created_by]; ?>
                        </th>
                        <th class="text-center">
                            <?= $ArrUsers[$header->approved_go]; ?>
                        </th>
                        <th class="text-center">
                            <?= $ArrUsers[$header->approved_by]; ?>
                        </th>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>

</html>