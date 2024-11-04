        <!-- Off-Canvas Category Menu   BARRA LATERAL-->
    <div class="offcanvas-container" id="shop-categories" style="background-color: #000000;">
      <div class="offcanvas-header py-2">
        <h3 class="offcanvas-title text-white text-center" style="font-size: 20px;">Panel de Control</h3>
        <p class="offcanvas-title" style="font-size: 14px;">Correo: <?=substr(session('correo'),0,25)?></p>
        <p class="offcanvas-title" style="font-size: 14px;">Tipo: <?=session('nombretipo')?></p>
      </div>
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
