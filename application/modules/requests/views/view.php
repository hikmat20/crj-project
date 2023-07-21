<section class="pd-x-10">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="id" class="tx-dark tx-bold">Number</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request)) ? $request->number : null; ?>
                </div>
            </div>
            <div class="row" id="input-customer">
                <div class="col-md-4">
                    <label for="customer_id" class="tx-dark tx-bold">Customer</label>
                </div>
                <div class="col-md-7">:
                    <?= $ArrCustomer[$request->customer_id]; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="project_name" class="tx-dark tx-bold">Project Name</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->project_name) ? $request->project_name : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="origin_country_id" class="tx-dark tx-bold">Origin</label>
                </div>
                <div class="col-md-7">:
                    <?= $ArrCountryCode[$request->origin_country_id] . " - " . $ArrCountry[$request->origin_country_id]; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="marketing_name" class="tx-dark tx-bold">Marketing</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->marketing_id) ? $ArrEmpl[$request->marketing_id] : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="date" class="tx-dark tx-bold">Date Request</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="description" class="tx-dark tx-bold">Description</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->description) ? $request->description : null; ?>
                </div>
            </div>
        </div>
    </div>
    <hr>
</section>
<section class="pd-x-10">
    <div class="d-flex justify-content-between mg-b-10">
        <span class="h4 tx-dark tx-bold">List HS Code</span>
    </div>
    <table id="listHscode" class="table table-sm border table-bordered table-hover">
        <thead class="bg-light">
            <tr>
                <th class="text-center">No</th>
                <th width="35%">Product Name</th>
                <th class="text-center">Specification</th>
                <th class="text-center">Origin HS Code</th>
                <th class="text-center" width="100">Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = 0;
            if (isset($dtlRequest)) foreach ($dtlRequest as $dtl) : $n++;
                $image = $dtl->image ? base_url('/assets/uploads/' . $dtl->check_hscode_id . "/") . $dtl->image : base_url('assets/no-image.jpg');
                $img = ($dtl->image) ? $dtl->image : ''; ?>
                <tr data-row="<?= $n; ?>" class="tx-dark">
                    <td class="rowIdx text-center"><?= $n; ?></td>
                    <td><?= $dtl->product_name; ?></td>
                    <td><?= $dtl->specification; ?></td>
                    <td><?= $dtl->origin_hscode; ?></td>
                    <td class="text-center"><img src="<?= $image; ?>" data-row="<?= $n; ?>" width="80" class="img-fluid rounded" alt="<?= $image; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>