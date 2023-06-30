<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee)) ? $fee->id : null; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="max_value">Maximum Value (Rp.)</label>
        </div>
        <div class="col-md-4">:
            <?= "<strong>≥</strong>" . (isset($fee)) ? number_format($fee->max_value) : null; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="country_id">Fee (%)</label>
        </div>
        <div class="col-md-4">:
            <?= (isset($fee)) ? $fee->fee : null; ?>%
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee) && $fee->description) ? $fee->description : null; ?>
        </div>
    </div>
</div>