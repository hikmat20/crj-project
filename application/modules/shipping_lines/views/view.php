<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($shipping)) ? $shipping->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Conatainer Size </span>
        </div>
        <div class="col-md-7">:
            <strong class="tx-dark"><?= $ArrConte[$shipping->container_id]; ?></strong>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Cost Value </span>
        </div>
        <div class="col-md-7">:
            Rp. <?= (isset($shipping) && $shipping->cost_value) ? number_format($shipping->cost_value) : 0; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($shipping) && $shipping->description) ? $shipping->description : null; ?>
        </div>
    </div>
</div>