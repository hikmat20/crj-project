<!DOCTYPE html>
<html>

<head>
    <title><?= $data->supplier_name; ?> [<?= $data->po_number; ?>]</title>
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
    <h2 class="text-center" style="padding: 5px;border:solid 1.5px #000">PURCHASE ORDER</h2>
    <table width="100%" style="border-collapse:collapse;">
        <tr>
            <td style="width:50%;vertical-align: top; border-left:solid 1.5px #000;border-top:solid 1.5px #000;padding: 10px;">

                <table>
                    <tbody>
                        <tr class="tx-bold">
                            <td class="tx-bold" style="vertical-align: top;">TO</td>
                            <td class="tx-bold" style="vertical-align: top;">:</td>
                            <td class="tx-bold" style="vertical-align: top;"><?= $data->supplier_name; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <br><br><br><br><br><br><br>
                            </td>
                            <td></td>
                            <td style="vertical-align: top;">
                                <br>
                                <?= $data->supplier_address; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-bold" style="vertical-align: top;">Attn.
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                            <td class="tx-bold" style="vertical-align: top;">:</td>
                            <td class="tx-bold" style="vertical-align: top;"><?= $data->attention; ?></td>
                        </tr>

                    </tbody>
                </table>
            </td>
            <td style="width: 50%; text-align: right;border-right:solid 1.5px #000;border-top:solid 1.5px #000;padding: 10px">
                <table style="text-align: left;">
                    <tr>
                        <td class="tx-bold">P/O No.</td>
                        <td class="tx-bold">:</td>
                        <td class="tx-bold"><?= $data->po_number; ?></td>
                    </tr>
                    <tr>
                        <td class="tx-bold">P/O ISSUE DATE</td>
                        <td class="tx-bold">:</td>
                        <td class="tx-bold"><?= $data->po_date; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="bordered" style="width:100%">
        <thead>
            <tr style="background-color: #eee;">
                <th class="text-center align-top" style="width:30px">No</th>
                <th class="text-center align-top">Description</th>
                <th class="text-center align-top">Specification</th>
                <th class="text-center align-top" style="width:50px">QTY</th>
                <th class="text-center align-top" style="width:50px">Unit</th>
                <th class="text-center align-top" style="width:100px">Unit Price (<?= $symbol[$data->currency]; ?>)</th>
                <th class="text-center align-top" style="width:100px">Amount (<?= $symbol[$data->currency]; ?>)</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = $total = 0;
            foreach ($details as $dtl) :
                $n++;
                $total += $dtl->total_price ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td class="fontA"><?= $dtl->product_name; ?></td>
                    <td class="fontA"><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->qty; ?></td>
                    <td class="text-center text-uppercase"><?= $dtl->unit; ?></td>
                    <td class="text-right">
                        <div class="d-flex justify-content-between">
                            <span><?= $symbol[$data->currency]; ?></span>
                            <span> <?= number_format($dtl->unit_price, 2); ?></span>
                        </div>
                    </td>
                    <td class="text-right">
                        <div class="d-flex justify-content-between">
                            <span><?= $symbol[$data->currency]; ?></span>
                            <span><?= number_format($dtl->total_price, 2); ?></span>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #eee;">
                <th colspan="6" class="text-right text-uppercase">Total <?= substr($data->incoterm, 0, 3); ?></th>
                <th class="text-right text-uppercase">
                    <div class="d-flex justify-content-between">
                        <span><?= $symbol[$data->currency]; ?></span>
                        <span><?= number_format($total, 2); ?></span>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>

    <div class="form-group">
        <h4 for="" class="tx-bold tx-dark">This P/O amount :</h4>
        <p style="width: 50%;border:1px solid #000">&nbsp;</p>
        <!-- <input type="text" readonly id="" class="form-control form-control-sm rounded-0 w-50" style="border:1px solid #777"> -->
    </div>


    <h4>PAYMENT TERMS :</h4>
    <table style="width:50%;padding-left: 20px;">
        <tr>
            <td>1. Place Of Delivery</td>
            <td>: <?= $data->company_name; ?></td>
        </tr>
        <tr>
            <td>2. Terms of Payment</td>
            <td>: T/T After Shipment</td>
        </tr>
        <tr>
            <td>3. Remarks</td>
            <td>: -</td>
        </tr>
    </table>

    <br><br><br>
    <table style="width:100%;">
        <tr>
            <td class="text-center">
            </td>
            <td></td>
            <td class="text-center" width="30%">
                <h4>Approve By :
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </h4>
            </td>
        </tr>
        <tr>
            <td class="text-center"></td>
            <td></td>
            <td class="text-center">
                <h4><?= $data->approve_by; ?></h4>
            </td>

        </tr>
    </table>

    <div class="form-group">
        <h4 for="" class="tx-dark tx-bold"> </h4>
        <p class="tx-dark"></p>
    </div>
</body>

</html>