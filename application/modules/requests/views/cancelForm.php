<div class="card-body">
    <h6 class="tx-dark">Please provide your reasons for making this cancellation.</h6>
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="form-group">
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" value="1">
            <span>Incorrect data entry</span>
        </label>
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" value="2">
            <span>Cancellation requests from customers</span>
        </label>
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" value="3">
            <span>Data change</span>
        </label>
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" value="4">
            <span>User error</span>
        </label>
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" value="5">
            <span>Dummy data only</span>
        </label>
        <label class="rdiobox rdiobox-success">
            <input name="rdio" type="radio" id="other" value="0">
            <span>Etc.</span>
        </label>
    </div>
    <div class="form-group">
        <textarea name="cancel_reason" readonly class="form-control" id="cancel_reason" cols="30" rows="5" placeholder="Cancel Reason..."></textarea>
    </div>
    <button type="submit" class="btn btn-sm btn-danger text-center" id="cancel"><i class="fa fa-minus-circle"></i> Cancel Request</button>
</div>