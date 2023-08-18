<table class="table table-sm table-borderless">
    <thead class="tx-dark tx-bold">
        <tr>
            <td class="border-bottom">Lartas Name</td>
            <td class="text-right border-bottom">Price</td>
            <td class="text-center border-bottom" width="">Unit</td>
            <td class="text-center border-bottom" width="100">Qty</td>
            <td class="text-right border-bottom">Total</td>
        </tr>
    </thead>
    <tbody>
        <!-- <tr>
            <th class="tx-dark tx-bold">Non Lartas</th>
            <td>
                <input type="hidden" name="detail_fee_lartas[0][lartas_id]" value="0">
            </td>
            <td></td>
            <th></th>
            <th>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="detail_fee_lartas[0][total_price]" id="total_price_lartas_0" readonly class="form-control form-control-sm text-right number-format total_price_lartas" placeholder="0" aria-describedby="helpId">
                </div>
            </th>
        </tr> -->
        <?php $n = 0;
        if (isset($lartas) && $lartas) :
            foreach ($lartas as $lts) : $n++; ?>
                <tr>
                    <th class="tx-dark tx-bold"><?= $lts->name; ?></th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][lartas_id]" readonly class="form-control text-right" value="<?= ($lts->lartas_id); ?>" placeholder="0">
                            <input type="text" name="detail_fee_lartas[<?= $n; ?>][price]" readonly class="form-control text-right price_lartas" id="price_lartas_<?= $n; ?>" value="<?= number_format($lts->fee_value, 2); ?>" placeholder="0">
                        </div>
                    </td>
                    <td>/<?= $typeLartas[$lts->unit]; ?>
                        <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][unit]" value="<?= isset($lts->unit) ? $lts->unit : ''; ?>">
                    </td>
                    <th><input type="text" data-row="<?= $n; ?>" name="detail_fee_lartas[<?= $n; ?>][qty]" class="qty_lartas form-control form-control-sm text-right" placeholder="0" aria-describedby="helpId"></th>
                    <th>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" id="total_price_lartas_<?= $n; ?>" name="detail_fee_lartas[<?= $n; ?>][total_price]" class="form-control form-control-sm text-right number-format total_price_lartas" readonly placeholder="0" aria-describedby="helpId">
                        </div>
                    </th>
                </tr>
            <?php endforeach;
        else : ?>
            <tr>
                <td colspan="5" class="text-center"> ~ Not avalilabe data ~</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th class="border-top tx-dark tx-bold text-center"></th>
            <th colspan="3" class="border-top tx-dark tx-bold text-right">Total Lartas (Rp)</th>
            <th class="border-top tx-dark tx-bold text-right" name="total_fee_lartas" id="total_fee_lartas">0</th>
        </tr>
    </tfoot>
</table>