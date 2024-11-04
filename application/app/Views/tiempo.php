  <?php
 echo view("estructuraDashboard/cabecera");
?>

  <?php
 echo view("estructuraDashboard/navbar");
?>

<br><br><br><br><br><br>
<div class="text-center">
<h1>DESACTIVADO</h1>
<br><br>
<a class="btn btn-primary" href="<?=base_url()?>/auth/logout">Salir</a>
</div>

</div>
<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>
<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script src="<?= base_url() ?>/plantilla/js/vendor.min.js"></script>
<script src="<?= base_url() ?>/plantilla/js/scripts.min.js"></script>
<!-- Customizer scripts-->
<script src="<?= base_url() ?>/plantilla/customizer/customizer.min.js"></script>
</body>

</html>
