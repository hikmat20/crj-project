<!DOCTYPE html>
<html>

<head>
    <title>BILL OF LADING [<?= $data->number; ?>]</title>
    <style>
        body {
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
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

        table td {
            padding: 5px;
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

    <table width="100%">
        <tr>
            <td style="width: 50%;padding:0 5px">
                <hr style="color:#000;">
            </td>
            <td>
                <h3 class="text-center tx-dark tx-bold" style="padding:5px"> BILL OF LADING <small>B/L No.</small> </h3>
                <small for="" class=" tx-dark text-center" style="padding-top:10px ;">TO BE USED WITH CHARTER-PARTIES</small>
            </td>
        </tr>
        <tr>
            <td>
                <small for="" style="margin-bottom:20px">Shipper:</small>
                <p><?= $data->supplier_name; ?></p>
                <p><?= $data->supplier_address; ?></p>
                <br>
                <br>
            </td>
            <td class="text-right">
                <p>Reference No.: <?= $data->reference; ?> </p>
            </td>
        </tr>
        <tr>
            <td style="border-top:1px solid #000;">
                <small for="" style="margin-bottom:200px;">Consignee:</small>
                <p><?= ($data->qq == 'Y') ? $data->company_name . " QQ " . $data->qq_company_name : $data->company_name; ?></p>
                <p><?= $data->company_address; ?> <br>
                    NPWP : <?= ($data->vat); ?> <br>
                    EMAIL : <?= strtoupper($data->email); ?> <br>
                </p>
                <br>
                <br>
            </td>
            <td></td>
        </tr>
        <tr>
            <td style="border-top:1px solid #000;">
                <small for="" style="margin-bottom:200px;">Notify address:</small>
                <p style="margin-bottom:200px;"><?= $data->notify_address; ?></p>
                <br>
                <br>
            </td>
            <td></td>
        </tr>
    </table>
    <table width="50%" style="border-top:1px solid #000;">
        <tr>
            <td style="width:60%">
                <small for="" class="tx-dark">Vessel:</small>
                <p> <?= $data->vessel; ?></p>
                <br>
                <br>
            </td>
            <td>
                <small for="" class="tx-dark">Port of Loading:</small>
                <p><?= $data->from; ?></p>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-top:1px solid">
                <small for="" class="tx-dark">Port of Discharge:</small>
                <p><?= $data->to; ?></p>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" style="border-top:1px solid #000">
        <tr>
            <td width="25%" style="vertical-align: top;font-size:8pt">
                <small for="" class="tx-dark">SHIPPING MARK</small>
            </td>
            <td class="text-" style="width:40%;vertical-align: top;font-size:8pt">
                <small for="" class="tx-dark">Shipper’s description of goods</small>

            </td>
            <td class="text-center" style="vertical-align: top;font-size:7pt">
                <small for="" class="tx-dark">Gross weight <br></small>
                <small>""SAID TO BE" "SAID TO WEIGHT / MEASUREMENT""</small>
            </td>
        </tr>
        <tr>
            <td class="" style="vertical-align: top;">
                <p><?= $data->shipping_mark; ?></p>
            </td>
            <td class="text-left">
                <p class="tx-dark"><?= $data->qty_container . "x" . $ArrContainer[$data->container_id] . " (" . strtoupper($totalPackage . ") " . $data->package); ?></p>
                <br>
                <?php if ($details) foreach ($details as $dtl) : ?>
                    <p class="tx-dark">
                        <?= $dtl['product_name']; ?><br>
                        HS CODE: <?= substr(substr_replace($dtl['local_hscode'], ".", 4, 0), 0, 7); ?>
                    </p>
                    <br>
                <?php endforeach; ?>
            </td>
            <td class="text-center" style="vertical-align: top;">
                <table width="100%">
                    <tr>
                        <td class="text-center">
                            <?= $totalGW; ?>KGS
                        </td>
                        <td class="text-center">
                            <?= $totalCBM; ?>CBM
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <br>
                <strong for="" class="tx-dark tx-bold">FREIGHT PREPAID</strong>
                <br>
                <br>
                <p class="tx-dark"><?= strtoupper(numberTowords(($totalPackage)) . " (" . ($totalPackage) . ") " . $data->package); ?> ONLY</p>
            </td>
            <td></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <p class="text-center "><small for="" class="tx-dark">(of which __________ on deck at Shipper’s risk: the Carrier not being responsible for loss or damage howsoever arising)</small></p>
    <br>
    <table width="100%" style="border:1px solid #000;border-collapse: collapse;">
        <tr>
            <td class="border-right border-dark" style="width:50%;border-right:1px solid #000;font-size: 6pt;vertical-align: top;">
                <small>Freight payable as per</small>
                <p>CHARTER-PARTY dated</p>

                <br>
                <br>

                <p>FREIGHT ADVANCE. <br><br>
                    Received on account of freight:
                </p>
                <br>
                <br>
                <br>
                <p>Time used for loading ______ days ______ hours</p>
            </td>
            <td style="font-size: 6pt;">
                <p>
                    SHIPPED at the Port of Loading in apparent good order and condition on
                    board the Vessel for carriage to the Port of Discharge or so near thereto
                    as she may safely get the goods specified above.
                </p>
                <br>
                <p>Weight, measure, quality, quantity, condition, contents and value unknown</p>
                <br>
                <p>
                    IN WITNESS whereof the Master or Agent of the said Vessel has signed the number of Bills of Lading indicated below all of this tenor and date, any one of which being accomplished the others shall be void.
                </p>
                <br>
                <br>
                <p>FOR CONDITIONS OF CARRIAGE SEE OVERLEAF</p>
            </td>
        </tr>
    </table>
    <table width="100%" style="border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;border-collapse: collapse;font-size:6pt">
        <tbody>
            <tr>
                <td rowspan="3" style="width:33%;border-right:1px solid #000;border-bottom:1px solid #000">
                    <!-- <p class="tx-sm">
                        Printed and sold by <br>
                        Fr g Knudtzons Bogtrykkeri A/S, 55 Toldbodgade . DK-1253 Copenhagen K, <br>
                        Telefax + 4533931184 <br>
                        by authority of the Baltic and International Maritime Council <br>
                        (BIMCO). Copenhagen
                    </p> -->
                </td>
                <td style="width:25%;border-right:1px solid #000;vertical-align: top;">
                    <p>Freight payable at</p>
                    <br>
                </td>
                <td style="vertical-align: top">
                    <p>Place and date of issue</p>
                    <br>
                    <?= $data->place_and_date; ?>
                </td>
            </tr>
            <tr>
                <td style="border-top:1px solid #000;border-right:1px solid #000;vertical-align: top">
                    Number of original BS/L
                    <br>
                    <br>
                    <br>
                    <p style="font-size:11pt">ONE</p>
                    <br>
                    <br>
                </td>
                <td style="border-top:1px solid #000;">
                    Signature
                    <br>
                    <br>
                    <br>
                    <p style="font-size:11pt">
                        AS AGENT FOR AND ON BEHALF OF THE MASTER OF NAVI SUNNY
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>