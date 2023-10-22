<form id="form-create-bill-of-lading" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <h4 class="text-center tx-dark tx-bold"> BILL OF LADING <small>B/L No.</small> </h4>
            <p for="" class=" tx-dark text-center">TO BE USED WITH CHARTER-PARTIES</p>
            <hr class="border-dark">
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Shipper: <span class="tx-danger">*</span></label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?= $dataSO->supplier_name; ?>" placeholder="Shipper Name" required data-parsley-inputs>
                    </div>
                    <div class="form-group">
                        <textarea name="supplier_address" required id="supplier_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->supplier_address; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Notify address: <span class="tx-danger">*</span></label>
                        <textarea name="notify_address" required id="notify_address" rows="3" class="form-control form-controlsm" placeholder="Address">SAME AS CONSIGNEE</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">References No. <span class="tx-danger">*</span></label>
                        <input type="text" name="reference" required id="reference" class="wd-50p form-control" value="<?= $dataSO->invoice_number; ?>" placeholder="xxx-xxx-xxxx">
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Consignee: <span class="tx-danger">*</span></label>
                        <input type="text" required id="company_name" class="form-control form-controlsm" placeholder="Company Name" value="<?= ($dataSO->qq == 'Y') ? $dataSO->company_name . " QQ " . $dataSO->qq_company_name : $dataSO->company_name; ?>">
                    </div>
                    <div class="form-group">
                        <textarea name="company_address" required id="company_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->company_address; ?></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">NPWP</label>
                            <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $dataSO->vat; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" name="email" required id="email" class="form-control text-uppercase" placeholder="Email" value="<?= $dataSO->email; ?>">

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="tx-bold tx-dark">Vessel: <span class="tx-danger">*</span></label>
                                <input type="text" required name="vessel" id="vessel" class="form-control form-controlsm" placeholder="Vessel">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="tx-bold tx-dark">Port of Loading: <span class="tx-danger">*</span></label>
                                <input type="text" required name="from" id="from" class="form-control form-controlsm" value="<?= $dataSO->from; ?>" placeholder="Port of Loading">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Port of Discharge: <span class="tx-danger">*</span></label>
                        <input type="text" required name="to" id="to" class="form-control form-controlsm" value="<?= $dataSO->to; ?>" placeholder="Port of Discharge">
                    </div>
                </div>
            </div>

            <hr class="border-dark">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">SHIPPING MARK <span class="tx-danger">*</span></label>
                        <textarea required name="shipping_mark" id="shipping_mark" class="form-control" placeholder="N/M" value="N/M" aria-describedby="helpId">N/M</textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Shipper’s description of goods <span class="tx-danger">*</span></label>
                        <!-- <input type="text" required name="description_goods_1" id="description_goods_1" class="form-control" placeholder="Description 1" aria-describedby="helpId"> -->
                        <p class="tx-dark"><?= $dataSO->qty_container . "x" . $ArrContainer[$dataSO->container_id] . " (" . strtoupper($totalPackage . ") " . $dataSO->package); ?></p>
                    </div>
                    <div class="form-group">
                        <!-- <textarea name="description_goods_2" id="description_goods_2" class="form-control" placeholder="Description 2" aria-describedby="helpId"></textarea> -->
                        <?php
                        $totalDTL = 0;
                        if ($details) foreach ($details as $dtl) :
                        ?>
                            <p class="tx-dark">
                                <?= $dtl['product_name']; ?><br>
                                HS CODE: <?= substr(substr_replace($dtl['local_hscode'], ".", 4, 0), 0, 7); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FREIGHT PREPAID <span class="tx-danger">*</span></label>
                        <!-- <textarea name="freight_prepaid" required id="freight_prepaid" class="form-control" placeholder="SAY TOTAL : " aria-describedby="helpId">SAY TOTAL:</textarea> -->
                        <p class="tx-dark text-uppercase"><?= numberTowords(($totalPackage)); ?> (<?= ($totalPackage) ?>) <?= $dataSO->package ?> ONLY</p>
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
                                <input type="hidden" name="weight" id="weight" class="form-control text-center" placeholder="0" value="<?= $dataSO->total_gross_weight; ?>">
                            </div>
                            <div class="col-md-6 text-center">
                                <span class="tx-dark"><?= number_format($totalCBM, 3); ?>CBM</span>
                                <input type="hidden" name="volume" id="volume" class="form-control text-center" placeholder="0" value="<?= $dataSO->total_cbm; ?>">
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
                        <label for="" class="tx-dark tx-bold">Place and date of issue <span class="tx-danger"></span></label>
                        <input type="text" name="place_and_date" id="place_and_date" class="form-control" placeholder=".........,.............,........">
                    </div>
                </div>
            </div>

            <!-- <p for="" class="text-center tx-dark">(of which __________ on deck at Shipper’s risk: the Carrier not being responsible for loss or damage howsoever arising)</p>
            <table class="table table-sm table-borderless border border-dark mg-0 tx-dark">
                <tbody>
                    <tr>
                        <td class="border-right border-dark" style="width:50%">
                            <p>Freight payable as per <br>
                                CHARTER-PARTY dated
                            </p>
                        </td>

                        <td>
                            <p>
                                SHIPPED at the Port of Loading in apparent good order and condition on
                                board the Vessel for carriage to the Port of Discharge or so near thereto
                                as she may safely get the goods specified above.

                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right border-dark">
                            <p>FREIGHT ADVANCE. <br><br>
                                Received on account of freight:
                            </p>
                        </td>
                        <td>
                            <p>Weight, measure, quality, quantity, condition, contents and value unknown</p>
                            <p>
                                IN WITNESS whereof the Master or Agent of the said Vessel has signed the number of Bills of Lading indicated below all of this tenor and date, any one of which being accomplished the others shall be void.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right border-dark">
                            <p>Time used for loading ______ days ______ hours</p>
                        </td>
                        <td>
                            <p>
                                FOR CONDITIONS OF CARRIAGE SEE OVERLEAF
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-borderless border border-dark mg-0 tx-dark">
                <tbody>
                    <tr>
                        <td class="align-middle border-right border-dark" rowspan="3" style="width:33%">
                            <small class="tx-sm">
                                Printed and sold by <br>
                                Fr g Knudtzons Bogtrykkeri A/S, 55 Toldbodgade . DK-1253 Copenhagen K, <br>
                                Telefax + 4533931184 <br>
                                by authority of the Baltic and International Maritime Council <br>
                                (BIMCO). Copenhagen
                            </small>
                        </td>
                        <td style="width:25%" class="border-bottom border-right border-dark align-text-top">
                            <p>Freight payable at</p>
                            <br>
                        </td>
                        <td class="border-bottom border-dark align-text-top">
                        </td>
                    </tr>
                    <tr>
                        <td class="border-right border-dark">
                            Number of original BS/L
                            <br>
                            <br>
                            <p>ONE</p>
                        </td>
                        <td>
                            Signature
                            <br>
                            <br>
                            <p>
                                AS AGENT FOR AND ON BEHALF OF THE MASTER OF NAVI SUNNY
                            </p>
                        </td>
                    </tr>
                </tbody>

            </table> -->
            <div class="text-center mg-t-20">
                <button type="submit" class="btn btn-primary text-center wd-100" id="save-bl"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>