<!DOCTYPE html>
<html>

<head>
    <title><?= $data->supplier_name; ?> [<?= $data->invoice_number; ?>]</title>
    <style>
        body {

            font-family: Arial;
            font-size: 8pt;
            margin: 0;
            padding: 0;
        }


        .page {
            height: 297mm;
            width: 210mm;
            page-break-after: always;
        }

        table.bordered {
            border: 1px solid #000;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table.bordered td,
        table.bordered th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
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
    <table width="100%" style="border-collapse:collapse;border:1px solid">
        <tr>
            <td style="width:50%" style="border-right: 1px solid;">
                <p>1. Goods consigned from (exporter’s business name, address, country)</p>
            </td>
            <td style="width: 50%;">
                References No.
            </td>
        </tr>
        <tr>
            <td style="padding-left: 10px;vertical-align: top;border-right: 1px solid;">
                <span class="fontA"><?= $data->supplier_name; ?></span>
                <br>
                <span class="fontA"><?= $data->supplier_address; ?></span>
            </td>
            <td class="text-center" rowspan="3">
                <br>
                <br>
                <b>ASEAN-CHINA FREE TRADE AREA <br>
                    PREFERENTIAL TARIFF <br>
                    CERTIFICATE OF ORIGIN</b><br>
                (Combined declaration and certificate)<br>
                <strong>FORM E</strong><br>
                Issued in <strong><u> THE PEOPLE'S REPUBLIC OF CHINA</u></strong><br>
                (Country)
                <br>
                <!-- <table width="100%">
                    <tr>
                        <td style="text-align: right;">
                            </td>
                        </tr>
                    </table> -->
                <br>
                <p style="text-align: right;"><small>See Noted Overleaf</small></p>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;border-right: 1px solid;">
                2. Goods consigned to (consignee’s name, address, country)
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;vertical-align: top !important;border-right: 1px solid;">
                <span class="fontA"><?= strtoupper($data->company_name); ?></span>
                <br>
                <span class="fontA"><?= strtoupper($data->company_address); ?></span>
                <br>
                <span class="fontA">NPWP : <?= ($data->vat); ?></span>
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid;">3. Means of transport and route (as for as known)</td>
            <td>4. For official use</td>
        </tr>
        <tr>
            <td class="fontA" style="padding-left: 10px;vertical-align: top;text-transform: uppercase;border-right: 1px solid;">
                Departure date : <?= $data->departure_date; ?><br>
                Vessel’s name / Aircraft etc. : <?= $data->vessel; ?><br>
                Port of discharge : <?= $data->port_of_discharge; ?><br>
                From <?= $data->from; ?> To <?= $data->to; ?><br>
            </td>
            <td></td>
        </tr>
    </table>
    <table class="bordered" width="100%" style="border-top: 0;">
        <thead>
            <tr class="bg-light">
                <td class="text-center">5</td>
                <td class="text-center">6</td>
                <td class="text-center">7</td>
                <td class="text-center">8</td>
                <td class="text-center">9</td>
                <td class="text-center">10</td>
            </tr>
            <tr class="fontA" style="height: fit-content;">
                <td style="width:50px;vertical-align: top;height: fit-content;">
                    Item Number
                </td>
                <td style="width:120px;vertical-align: top;height: fit-content;">Marks and numbers on packages</td>
                <td style="width:120px;vertical-align: top;height: fit-content;">Number and type of packages, description of goods (including quantity where appropriate and HS number in six digit code)</td>
                <td style="width:100px;vertical-align: top;height: fit-content;">Origin criterion (see Notes overleaf)</td>
                <td style="width:100px;vertical-align: top;height: fit-content;">Gross weight or net weight or other quantity and value (FOB) only when RVC criterion is applied</td>
                <td style="width:100px;vertical-align: top;height: fit-content;">Number and date of invoices </td>
            </tr>
        </thead>
        <tbody class="fontA">
            <?php $n = $totalPkg = 0;
            if ($details) foreach ($details as $dt) :
                $n++;
                $totalPkg += $dt->package; ?>
                <tr class="fontA">
                    <td class="text-center" style="border-bottom:0;border-top:0"><?= $n; ?></td>
                    <?php if ($n == '1' || $n > count($details)) : ?>
                        <td class="text-center fontA" style="border-bottom:0;border-top:0">N/M</td>
                    <?php else : ?>
                        <td style="border-bottom:0;border-top:0"></td>
                    <?php endif; ?>
                    <td class="border-bottom-0" style="border-bottom:0;border-top:0">
                        <div class="fontA" style="text-transform: uppercase;">
                            <?= numberTowords(number_format($dt->package, 0, '', '')); ?> <?= ($dt->package) ? '(' . number_format($dt->package, 0) . ') ' . $data->package . " OF" : ''; ?>
                            <?= $dt->product_name; ?> <?= (strtolower($dt->specification) != 'null') ? (($dt->hide_spec == 'N') ? $dt->specification : '') : ''; ?><br>
                            HS CODE: <?= substr(substr_replace($dt->local_hscode, ".", 4, 0), 0, 7); ?>
                        </div>
                    </td>
                    <td class="text-center fontA" style="border-bottom:0;border-top:0">"PE"</td>
                    <td class="text-center fontA" style="border-bottom:0;border-top:0;">
                        <?= ($dt->hide_qty == 'Y') ? '' : (number_format($dt->qty, 0, '', '') . " " . strtoupper($dt->unit) . '<br>'); ?>
                        <?= ($dt->hide_nw == 'Y') ? '' : (number_format($dt->gross_weight, 0, '', '') . " KGS N.W <br>"); ?>
                        <?= ($dt->hide_gw == 'Y') ? '' : (number_format($dt->nett_weight, 0, '', '') . " KGS G.W <br>"); ?>

                    </td>
                    <?php if ($n == '1' || $n > count($details)) : ?>
                        <td class="text-center fontA" style="border-bottom:0;border-top:0;text-transform: uppercase;">
                            <?= $data->invoice_number; ?> <br>
                            <?= $data->invoice_date; ?>
                        </td>
                    <?php else : ?>
                        <td style="border-bottom:0;border-top:0"></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td></td>
                <td></td>
                <td class="pt-5 fontA">
                    <div class="mb-2">
                        <br>
                        <br>
                        <br>
                        <label for="">TOTAL : </label>
                        <p style="text-transform: uppercase;">
                            <?= numberTowords(number_format($totalPkg, 0, '', '')) . " (" . number_format($totalPkg, 0, '', '') . ") " . $data->package; ?> ONLY
                        </p>
                    </div>
                    <br>
                    <div class="mb-2">
                        <p>*********************************</p>
                        <label for="">MANUFACTURER : </label><?= strtoupper($data->manufacturer); ?>
                    </div>
                    <br>
                    <br>
                    <br>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" style="vertical-align: top;">
                    11. Declaration by the exporter
                    The undersigned hereby declares that the above details and
                    Statement are correct, that all the goods were produced

                    <br>
                    <br>
                    <p class="tx-bold fontA" style="text-transform: uppercase;text-align: center;"><?= ($data->exporter); ?></p>
                    <br>
                    <label for="">and that they comply with the origin requirements specified for these goods in the ASEAN-CHINA Free trade Area referential Tariff for the goods exported to</label>
                    <br>
                    <br>
                    <div class="tx-uppercase tx-bold text-center fontA"><?= strtoupper($data->importing); ?></div>
                    <br>

                    <div class="text-center" style="display: block;width:100%">
                        (Importing Country)<br>
                        Place and date. Signature of authorized signatory
                    </div>
                </td>
                <td colspan="3" style="vertical-align: top;">
                    <label for="">12. Certification</label>
                    <p>It is hereby certified, on the basis of control carried out, that the Declaration by the exporter is correct.</p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?= $data->signature; ?><br>
                    <label for="">Place and date, Signature and stamp of certifying authority</label>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>