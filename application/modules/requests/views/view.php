<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($surveyor)) ? $surveyor->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">QTY Conatainer </span>
        </div>
        <div class="col-md-7">:
            <strong class="tx-dark"><?= $surveyor->qty_container; ?></strong>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Cost Value </span>
        </div>
        <div class="col-md-7">:
            Rp. <?= (isset($surveyor) && $surveyor->cost_value) ? number_format($surveyor->cost_value) : 0; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($surveyor) && $surveyor->description) ? $surveyor->description : null; ?>
        </div>
    </div>
</div>