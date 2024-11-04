
        <!-- Off-Canvas Category Menu   BARRA LATERAL-->
    <div class="offcanvas-container" id="shop-categories">
      <div class="offcanvas-header py-2">
        <h3 class="offcanvas-title text-white text-center" style="font-size: 20px;">Panel de Control</h3>
        <p class="offcanvas-title" style="font-size: 14px;">Usuario: <?=session('nombre')?></p>
        <p class="offcanvas-title" style="font-size: 14px;">Correo: <?=session('correo')?></p>
      </div>
      <nav class="offcanvas-menu">
         <ul class="menu">
          <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/index2"><i class="fas fa-tachometer-alt"></i>&nbsp;Inicio</a></span></li>

          <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/transferencia2"><i class="fas fa-align-justify"></i>&nbsp;Mis Solicitudes de Transferencias</a><span class="sub-menu-toggle"></span></span>
            <ul class="offcanvas-submenu">
              <li><a href="<?= base_url() ?>/dashboard/transferencia2"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              <li><a href="<?= base_url() ?>/dashboard/nuevaTranferencia"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
            </ul>
          </li>
          <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/transferenciasAceptadas2"><i class="fas fa-exchange-alt"></i>&nbsp;Mis Transferencias</a><span class="sub-menu-toggle"></span></span>
            <ul class="offcanvas-submenu">
              <li><a href="<?= base_url() ?>/dashboard/transferenciasAceptadas2"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
            </ul>
          </li>
          <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/proyectos2"><i class="fas fa-chart-line"></i>&nbsp;Mis Proyectos</a><span class="sub-menu-toggle"></span></span>
            <ul class="offcanvas-submenu">
              <li><a href="<?= base_url() ?>/dashboard/proyectos2"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
            </ul>
          </li>
          <li class="has-children"><span><a href="<?=base_url()?>/auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Salir</a></span>
          </li>
        </ul>
      </nav>
    </div>
