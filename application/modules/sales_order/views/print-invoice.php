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
        <h2 style='margin:0px' class="text-center"><u>COMMERCIAL INVOICE</u></h2>
        <br>
        <table width="100%">
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
                    <table>
                        <tr>
                            <th width="100">INVOICE NUMBER</th>
                            <td>:</td>
                            <td class="text-left"><?= (isset($header)) ? $header->number : null; ?></td>
                        </tr>
                        <tr>
                            <th width="100">INVOICE DATE</th>
                            <td>:</td>
                            <td width="120" class="text-left"><?= (isset($header) && $header->invoice_date) ? date('F, d Y', strtotime($header->invoice_date)) : date('d/m/Y'); ?></td>
                        </tr>
                    </table>
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
                        <?= $header->company_address; ?> <br>
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
            <tr>
                <th width="70%" style="padding-top:10px"><strong><span class="">FROM</span>: <?= $header->from; ?></strong></th>
                <th>TO : <?= $header->to; ?></th>
            </tr>
            <tr>
                <th width="70%" style="padding-top:10px"></th>
                <th>Incoterm : <?= $header->incoterm; ?></th>
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
                    <th class="align-middle text-right" width="100" colspan="2">UNIT PRICE(<?= $symbol[$header->currency]; ?>)</th>
                    <th class="align-middle text-right" width="100" colspan="2">AMOUNT(<?= $symbol[$header->currency]; ?>)</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = $subtotal = 0;
                foreach ($details as $dtl) :
                    $n++; ?>
                    <tr>
                        <td class="text-center"><?= $n; ?></td>
                        <td class="fontA"><?= $dtl->product_name; ?></td>
                        <td class="fontA"><?= $dtl->specification; ?></td>
                        <td class="text-center"><?= $dtl->qty; ?></td>
                        <td class="text-center"><?= $dtl->unit; ?></td>
                        <td style="border-right:0"><?= $symbol[$header->currency];  ?></td>
                        <td class="text-right"><?= number_format($dtl->unit_price); ?></td>
                        <td style="border-right:0"><?= $symbol[$header->currency]; ?></td>
                        <td class="text-right"><?= number_format($dtl->total_price); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="">
                <tr class="">
                    <td colspan="7" class="align-middle text-right tx-bold">SUBTOTAL</td>
                    <td style="border-right:0;" class="tx-bold"><?= $symbol[$header->currency]; ?></td>
                    <td class="text-right tx-bold border-right-0 border tx-bold"><?= number_format($header->subtotal); ?></td>
                </tr>
                <?php if ($header->insurance > 0) : ?>
                    <tr>
                        <td colspan="7" class="align-middle text-right">INSURANCE</td>
                        <td style="border-right:0;"><?= $symbol[$header->currency]; ?></td>
                        <td class="text-right"><?= number_format($header->insurance); ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($header->freight > 0) : ?>
                    <tr>
                        <td colspan="7" class="align-middle text-right">FREIGHT</td>
                        <td style="border-right:0;"><?= $symbol[$header->currency]; ?></td>
                        <td class="text-right"><?= number_format($header->freight); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="7" class="align-middle text-right tx-bold">TOTAL</td>
                    <td style="border-right:0;" class="tx-bold"><?= $symbol[$header->currency]; ?></td>
                    <td class="text-right tx-bold"><?= number_format($header->grand_total_invoice); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>