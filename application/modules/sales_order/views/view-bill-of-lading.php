<form id="form-create-bill-of-lading" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <h4 class="text-center tx-dark tx-bold"> BILL OF LADING <small>B/L No.</small> </h4>
            <p for="" class=" tx-dark text-center">TO BE USED WITH CHARTER-PARTIES</p>
            <hr class="border-dark">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-md-3 tx-12">Shipper</label>
                        <div class="col-md-9">
                            <p>: <?= $dataSO->supplier_name; ?></p>
                            <p><?= $dataSO->supplier_address; ?></p>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-md-3 tx-12">Notify address</label>
                        <div class="col-md-9"> :
                            <?= $dataSO->notify_address; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="tx-dark tx-bold col-md-3 tx-12">References No.</label>
                        <div class="col-md-9">:
                            <?= $dataSO->reference; ?>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-md-3 tx-12">Consignee</label>
                        <div class="col-md-9">
                            <p>: <?= ($dataSO->qq == 'Y') ? $dataSO->company_name . " QQ " . $dataSO->qq_company_name : $dataSO->company_name; ?></p>
                            <p>
                                <?= $dataSO->company_address; ?> <br>
                                NPWP : <?= $dataSO->vat; ?> <br>
                                EMAIL : <?= strtoupper($dataSO->email); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="tx-bold tx-dark tx-12">Vessel:</label>
                                <p> <?= $dataSO->vessel; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="tx-bold tx-dark tx-12">Port of Loadnig:</label>
                                <p><?= $dataSO->from; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark tx-12">Port of Discharge:</label>
                        <p><?= $dataSO->to; ?></p>
                    </div>
                </div>
            </div>

            <hr class="border-dark">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold tx-12">SHIPPING MARK</label>
                        <p><?= $dataSO->shipping_mark; ?></p>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Shipper’s description of goods <span class="tx-danger">*</span></label>
                        <p class="tx-dark"><?= $dataSO->qty_container . "x" . $ArrContainer[$dataSO->container_id] . " (" . strtoupper($totalPackage . ") " . $dataSO->package); ?></p>
                    </div>
                    <div class="form-group">
                        <?php if ($details) foreach ($details as $dtl) : ?>
                            <p class="tx-dark">
                                <?= $dtl['product_name']; ?><br>
                                HS CODE: <?= substr(substr_replace($dtl['local_hscode'], ".", 4, 0), 0, 7); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FREIGHT PREPAID <span class="tx-danger">*</span></label>
                        <p class="tx-dark text-uppercase"><?= numberTowords(($totalPackage)); ?> (<?= ($totalPackage)  ?>) <?= $dataSO->package ?> ONLY</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group text-center">
                        <label for="" class="tx-dark tx-bold">Gross weight <span class="tx-danger">*</span><br>
                            "SAID TO BE" "SAID TO WEIGHT / MEASUREMENT"
                        </label>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <span class="tx-dark"><?= number_format($totalGW, 3); ?>KGS</span>
                            </div>
                            <div class="col-md-6 text-center">
                                <span class="tx-dark"><?= number_format($totalCBM, 3); ?>CBM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr class="border-dark">
            <div class="row">
                <div class="col-md-3 offset-9">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold tx-12">Place and date of issue</label><br>
                        <?= $dataSO->place_and_date; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>