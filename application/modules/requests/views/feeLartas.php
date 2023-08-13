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
        <tr>
            <th class="tx-dark tx-bold">Non Lartas</th>
            <td></td>
            <td></td>
            <th></th>
            <th>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="fee_lartas" id="total_price_lartas_0" readonly class="form-control form-control-sm text-right number-format total_price_lartas" placeholder="0" aria-describedby="helpId">
                </div>
            </th>
        </tr>
        <?php $n = 0;
        if (isset($lartas) && $lartas) foreach ($lartas as $lts) : $n++; ?>
        <tr>
            <th class="tx-dark tx-bold"><?= $lts->name; ?></th>
            <td>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" readonly class="form-control text-right price_lartas" id="price_lartas_<?= $n; ?>" value="<?= number_format($lts->fee_value, 2); ?>" placeholder="0">
                </div>
            </td>
            <td>/<?= $typeLartas[$lts->type]; ?></td>
            <th>
                <input type="text" name="qty_lartas" data-row="<?= $n; ?>" class="qty_lartas form-control form-control-sm text-right" placeholder="0" aria-describedby="helpId">
            </th>
            <th>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" name="total_price_lartas" id="total_price_lartas_<?= $n; ?>" class="form-control form-control-sm text-right number-format total_price_lartas" readonly placeholder="0" aria-describedby="helpId">
                </div>
            </th>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="border-top tx-dark tx-bold text-center"></th>
            <th class="border-top tx-dark tx-bold text-center">Total Lartas (Rp)</th>
            <th class="border-top tx-dark tx-bold text-right" id="total_fee_lartas">0</th>
        </tr>
    </tfoot>
</table>