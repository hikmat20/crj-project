<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($shipping)) ? $shipping->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="container_id">Conatainer Size </label>
        </div>
        <div class="col-md-7">:
            <?= $ArrConte[$container->id]; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="cost_value" class="tx-dark tx-bold">Cost Value </label>
        </div>
        <div class="col-md-7">:
            <?= (isset($shipping) && $shipping->cost_value) ? number_format($shipping->cost_value) : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($shipping) && $shipping->description) ? $shipping->description : null; ?>
        </div>
    </div>
</div>