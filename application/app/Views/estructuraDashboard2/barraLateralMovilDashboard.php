
    <!-- Off-Canvas Mobile Menu-->
    <div class="offcanvas-container" id="mobile-menu"><a class="account-link" href="#" style="padding: 6px 18px;">

        <div class="user-info">
          <h6 class="user-name text-center">Panel de Control</h6>

          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Usuario: <?=session('nombre')?></p>
          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Correo: <?=session('correo')?></p>

        </div></a>
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
