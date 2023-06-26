<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($custom)) ? $custom->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold"> Container Size</span>
        </div>
        <div class="col-md-7">:
            <strong class="text-dark"><?= $ArrConte[$custom->container_id]; ?></strong>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">Cost Value</span>
        </div>
        <div class="col-md-7">:
            Rp. <?= (isset($custom) && $custom->cost_value) ? number_format($custom->cost_value) : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($custom) && $custom->description) ? $custom->description : null; ?>
        </div>
    </div>
</div>