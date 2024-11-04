    <!-- Off-Canvas Mobile Menu-->
    <div class="offcanvas-container" id="mobile-menu" style="background-color: #000000;">
      <a class="account-link" href="#" style="padding: 6px 18px; background-color: #000000;">
        <div class="user-info">
          <h6 class="user-name text-center">Panel de Control</h6>
          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Correo: <?=substr(session('correo'),0,25)?></p>
          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Tipo: <?=session('nombretipo')?></p>
        </div></a>
        <nav class="offcanvas-menu">
          <ul class="menu">
            <li class="has-children"><span><a href="<?= base_url() ?>/dashboard"><i class="fas fa-tachometer-alt"></i>&nbsp;Inicio</a></span></li>
            <li class="has-children"><span><a href="<?=base_url()?>/usuario/actuUsuario?id=<?=session("idUsuario")?>"><i class="fas fa-user"></i>&nbsp;Mi Cuenta</a></span></li>
            <li class="has-children"><span><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-cash-register"></i>&nbsp;Caja Chica</a><span class="sub-menu-toggle"></span></span>
             <ul class="offcanvas-submenu">
               <li><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
             </ul>
           </li>

<!--
            <li class="has-children"><span><a href="<?=base_url()?>/usuario"><i class="fas fa-users"></i>&nbsp;Usuarios</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?=base_url()?>/usuario"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?=base_url()?>/usuario/nuevoUsuario"><i class="fas fa-user-plus"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>

            <li class="has-children"><span><a href="<?=base_url()?>/material"><i class="fas fa-tools"></i>&nbsp;Materiales</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?=base_url()?>/material"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?=base_url()?>/material/nuevoMaterial"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children h6"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/presolicitudes"><i class="fas fa-edit"></i>&nbsp;Lista de Pre-Solicitudes de Transferencias</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/solicitudesTransferenciac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?= base_url() ?>/solicitudesTransferenciac/nuevaTranferencia"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children h6"><span><a href="<?= base_url() ?>/solicitudesTransferenciac"><i class="fas fa-align-justify"></i>&nbsp;Solicitudes de Transferencias</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/solicitudesTransferenciac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/solicitudesTransferenciac/transferenciasAceptadas"><i class="fas fa-exchange-alt"></i>&nbsp;Transferencias</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/solicitudesTransferenciac/transferenciasAceptadas"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/almacenc"><i class="fas fa-warehouse"></i>&nbsp;Almacenes</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/almacenc"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="/almacenc/nuevoAlmacen"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/proveedorc"><i class="far fa-address-book"></i>&nbsp;Proveedores</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/proveedorc"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?= base_url() ?>/proveedorc/nuevoProveedor"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/proyectoc"><i class="fas fa-chart-line"></i>&nbsp;Proyectos</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/proyectoc"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/ordenComprac"><i class="fas fa-shopping-cart"></i></i>&nbsp;Ordenes de Compra</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/ordenComprac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?= base_url() ?>/ordenComprac/nuevacompra"><i class="fas fa-plus-circle"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?= base_url() ?>/material/solicitudesBaja"><i class="fas fa-trash-alt"></i>&nbsp;Solicitudes de Baja</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/material/solicitudesBaja"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              </ul>
            </li>
-->

            <li class="has-children"><span><a href="<?=base_url()?>/auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Salir</a></span>
            </li>
          </ul>
        </nav>
    </div>
