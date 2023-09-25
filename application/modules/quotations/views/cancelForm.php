<div class="card-body">
    <h5 class="tx-dark mb-4">Please provide your reasons for making this cancellation.</h5>
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="form-group">
        <div id="errRdio" class="parsley-checkbox mg-b-10 rounded">
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" value="1" required data-required="true" data-parsley-inputs="" data-parsley-class-handler="#errRdio" data-parsley-errors-container="#errContainer">
                <span>Incorrect data entry</span>
            </label>
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" value="2" required>
                <span>Cancellation quotation from customers</span>
            </label>
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" value="3" required>
                <span>Data change</span>
            </label>
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" value="4" required>
                <span>User error</span>
            </label>
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" value="5" required>
                <span>Dummy data only</span>
            </label>
            <label class="rdiobox rdiobox-success">
                <input name="rdio" type="radio" id="other" value="0" required>
                <span>Etc.</span>
            </label>
        </div>
        <div id="errContainer"></div>
    </div>
    <div class="form-group">
        <textarea name="cancel_reason" readonly class="form-control" id="cancel_reason" cols="30" rows="5" placeholder="Cancel Reason..."></textarea>
    </div>
    <button type="submit" class="btn float-right btn-outline-danger text-center" id="cancel"><i class="fa fa-minus-circle"></i> Cancel Quotation</button>
</div>