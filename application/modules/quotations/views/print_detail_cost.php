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
    <div style="padding: 20px 25px;">
        <table class="bordered colored" width="100%">
            <thead>
                <tr style="background-color:#FFE699;">
                    <th class="text-center align-middle">UNDERNAME WITH CUSTOM <span class="fontA">操作费</span></th>
                    <th class="text-center align-middle">QTY</th>
                    <th class="text-center align-middle">UM</th>
                    <th class="text-center align-middle" colspan="2">UNIT PRICE</th>
                    <th class="text-center align-middle" colspan="2">TOTAL (RUPIAH)</th>
                    <th class="text-center align-middle" colspan="2">TOTAL (CNY)</th>
                </tr>
            </thead>
            <tbody>
                <!-- ocean_freight -->






                <tr class="tx-dark">
                    <td class="">OCEAN FREIGHT <span class="fontA"></span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['ocean_freight']->price) ? number_format(($ArrCosting['ocean_freight']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['ocean_freight']->total)) ? number_format(($ArrCosting['ocean_freight']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['ocean_freight']->total_foreign_currency)) ? number_format(($ArrCosting['ocean_freight']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr class="tx-dark">
                    <td class="">THC <span class="fontA">码头作业费</span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['shipping']->price) ? number_format(($ArrCosting['shipping']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['shipping']->total)) ? number_format(($ArrCosting['shipping']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['shipping']->total_foreign_currency)) ? number_format(($ArrCosting['shipping']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="">CUSTOM CLEARANCE + LIFT ON/OFF <span class="fontA">清关和装卸费</span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['custom_clearance']->price) ? number_format(($ArrCosting['custom_clearance']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['custom_clearance']->total)) ? number_format(($ArrCosting['custom_clearance']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['custom_clearance']->total_foreign_currency)) ? number_format(($ArrCosting['custom_clearance']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-">STORAGE ESTIMATED 7DAYS <span class="fontA">仓储费 (预计7天)</span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['storage']->price) ? number_format(($ArrCosting['storage']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['storage']->total)) ? number_format(($ArrCosting['storage']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['storage']->total_foreign_currency)) ? number_format(($ArrCosting['storage']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-">LAPORAN SURVEYOR <span class="fontA">商检费</span>
                    </td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['surveyor']->price) ? number_format(($ArrCosting['surveyor']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['surveyor']->total)) ? number_format(($ArrCosting['surveyor']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['surveyor']->total_foreign_currency)) ? number_format(($ArrCosting['surveyor']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-">TRUCKING <span class="fontA">雅加达区域派送费</span>
                    </td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['trucking']->price) ? number_format(($ArrCosting['trucking']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['trucking']->total)) ? number_format(($ArrCosting['trucking']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['trucking']->total_foreign_currency)) ? number_format(($ArrCosting['trucking']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-">Fee CSJ <span class="fontA">操作费</span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= ($ArrCosting['fee_csj']->price) ? number_format(($ArrCosting['fee_csj']->price)) : '0' ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (($ArrCosting['fee_csj']->total)) ? number_format(($ArrCosting['fee_csj']->total)) : '0' ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (($ArrCosting['fee_csj']->total_foreign_currency)) ? number_format(($ArrCosting['fee_csj']->total_foreign_currency))  : '0' ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-">Fee Lartas <span class="fontA">配额费</span></td>
                    <td class="text-center">
                        <?= (isset($feeLartas)&&$feeLartas)?array_sum(array_column($feeLartas,'qty')):'0' ; ?></td>
                    <td class="text-center">TNE</td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (isset($feeLartas)&&$feeLartas)?number_format(array_sum(array_column($feeLartas,'price'))):'0' ; ?>
                    </td>
                    <td style="border-right:none">Rp. </td>
                    <td class="text-right">
                        <?= (isset($feeLartas)&&$feeLartas)?number_format(array_sum(array_column($feeLartas,'total'))):'0' ; ?>
                    </td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td class="text-right">
                        <?= (isset($feeLartas)&&$feeLartas)?number_format(array_sum(array_column($feeLartas,'total_foreign_currency'))):'0' ; ?>
                    </td>
                </tr>

                <?php foreach ($otherCost as $n => $oth) : $n++; ?>
                <tr class="othFee">
                    <td><span class="fontA"><?= str_replace("OTH-", "", $oth->name); ?></span></td>
                    <td class="text-center"><?= $header->qty_container; ?></td>
                    <td class="text-center">Container</td>
                    <td style="border-right:none">Rp. </td>
                    <td><?= number_format($oth->price); ?></td>
                    <td style="border-right:none">Rp. </td>
                    <td><?= number_format($oth->total); ?></td>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <td><?= number_format($oth->total_foreign_currency, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="bg-light" style="background-color:yellow">
                    <th class="text-center tx-dark font-weight-bold tx-uppercase" colspan="3">Total</th>
                    <td style="border-right:none"></td>
                    <th class="text-right tx-dark font-weight-bold" id="totalPrice"></th>
                    <td style="border-right:none">Rp.</td>
                    <th class="text-right tx-dark font-weight-bold"><?= number_format($header->total_costing); ?></th>
                    <td style="border-right:none"><?= $currSymbol; ?></td>
                    <th class="text-right tx-dark font-weight-bold">
                        <?= number_format($header->total_costing_foreign_currency); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>