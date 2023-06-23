<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee)) ? $fee->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <span>Lartas</span>
        </div>
        <div class="col-md-7 tx-dark tx-bold">:
            <?= (isset($fee)) ? $fee->lartas : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">Fee Value</span>
        </div>
        <div class="col-md-7">:
            Rp. <?= (isset($fee)) ? number_format($fee->fee_value) : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee) && $fee->description) ? $fee->description : null; ?>
        </div>
    </div>
</div>