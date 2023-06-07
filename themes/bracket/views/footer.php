<!-- </div> -->
<!-- br-pagebody -->


<div class="pos-fixed b-0 bg-white float-right r-0">
    <footer class="br-footer px-3 py-2">
        <div class="footer-left">
            <strong>Copyright &copy; <?= date('Y') ; ?> <a
                    href="<?= site_url(); ?>"><?= isset($idt->nm_perusahaan) ? $idt->nm_perusahaan : 'not-set'; ?></a>.</strong>
            All rights reserved | &nbsp;
        </div>
        <div class="footer-right">
            <?= date('l, m F Y') ; ?>&nbsp;|<strong>&nbsp; {elapsed_time}</strong>&nbsp;s
        </div>
    </footer>
</div>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script src="<?= base_url(); ?>themes/bracket/assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/peity/jquery.peity.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/highlightjs/highlight.pack.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js">
</script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js">
</script>
<script src="<?= base_url(); ?>themes/bracket/assets/lib/select2/js/select2.min.js"></script>
<script src="<?= base_url(); ?>themes/bracket/assets/js/bracket.js"></script>
</body>

</html>