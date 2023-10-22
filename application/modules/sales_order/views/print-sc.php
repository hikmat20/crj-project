<!DOCTYPE html>
<html>

<head>
    <title><?= $data->supplier_name; ?> [<?= $data->sc_number; ?>]</title>
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
    <h2 class="text-center">
        <p class="fontA " style="margin:0">成交确认书</p>
        <u>SALES CONTRACT</u>
    </h2>
    <table width="100%" style="border-collapse:collapse;">
        <tr>
            <td style="width:50%;">
                <table>
                    <tbody>
                        <tr class="tx-bold">
                            <td class="" style="vertical-align: bottom;">
                                <p class="fontA">卖方</p>
                                Seller
                            </td>
                            <td class="tx-" style="vertical-align: bottom;">:</td>
                            <td class="tx-bold" style="vertical-align: bottom;"><?= $data->supplier_name; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <p class="fontA">
                                    地址
                                </p>
                                Address
                            </td>
                            <td style="vertical-align: bottom;">:</td>
                            <td style="vertical-align: bottom;">
                                <?= $data->supplier_address; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <p class="fontA">传 真</p>
                                Fax
                                <br>
                                <br>
                                <br>
                            </td>
                            <td style="vertical-align: bottom;">:
                                <br>
                                <br>
                                <br>
                            </td>
                            <td style="vertical-align: bottom;">
                                <?= $data->supplier_fax; ?>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td class="" style="vertical-align: bottom;">
                                <p class="fontA">买方</p>
                                Buyers
                            </td>
                            <td style="vertical-align: bottom;">:</td>
                            <td class="tx-bold" style="vertical-align: bottom;">
                                <?= $data->company_name; ?>
                               
                            </td>
                        </tr>
                        <tr>
                            <td class="">
                                <p class="fontA">地址</p>
                                Address
                            </td>
                            <td style="vertical-align: bottom;">:</td>
                            <td style="vertical-align: bottom;">
                                <?= $data->company_address; ?> <br>
                                NWPW : <?= $data->vat; ?> <br>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: bottom;">
                                <p class="fontA">传 真</p>
                                Fax
                                <br>
                                <br>
                                <br>
                            </td>
                            <td style="vertical-align: bottom;">:
                                <br>
                                <br>
                                <br>
                            </td>
                            <td style="vertical-align: bottom;">
                                <?= $data->company_fax; ?>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; text-align: right;vertical-align: top;">
                <table style="text-align: left;">
                    <tr>
                        <td class="" width="55%">
                            <p class="fontA"> 字第</p>
                            No.
                        </td>
                        <td class="" style="vertical-align: bottom;">:</td>
                        <td class="" style="vertical-align: bottom;"><?= $data->sc_number; ?></td>
                    </tr>
                    <tr>
                        <td class="">
                            <p class="fontA"> 日 期</p>
                            Date
                        </td>
                        <td class="" style="vertical-align: bottom;">:</td>
                        <td class="" style="vertical-align: bottom;"><?= $data->sc_date; ?></td>
                    </tr>
                    <tr>
                        <td class="">
                            <p class="fontA"> 签约地点</p>
                            Signed At
                        </td>
                        <td class="" style="vertical-align: bottom;">:</td>
                        <td class="" style="vertical-align: bottom;"><?= $data->signed_at; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p class="fontA">兹经买卖双方同意成交下列商品订立条款如下</p>
    <p class="ext-center">The undersigned sellers and buyers have agreed to close the following transactions according to the terms and conditions stipulated below:</p>
    <table class="bordered" style="width:100%">
        <thead>
            <tr style="background-color: #eee;">
                <td class="text-center align-top" style="width:30px">No</th>
                <td class="text-center align-top">
                    <p for="" class="fontA">商 品</p> Name of Commodity</th>
                <td class="text-center align-top">Specification</th>
                <td class="text-center align-top" style="width:50px" colspan="2">
                    <p class="fontA">数 量</p> Quantity</th>
                <td colspan="2" class="text-center align-top" style="width:100px">
                    <p class="fontA">单 价</p>
                    Unit Price (<?= $data->currency; ?>)
                    </th>
                <td colspan="2" class="text-center align-top" style="width:100px">
                    <p class="fontA">合 计</p>
                    Value (<?= $data->currency; ?>)
                    </th>
            </tr>
            <tr>
                <td colspan="5" style="border-right:0"></td>
                <th colspan="2" class="text-center" style="border-right:0"><?= ($data->incoterm); ?></th>
                <td colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            <?php $n = $total = 0;
            foreach ($details as $dtl) :
                $n++;
                $total += $dtl->total_price ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td class="fontA text-center"><?= $dtl->product_name; ?></td>
                    <td class="fontA text-center"><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->qty; ?></td>
                    <td class="text-center text-uppercase"><?= strtoupper($dtl->unit); ?></td>
                    <td width="10" style="border-right:0"><?= $symbol[$data->currency]; ?></td>
                    <td class="text-right">
                        <span> <?= number_format($dtl->unit_price, 2); ?></span>
                    </td>
                    <td width="10" style="border-right:0"><?= $symbol[$data->currency]; ?></td>
                    <td class="text-right">
                        <span><?= number_format($dtl->total_price, 2); ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #eee;">
                <th colspan="7" class="text-right text-uppercase">Total <?= substr($data->incoterm, 0, 3); ?></th>
                <th style="border-right:0"><?= $symbol[$data->currency]; ?></th>
                <th class="text-right text-uppercase">
                    <div class="d-flex justify-content-between">
                        <span><?= number_format($total, 2); ?></span>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
    <p class="fontA">数量及总值均得有 100 ％的增减</p>
    <p for="" class=" tx-dark">Re payment transfer 100 % after shipment (90 days )</p>

    <table class="table table-sm table-borderless tx-dark">
        <tr>
            <td width="25%">
                <p class="fontA">包装</p>
                Packing
            </td>
            <td width="25%">: <?= $data->package; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="fontA">装运期</p>
                Time of Shipment
            </td>
            <td>: T/T</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="fontA">装运口岸和目的地</p>
                Loading Port & Destination
            </td>
            <td>: FROM : <?= $data->from; ?> </td>
            <td>TO : <?= $data->to; ?></td>
        </tr>
        <tr>
            <td>
                <p class="fontA">保险</p>
                Insurance
            </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="fontA">付款条件</p>
                Terms of Payment
            </td>
            <td>: T/T</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p class="fontA">装船标记</p>
                Shipping Mark
            </td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="fontA">品质、数量、重量以中国商品检验局检验证或卖方所出之证明书为最后依据。</p>
                Quality,quantity and weight certified by the China Commodity Inspection Bureau or the Sellers
                as per the former's Inspection Certificate or the latter's certificate,are to be taken as final.
            </td>
            <td></td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table width="100%">
        <thead>
            <tr>
                <td class="text-center">
                    <p class="fontA">买 方</p>
                    THE BUYERS
                </td>
                <td></td>
                <td class="text-center">
                    <p class="fontA">卖 方</p>
                    THE SELLERS
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
    </table>
</body>

</html>