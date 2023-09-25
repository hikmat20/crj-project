<div class="card border-0 shadow-sm mb-3">
    <div class="card-body">
        <div class="form-group">
            <label for="" class="tx-dark tx-bold">Origin HS Code</label>
            <input type="text" required data-parsley-inputs name="origin_hscode" class="form-control" placeholder="HS Code" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="" class="tx-dark tx-bold">Product Name</label>
            <input type="text" required data-parsley-inputs name="product_name" class="form-control" placeholder="Product Name" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="" class="tx-dark tx-bold">Specification</label>
            <textarea type="text" name="specification" class="form-control" placeholder="Specification" aria-describedby="helpId"></textarea>
        </div>
    </div>
</div>
<div id="hscode-data" class="mb-3"></div>
<div class="d-flex justify-content-between">
    <button type="button" id="select-hscode" class="btn btn-outline-primary rounded-pill mg-r-5">
        <div><i class="fa fa-"></i> Select HS Code</div>
    </button>
    <button type="submit" id="save-item" class="btn btn-outline-primary rounded-pill mg-r-5">
        <div><i class="fa fa-save"></i> Save Item</div>
    </button>
</div>