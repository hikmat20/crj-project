<?php
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Data Item SO (" . $header->number . ").xlsx");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Item SO [<?= $header->number; ?>]</title>
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
    <h3>Data Item SO </h3>
    <table class="bordered">
        <thead>
            <tr style="background-color: #ccc;">
                <th class="align-middle text-center" width="30">NO</th>
                <th class="align-middle text-center">ID</th>
                <th class="align-middle text-center">DESCRIPTION OF GOODS</th>
                <th class="align-middle text-center">SPECIFICATION</th>
                <th class="align-middle text-center" width="50">QTY</th>
                <th class="align-middle text-center" width="50">UNIT</th>
                <th class="align-middle text-right" width="100">UNIT PRICE()</th>
                <th class="align-middle text-right" width="100">PACKAGES</th>
                <th class="align-middle text-right" width="100">UNIT PACKAGES</th>
                <th class="align-middle text-right" width="100">N.W (KGS)</th>
                <th class="align-middle text-right" width="100">G.W (KGS)</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = 0;

            foreach ($detail as $dtl) :
                // exit;
                $n++; ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td class=""><?= $dtl->id; ?></td>
                    <td class=""><?= $dtl->product_name; ?></td>
                    <td class=""><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->qty; ?></td>
                    <td class="text-center"><?= $dtl->unit; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>