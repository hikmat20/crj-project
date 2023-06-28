<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-3">
            <label for="id" class="tx-dark tx-bold">ID Number</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($freight)) ? $freight->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3 tx-dark tx-bold">
            <label for="port_id">Shipment Port </label>
        </div>
        <div class="col-md-7">:
            <?= $freight->port_id; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3 tx-dark tx-bold">
            <label for="container_id">Container Size </label>
        </div>
        <div class="col-md-7">:
            <?= $freight->container_id; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="cost_value" class="tx-dark tx-bold">Cost Value </label>
        </div>
        <div class="col-md-7">:
            <?= (isset($freight)) ? number_format($freight->cost_value) : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($freight) && $freight->description) ? $freight->description : null; ?>
        </div>
    </div>
</div>