        <!-- Off-Canvas Category Menu   BARRA LATERAL-->
    <div class="offcanvas-container" id="shop-categories">
      <div class="offcanvas-header py-2">
        <h3 class="offcanvas-title text-white text-center" style="font-size: 20px;">Panel de Control</h3>
        <p class="offcanvas-title" style="font-size: 14px;">Usuario: <?=session('correo')?></p>
        <p class="offcanvas-title" style="font-size: 14px;">Tipo: <?=session('nombretipo')?></p>
      </div>
      <nav class="offcanvas-menu">
        <ul class="menu">
          <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/indexGerencia"><i class="fas fa-tachometer-alt"></i>&nbsp;INICIO</a></span></li>
          <li class="has-children"><span><a href="<?=base_url()?>/usuario/actuUsuario?id=<?=session("idUsuario")?>"><i class="fas fa-user"></i>&nbsp;Mi Cuenta</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/seguimientoc"><i class="fas fa-search"></i>&nbsp;SEGUIMIENTO</a></span></li>
<!--
          <li class="has-children"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/presolicitudesGerencia"><i class="fas fa-edit"></i>&nbsp;PRE-SOLICITUDES DE TRANSFERENCIA</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/index3"><i class="fas fa-align-justify"></i>&nbsp;SOLICITUDES DE TRANSFERENCIA</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/transferenciasAceptadas"><i class="fas fa-exchange-alt"></i>&nbsp;TRANSFERENCIAS ACEPTADAS</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/transferenciasrechazadas"><i class="fas fa-ban"></i>&nbsp;TRANSFERENCIAS RECHAZADAS</a></span></li>
-->
          <li class="has-children"><span><a href="<?= base_url() ?>/usuario"><i class="fas fa-users"></i>&nbsp;USUARIOS</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-cash-register"></i>&nbsp;Caja Chica</a><span class="sub-menu-toggle"></span></span>
             <ul class="offcanvas-submenu">
               <li><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
             </ul>
           </li>
<!--
          <li class="has-children"><span><a href="<?= base_url() ?>/material"><i class="fas fa-tools"></i>&nbsp;MATERIALES</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/almacenc"><i class="fas fa-warehouse"></i>&nbsp;ALMACENES</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/proveedorc"><i class="far fa-address-book"></i>&nbsp;PROVEEDORES</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/proyectoc"><i class="fas fa-chart-line"></i>&nbsp;PROYECTOS</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/ordenComprac"><i class="fas fa-shopping-cart"></i>&nbsp;COMPRAS</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/material/solicitudesBaja"><i class="fas fa-trash-alt"></i>&nbsp;SOLICITUDES DE BAJA</a></span></li>
          <li class="has-children"><span><a href="<?= base_url() ?>/inventarioc"><i class="fas fa-calendar-alt"></i>&nbsp;INVENTARIOS</a></span></li>
-->
          <li class="has-children"><span><a href="<?=base_url()?>/auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;SALIR</a></span></li>
        </ul>
      </nav>
    </div>
