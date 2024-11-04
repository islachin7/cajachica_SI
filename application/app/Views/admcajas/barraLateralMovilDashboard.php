    <!-- Off-Canvas Mobile Menu-->
    <div class="offcanvas-container" id="mobile-menu" style="background-color: #000000;">
      <a class="account-link" href="#" style="padding: 6px 18px;background-color: #000000;">
        <div class="user-info">
          <h6 class="user-name text-center">Panel de Control</h6>
          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Correo: <?=substr(session('correo'),0,25)?></p>
          <p style="margin-block-end: 0;color: rgba(255,255,255,0.5);">Tipo: <?=session('nombretipo')?></p>
        </div></a>
        <nav class="offcanvas-menu">
           <ul class="menu">
            <li class="has-children"><span><a href="<?= base_url() ?>/dashboard/indexCaja"><i class="fas fa-tachometer-alt"></i>&nbsp;Inicio</a></span></li>
            <li class="has-children"><span><a href="<?=base_url()?>/usuario/actuUsuario?id=<?=session("idUsuario")?>"><i class="fas fa-user"></i>&nbsp;Mi Cuenta</a></span></li>
            <li class="has-children"><span><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-cash-register"></i>&nbsp;Caja Chica</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?= base_url() ?>/cajaChicac"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?=base_url()?>/usuario"><i class="fas fa-users"></i>&nbsp;Usuarios</a><span class="sub-menu-toggle"></span></span>
              <ul class="offcanvas-submenu">
                <li><a href="<?=base_url()?>/usuario"><i class="fas fa-list"></i>&nbsp;Lista</a></li>
                <li><a href="<?=base_url()?>/usuario/nuevoUsuario"><i class="fas fa-user-plus"></i>&nbsp;Nuevo</a></li>
              </ul>
            </li>
            <li class="has-children"><span><a href="<?=base_url()?>/auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Salir</a></span>
            </li>
          </ul>
        </nav>
    </div>
