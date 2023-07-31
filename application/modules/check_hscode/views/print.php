<!DOCTYPE html>
<html>

<head>
    <title><?= $request->customer_name; ?>[<?= $request->id; ?>]</title>
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
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            border-spacing: 0;
            border-collapse: collapse;

        }

        table.bordered td,
        table.bordered th {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 5px;
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
            font-size: 9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        img.resize {
            max-width: 12%;
            max-height: 12%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <table width="100%">
        <tr>
            <th width="200">Checking Number</th>
            <td width="20">:</td>
            <td><?= (isset($request)) ? $request->id : null; ?></td>
            <td></td>
            <th width="200">Marketing</th>
            <td width="20">:</td>
            <td><?= (isset($request) && $request->marketing_id) ? $request->marketing_id : ''; ?></td>
        </tr>
        <tr>
            <th>Customer</th>
            <td>:</td>
            <td><?= $request->customer_name; ?></td>
            <td></td>
            <th>Date Request</th>
            <td>:</td>
            <td><?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : date('d/m/Y'); ?></td>
        </tr>
        <tr>
            <th>Project Name</th>
            <td>:</td>
            <td><?= $request->project_name; ?></td>
            <th></th>
            <th>Desciption</th>
            <td>:</td>
            <td><?= (isset($request) && $request->description) ? $request->description : null; ?></td>
        </tr>
        <tr>
            <th>Origin</th>
            <td>:</td>
            <td><?= $request->country_code . " - " . $request->country_name; ?></td>
        </tr>
    </table>
    <!-- details -->
    <hr>
    <h3 class="tx-dark tx-bold">List Products</h3>
    <table class="bordered" width="100%">
        <thead>
            <tr>
                <th width="50" class="text-center">No</th>
                <th width="" class="text-center">Product Name</th>
                <th width="200" class="text-center">Specification</th>
                <th width="100" class="text-center">Origin HS Code</th>
                <th width="100" class="text-center">Indonesia HS Code</th>
                <th width="120" class="text-center">Cost</th>
                <th width="130">Other Cost</th>
                <th width="">Docs. Requirement</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = 0;
            if ($details) foreach ($details as $dtl) : $n++; ?>
                <tr>
                    <td class="text-center"><?= $n; ?></td>
                    <td style="font-family: sun-exta"><?= $dtl->product_name; ?></td>
                    <td style="font-family: sun-exta"><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->origin_hscode; ?></td>
                    <td class="text-center" <?= isset($ArrHscode[$dtl->origin_hscode]) ? '' : 'bg-danger tx-white'; ?>><?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : 'N/A'; ?></td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                            <p><small>BM MFN : <?= ($ArrHscode[$dtl->origin_hscode]->bm_mfn) ?: '0'; ?>%</small></p>
                            <p><small>BM with ASK : <?= ($ArrHscode[$dtl->origin_hscode]->bm_e) ?: '0'; ?>%</small></p>
                            <p><small>PPn : <?= ($ArrHscode[$dtl->origin_hscode]->ppn == 'Y') ? $current_ppn : '0'; ?>%</small></p>
                            <p><small>PPH API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_api) ?: '0'; ?>%</small></p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                            <p><small>PPH Non API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_napi) ?: '0'; ?>%</small></p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->id)) :
                            $idHs = $ArrHscode[$dtl->origin_hscode]->id;
                        ?>
                            <?php if (isset($ArrDocs[$idHs])) : ?>
                                <?php if (isset($ArrDocs[$idHs]['RQ1'])) : ?>
                                    <?php foreach ($ArrDocs[$idHs]['RQ1'] as $d) : ?>
                                        <p>- <small><?= $d->name ?></small></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>


<div class="card-body">


    <table id="table-detail" class="table table-sm table-bordered border table-hover" width="100%">


    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true
        });

        $('.select.not-search').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true,
        });

        $('.cost_value').mask('#,##0', {
            reverse: true
        });

        window.Parsley.on('form:validated', function() {
            $('select').on('select2:select', function(evt) {
                $("#city_id").parsley().validate();
            });
        });
    });
</script>