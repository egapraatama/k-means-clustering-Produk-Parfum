            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white mt-5 border-top pt-4 pb-4 w-100">
            <div class="container my-auto">
                <div class="copyright text-center my-auto small text-muted fw-bold">
                    <span>Copyright &copy; R2DH Parfum <?= date('Y'); ?> | Berbasis Web</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded bg-primary text-white text-center text-decoration-none shadow" href="#page-top" style="position: fixed; right: 1rem; bottom: 1rem; width: 2.75rem; height: 2.75rem; line-height: 2.75rem; display: none;">
    <i class="fas fa-angle-up"></i>
</a>

<!-- jQuery (Local - Wajib untuk Modal Ubah script.js Anda) -->
<script src="<?= BASEURL; ?>/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap 5 Bundle (Local) -->
<script src="<?= BASEURL; ?>/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle & Scroll to Top Script (Vanilla JS Khusus Bootstrap 5) -->
<script src="<?= BASEURL; ?>/js/sb-admin.js"></script>

<!-- DataTables JS (Local) -->
<script src="<?= BASEURL; ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASEURL; ?>/vendor/datatables/dataTables.bootstrap5.min.js"></script>


<script>
    const BASEURL = '<?= BASEURL; ?>';
</script>
 <!-- Anti Back-Forward Cache (BFCache) Javascript -->
<script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
 


 
<!-- Custom Request JS -->
<script src="<?= BASEURL; ?>/js/script.js"></script>

</body>
</html>