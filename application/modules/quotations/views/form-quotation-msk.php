<div class="br-pagetitle mg-b-0">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>

<?php if (Template::message()) : ?>
<div class="pd-x-20 pd-t-10">
    <?php echo Template::message(); ?>
</div>
<?php endif; ?>

<div class="br-pagebody pd-x-20 pd-sm-x-30">
    <form id="data-form">
        <div class="card bd-gray-400">
            <div class="card-body">
                <div class="row pd-x-20">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="number" class="tx-dark tx-bold col-md-3 pd-x-0">Number</label>
                            <input type="text" id="number" value="" readonly
                                class="form-control form-control-sm col-md-7" placeholder="Number">
                        </div>
                        <div class="form-group row">
                            <label for="customer_name" class="tx-dark tx-bold col-md-3 pd-x-0">Customer</label>
                            <div class="col-md-7">
                                <div id="slWrCustomer" class=" parsley-select">
                                    <select name="customer_id" id="customer_id" class="form-control select" required
                                        data-parsley-inputs data-parsley-class-handler="#slWrCustomer"
                                        data-parsley-errors-container="#errCompany">
                                        <option value=""></option>
                                        <?php if ($customers) foreach ($customers as $cust) : ?>
                                        <option value="<?= $cust->id_customer; ?>">
                                            <?= $cust->customer_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div id="errCustomer"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project_name" class="tx-dark tx-bold col-md-3 pd-x-0">Project Name</label>
                            <input type="text" name="project_name" id="project_name" value=""
                                class="form-control col-md-7" placeholder="Project Name">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="date-request" class="tx-dark tx-bold col-md-4 pd-x-0">Date Quotation</label>
                            <input type="date" id="date-quotation" name="date" value=""
                                class="form-control form-control-sm col-md-7" placeholder="-">
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="tx-dark tx-bold col-md-4 pd-x-0">Description</label>
                            <textarea type="text" id="desc" name="description"
                                class="form-control form-control-sm col-md-7" placeholder="Description"></textarea>
                        </div>

                    </div>
                </div>

                <hr>

                <hr>
                <div class="md-10 text-center">
                    <button type="submit" class="btn btn-primary wd-100-force">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <a href="<?= base_url($this->uri->segment(1)); ?>" type="button"
                        class="btn btn-danger wd-100-force">
                        <i class="fa fa-reply"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
$(document).ready(function() {


})
</script>