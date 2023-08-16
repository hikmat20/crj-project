<table class="table table-sm table-borderless">
    <thead class="tx-dark tx-bold">
        <tr>
            <td class="border-bottom">Lartas Type</td>
            <td class="text-right border-bottom">Price</td>
            <td class="text-center border-bottom" width="">Unit</td>
            <td class="text-center border-bottom" width="200">Qty</td>
            <td class="text-right border-bottom">Total</td>
        </tr>
    </thead>
    <tbody>
        <?php $n = 0;
        if (isset($lartas) && $lartas) foreach ($lartas as $lts) : $n++; ?>
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
                <td>/<?= $typeLartas[$lts->unit]; ?></td>
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
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="border-top tx-dark tx-bold text-center"></th>
            <th class="border-top tx-dark tx-bold text-center">Total Lartas (Rp)</th>
            <th class="border-top tx-dark tx-bold text-right" name="total_fee_lartas" id="total_fee_lartas">0</th>
        </tr>
    </tfoot>
</table>