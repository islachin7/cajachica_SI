	create table tipoUsuario(
		id int primary key auto_increment,
		nombre varchar(100),
		descripcion varchar(200)
		);

	create table usuario(
		id int primary key auto_increment,
		nombre varchar(200),
		apellido varchar(200),
		celular varchar(9),
		correo varchar(300),
		contrasena varchar(256),
		tipousuario int,
		estado int --1 activo / 2 desactivado / 0 eliminado,
		INDEX (tipousuario),
    	FOREIGN KEY (tipousuario) REFERENCES tipoUsuario(id)
		);
		
	create table proyecto(
		id int primary key auto_increment,
		nombre varchar(100),
		usuario int,
		residente int,
		adminproyecto int,
		delete_estado int,
		INDEX (usuario),
    	FOREIGN KEY (usuario) REFERENCES usuario(id)
		);

	create table almacen(
		id int primary key auto_increment,
		nombre varchar(150),
		fechaCreacion date,
		direccion varchar(300),
		proyecto int,
		tipousuario int,
		delete_estado int,
		INDEX(proyecto),
		FOREIGN KEY (proyecto) REFERENCES proyecto(id)
		);
		
	create table categoriaPadre(
		id int primary key auto_increment,
		nombre varchar(100)
		);

	create table categoria_material_equipo(
		id int primary key auto_increment,
		nombre varchar(100),
		categoriapadre int,
		INDEX(categoriapadre),
		FOREIGN KEY (categoriapadre) REFERENCES categoriaPadre(id)
		);
		
	create table material_equipo(
		id int primary key auto_increment,
		codigo varchar(20),
		nombre varchar(100),
		descripcion varchar(200),
		stockMinimo int,
		unidadMedida varchar(100),
		costoReposicion decimal (18,2),
		categoriaMateEqui int,
		estadoactivado int,
		INDEX(categoriaMateEqui),
		FOREIGN KEY (categoriaMateEqui) REFERENCES categoria_material_equipo(id)
		);
		
	create table detalleAlmacen(
		id int primary key auto_increment,
		stockProducto decimal(18,2),
		cantidadinicial decimal(18,2),
		materialEquipo int,
		almacen int,
		usado int,
		INDEX(materialEquipo),
		INDEX(almacen),
		FOREIGN KEY (materialEquipo) REFERENCES material_equipo(id),
		FOREIGN KEY (almacen) REFERENCES almacen(id)
		);
		
	create table tipoTransferencia(
		id int primary key auto_increment,
		nombre varchar(200)
		);
		
	create table transferencia(
		id int primary key auto_increment,
		fecha date,
		estadoTransferencia varchar(200),
		verificador int,
		origen int,
		destino int,
		tipotransferencia int,
		usuario int,
		motivo varchar(300),
		presolicitud int,
		eliminado int,
		solibaja int,
		INDEX(tipotransferencia),
		INDEX(usuario),
		FOREIGN KEY (tipotransferencia) REFERENCES tipoTransferencia(id),
		FOREIGN KEY (usuario) REFERENCES usuario(id)
		);

	create table detalleTransferencia(
		id int primary key auto_increment,
		cantidad decimal(18,2),
		cantidadTransferida decimal(18,2),
		estadoExistencia varchar(200),
		partida varchar(10),
		transferencia int,
		materialEquipo int,
		INDEX(transferencia),
		INDEX(materialEquipo),
		FOREIGN KEY (transferencia) REFERENCES transferencia(id),
		FOREIGN KEY (materialEquipo) REFERENCES material_equipo(id)
		);

	create table observacion(
		id int primary key auto_increment,
		comentario varchar(600),
		fecha datetime,
		transferencia int,
		usuario int,
		delete_estado int,
		INDEX(transferencia),
		INDEX(usuario),
		FOREIGN KEY (transferencia) REFERENCES transferencia(id),
		FOREIGN KEY (usuario) REFERENCES usuario(id)
		);

	create table tipoInventario(
		id int primary key auto_increment,
		nombre varchar(150)
		);

	create table inventario(
		id int primary key auto_increment,
		nombre varchar(200),
		fechaCreacion date,
		tipoinventario int,
		estado varchar(200),
		usuario int,
		almacen int,
		fechaRealizacion date,
		creador int,
		realizador int,
		ajustador int,
		fechaAjuste date,
		INDEX(tipoinventario),
		INDEX(usuario),
		FOREIGN KEY (tipoinventario) REFERENCES tipoInventario(id),
		FOREIGN KEY (usuario) REFERENCES usuario(id)
		);

	create table detalleInventario(
		id int primary key auto_increment,
		cantidad decimal(18,2),
		cantidadFisica decimal(18,2),
		ajuste decimal(18,2),
		inventario int,
		materialEquipo int,
		INDEX(inventario),
		INDEX(materialEquipo),
		FOREIGN KEY (inventario) REFERENCES inventario(id),
		FOREIGN KEY (materialEquipo) REFERENCES material_equipo(id)
		);

	create table proveedor(
		id int primary key auto_increment,
		razon_social varchar(200),
		dniRuc varchar(11),
		direccion varchar(300),
		celular1 varchar(9),
		celular2 varchar(9),
		delete_estado int
		);

	create table compra(
		id int primary key auto_increment,
		fecha date,
		totalNeto decimal(18,2),
		estado varchar(100),
		factura varchar(100),
		proveedor int,
		usuario int,
		transferencia int,
		proyecto int,
		verificador int,
		fechaRevision date,
		caja int,
		INDEX(proveedor),
		INDEX(usuario),
		INDEX(proyecto),
		INDEX(transferencia),
		FOREIGN KEY (proveedor) REFERENCES proveedor(id),
		FOREIGN KEY (transferencia) REFERENCES transferencia(id),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (proyecto) REFERENCES proyecto(id)
		);

	create table detalleCompra(
		id int primary key auto_increment,
		cantidad decimal(18,2),
		cantidadRecibida decimal(18,2),
		precio decimal(18,2),
		compra int,
		partida varchar(10),
		materialEquipo int,
		INDEX(compra),
		INDEX(materialEquipo),
		FOREIGN KEY (compra) REFERENCES compra(id),
		FOREIGN KEY (materialEquipo) REFERENCES material_equipo(id)
		);

	create table previoDetalle(
		id int primary key auto_increment,
		codigo varchar(200),
		material varchar(300),
		usuario int,
		idmaterial int,
		medida varchar(100),
		unique u_codigo(codigo,usuario),
		INDEX(usuario),
		INDEX(idmaterial),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);
		
	create table previoSolicitudBaja(
		id int primary key auto_increment,
		codigo varchar(200),
		material varchar(300),
		usuario int,
		idmaterial int,
		almacen int,
		medida varchar(100),
		unique u_codigo(codigo,usuario),
		INDEX(usuario),
		INDEX(idmaterial),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);
			
	create table previoInventario(
		id int primary key auto_increment,
		codigo varchar(200),
		material varchar(300),
		usuario int,
		idmaterial int,
		medida varchar(100),
		cantidad decimal(18,2),
		almacen int,
		unique u_codigo(codigo,usuario),
		INDEX(usuario),
		INDEX(idmaterial),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);
				
	create table previoDetalleAlmacen(
		id int primary key auto_increment,
		codigo varchar(200),
		material varchar(300),
		usuario int,
		idmaterial int,
		medida varchar(100),
		unique u_codigo(codigo,usuario),
		INDEX(usuario),
		INDEX(idmaterial),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);

	create table previoDetalleCompra(
		id int primary key auto_increment,
		codigo varchar(200),
		material varchar(300),
		precio decimal(18,2),
		usuario int,
		idmaterial int,
		medida varchar(100),
		unique u_codigo(codigo,usuario),
		INDEX(usuario),
		INDEX(idmaterial),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);
	
	create table consumoDiario(
		id int primary key auto_increment,
		fecha date,
		proyecto int,
		usuario int,
		aprobador int,
		partida varchar(500),
		totalcant int,
		INDEX(usuario),
		INDEX(proyecto),
		FOREIGN KEY (usuario) REFERENCES usuario(id),
		FOREIGN KEY (proyecto) REFERENCES proyecto(id)
		);
		
		create table detalleConsumoDiario(
			id int primary key auto_increment,
			idconsumoDiario int,
			idmaterial int,
			cantidadconsumida decimal(18,2),
			INDEX(idconsumoDiario),
			INDEX(idmaterial),
			FOREIGN KEY (idconsumoDiario) REFERENCES consumoDiario(id),
			FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);

		create table previoConsumo(
			id int primary key auto_increment,
			codigo varchar(200),
			material varchar(300),
			cantidad decimal(18,2),
			usuario int,
			idmaterial int,
			medida varchar(100),
			unique u_codigo(codigo,usuario),
			INDEX(usuario),
			INDEX(idmaterial),
			FOREIGN KEY (usuario) REFERENCES usuario(id),
			FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
		);

		create table seguimiento(
			id int primary key auto_increment,
			usuario int,
			accion varchar(600),
			fecha datetime,
			INDEX(usuario),
			FOREIGN KEY (usuario) REFERENCES usuario(id)
			);

		create table cajaChicaC(
          id int primary key auto_increment,
          codigo varchar(100),
          fecha_apertura date,
		  fecha_cierre date,
          asignado int,
          creado int,
          montoTotal decimal(18,5),
          montoCompra decimal(18,5),
		  totalConsumido decimal(18,5),
		  ultsaldo decimal(18,5),
		  cajaUltSaldo int,
		  proyecto int,
		  caja_estado int  /* 0:Abierto  1:Cerrado */
        );

		create table movilidad(
			id int primary key auto_increment,
			fecha date,
			motivo varchar(500),
			origen varchar(200),
			destino varchar(200),
			creador int,
			proyecto int,
			caja int,
			monto decimal(18,2),
			movilidadEdit int,
			comprobante int
		);

		create table refrigerio(
			id int primary key auto_increment,
			fecha date,
			motivo varchar(500),
			creador int,
			proyecto int,
			caja int,
			monto decimal(18,2),
			refrigerioEdit int,
			comprobante int
		);

		-- inicio tablas momentaneas

		create table factura(
			id int primary key auto_increment,
			fecha date,
			totalNeto decimal(18,2),
			estado varchar(100),
			factura varchar(100),
			proveedor int,
			usuario int,
			proyecto int,
			caja int,
			igv int,
			tipoCmpb int,
			facturaEdit int
		);

		create table detalleFactura(
			id int primary key auto_increment,
			cantidad decimal(18,2),
			precio decimal(18,5),
			factura int,
			item varchar(200),
			INDEX(factura),
			FOREIGN KEY (factura) REFERENCES factura(id)
		);

		create table previoDetalleFactura(
			id int primary key auto_increment,
			cantidad decimal(18,2),
			precio decimal(18,5),
			item varchar(200),
			usuario int,
			idFactura int
		);

		create table proveedor_temp(
			id int primary key auto_increment,
			dniRuc varchar(11),
			descripcion varchar(300),
			estado int 
		);

		create table proyecto_temp(
			id int primary key auto_increment,
			descripcion varchar(300),
			estado int
		);

		create table aumentoCaja(
			id int primary key auto_increment,
			monto decimal(18,2),
			fecha date,
			origen int,
			observacion varchar(500),
			caja int
		);

		-- fin tablas momentaneas

		CREATE procedure cabeceraReporte(IN idCaja INT)
		BEGIN
			Select cc.fecha_apertura as fecha,
					'Saldo Inicial' as descrip,
					'' as cmpb,
					'' as prove,
					ROUND(cc.montoTotal,2) as ingreso,
					'' as salida,
					CONCAT('Saldo de fecha ',cc.fecha_apertura) as observacion
			  From cajaChicaC cc
			 Where cc.id = idCaja
			UNION
			Select 	cc.fecha_apertura as fecha,
					'Saldo Anterior' as descrip,
					'' as cmpb,
					'' as prove,
					ROUND(cc.ultsaldo,2) as ingreso,
					'' as salida,
					'Saldo Caja Anterior' as observacion
			  From cajaChicaC cc
			 Where cc.id = idCaja;
		END;

      -------------------------------------------------------------------------

		CREATE procedure cuerpoReporte(IN idCaja INT)
		BEGIN
			Select 	ac.fecha,
					'Aumento' as descrip,
					'' as cmpb,
					'' as prove,
					ROUND(ac.monto,2) as ingreso,
					'' as salida,
					CONCAT(
						(CASE WHEN ac.origen = 1 THEN 'Transferencia'
							WHEN ac.origen = 2 THEN 'Efectivo'
							ELSE 'Cheque'
							END),
						' - ',
						ac.observacion
					) as observacion
			  From aumentoCaja ac
			 Where ac.caja = idCaja
			UNION
			Select 	f.fecha,
					CASE 	WHEN f.tipoCmpb = 1 THEN 'Factura'
					WHEN f.tipoCmpb = 2 THEN 'Boleta de Venta'
					WHEN f.tipoCmpb = 3 THEN 'Recibo por Honorarios'
					ELSE 'Ticket'
					END as descrip,
					f.factura as cmpb,
					UPPER(SUBSTRING(p.descripcion,1,40)) as prove,
					'' as ingreso,
					ROUND(f.totalNeto,2) as salida,
					IFNULL(
						(Select m.motivo 
						From movilidad m
						Where m.comprobante = f.id
							And m.movilidadEdit IS NULL)
						,
						IFNULL(
						(Select r.motivo 
							From refrigerio r
							Where r.comprobante = f.id
							And r.refrigerioEdit IS NULL)
						,'')) as observacion
			 From factura f
		LEFT JOIN proveedor_temp p 	on f.proveedor 	= p.id
			Where f.caja = idCaja
			  AND f.facturaEdit IS NULL
		 ORDER BY fecha;

		END;

      -------------------------------------------------------------------------

		CREATE procedure buscarRefrigerioxCmpb(IN idFact INT)
		BEGIN
			SELECT	r.id
			FROM 	refrigerio r
			WHERE r.comprobante = idFact
			AND r.refrigerioEdit IS NULL;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure buscarMovilidadxCmpb(IN idFact INT)
		BEGIN
			SELECT	m.id
			FROM 	movilidad m
			WHERE m.comprobante = idFact
			AND m.movilidadEdit IS NULL;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure buscarComprobante(IN idCaja INT,IN letra VARCHAR(50))
		BEGIN
			SELECT	f.id,
					UPPER(f.factura) AS factura,
					f.totalNeto,
					UPPER(SUBSTRING(p.descripcion,1,40)) as proveedor
			FROM 	factura f
			LEFT JOIN proveedor_temp p 	on f.proveedor 	= p.id
			LEFT JOIN movilidad m 		on f.id			= m.comprobante And m.movilidadEdit IS NULL
			LEFT JOIN refrigerio r 		on f.id 		= r.comprobante And r.refrigerioEdit IS NULL
			WHERE f.caja = idCaja
			AND f.factura like CONCAT('%',letra,'%')
			AND m.comprobante IS NULL
			AND r.comprobante IS NULL
			AND f.facturaEdit IS NULL 
			ORDER BY f.factura DESC;
		END;

      -------------------------------------------------------------------------

		CREATE procedure buscarComprobante2(IN idCaja INT,IN letra VARCHAR(50),IN idFact INT)
		BEGIN
			SELECT	f.id,
					UPPER(f.factura) AS factura,
					f.totalNeto,
					UPPER(SUBSTRING(p.descripcion,1,40)) as proveedor
			FROM 	factura f
			LEFT JOIN proveedor_temp p 	on f.proveedor 	= p.id
			LEFT JOIN movilidad m 		on f.id			= m.comprobante And m.movilidadEdit IS NULL
			LEFT JOIN refrigerio r 		on f.id 		= r.comprobante And r.refrigerioEdit IS NULL
			WHERE f.caja = idCaja
			AND f.factura like CONCAT('%',letra,'%')
			AND m.comprobante IS NULL
			AND r.comprobante IS NULL
			AND f.facturaEdit IS NULL 
			UNION
			SELECT	f.id,
					UPPER(f.factura) AS factura,
					f.totalNeto,
					UPPER(SUBSTRING(p.descripcion,1,40)) as proveedor
			FROM 	factura f
			LEFT JOIN proveedor_temp p 	on f.proveedor 	= p.id
			WHERE f.id = idFact
			;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure detalleFacturas_porID(IN idCaja INT)
		BEGIN
			SELECT	f.fecha, 
					UPPER(p.descripcion) as proveedor, 
					UPPER(pr.descripcion) as proyecto, 
					f.totalNeto, 
					UPPER(f.factura) AS factura,
					f.igv,
					UPPER(df.item) as item,
					df.cantidad,
					ROUND(df.precio,2) precio,
					df.precio precioIGV,
					ROUND(df.cantidad*df.precio,2) importe
			FROM detalleFactura df 
			INNER JOIN factura f ON df.factura = f.id 
			LEFT JOIN proveedor_temp p on f.proveedor = p.id 
			LEFT JOIN proyecto_temp pr on f.proyecto=pr.id 
			WHERE f.caja = idCaja
			AND f.facturaEdit IS NULL
			ORDER BY f.fecha DESC;
		END;

      -------------------------------------------------------------------------

		CREATE procedure movilidad_porID(IN idMovi INT)
		BEGIN
			SELECT
			m.*,
			f.factura
			FROM movilidad m
			LEFT JOIN factura f ON m.comprobante = f.id
			WHERE m.id = idMovi;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure refrigerio_porID(IN idRefri INT)
		BEGIN
			SELECT
			m.*,
			f.factura
			FROM refrigerio m
			LEFT JOIN factura f ON m.comprobante = f.id
			WHERE m.id = idRefri;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_movilidad_porCaja_sinMoviID(IN idMovi INT,IN idCaja INT)
		BEGIN
			SELECT 	m.id, 
					m.fecha, 
					m.motivo,
					pr.descripcion as proyecto,
					m.origen,
					m.destino,
					concat(u.nombre,' ',u.apellido) as usuario,
					ROUND(m.monto,2) monto
			FROM movilidad m
			LEFT JOIN usuario u on m.creador = u.id
			LEFT JOIN proyecto_temp pr on m.proyecto=pr.id
			WHERE m.caja = idCaja
			AND m.id <> idMovi
			AND m.movilidadEdit IS NULL
			ORDER BY m.id DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_refrigerio_porCaja_sinRefriID(IN idRefri INT,IN idCaja INT)
		BEGIN
			SELECT 	m.id, 
					m.fecha, 
					m.motivo,
					pr.descripcion as proyecto,
					concat(u.nombre,' ',u.apellido) as usuario,
					ROUND(m.monto,2) monto
			FROM refrigerio m
			LEFT JOIN usuario u on m.creador = u.id
			LEFT JOIN proyecto_temp pr on m.proyecto=pr.id
			WHERE m.caja = idCaja
			AND m.id <> idRefri
			AND m.refrigerioEdit IS NULL
			ORDER BY m.id DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure agregar_previoDetalle_editFactura(IN idFac INT,IN idUsuario INT)
		BEGIN

			DELETE FROM previoDetalleFactura
			WHERE usuario = idUsuario
			AND idFactura = idFac;

			INSERT INTO previoDetalleFactura(cantidad,precio,item,usuario,idFactura)
			SELECT 	df.cantidad,
					df.precio,
					df.item,
					idUsuario,
					df.factura
			 FROM detalleFactura df
			WHERE df.factura = idFac;

			SELECT 	*
			FROM previoDetalleFactura pdf
			WHERE pdf.usuario = idUsuario
			AND pdf.idFactura = idFac;

		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_facturas_porCaja_sinFacturaId(IN idFactura INT,IN idCaja INT)
		BEGIN
			SELECT 	f.id, 
					f.fecha, 
					p.descripcion as proveedor, 
					concat(u.nombre,' ',u.apellido) as usuario, 
					pr.descripcion as proyecto, 
					f.totalNeto,
					f.factura,
					cc.codigo
			FROM factura f 
			LEFT JOIN proveedor_temp p on f.proveedor = p.id 
			LEFT JOIN usuario u on f.usuario = u.id 
			LEFT JOIN proyecto_temp pr on f.proyecto=pr.id 
			LEFT JOIN cajaChicaC cc on f.caja=cc.id  
			WHERE f.caja = idCaja
			AND f.facturaEdit IS NULL
			AND f.id <> idFactura
			ORDER BY f.id DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure cabecera_Factura_porID(IN idFactura INT)
		BEGIN
			SELECT
			*
			FROM factura 
			WHERE id = idFactura;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_DetalleFactura_porID(IN idFactura INT)
		BEGIN
			SELECT
			df.item,
			df.cantidad,
			df.precio,
			ROUND((df.precio * df.cantidad),2) montoCompra,
			f.igv
			FROM detalleFactura df
			INNER JOIN factura f ON df.factura = f.id
			WHERE df.factura = idFactura;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_saldo_ultimaCaja(IN idAsignado INT)
		BEGIN
			SELECT
			IFNULL(ROUND(cc.montoTotal-cc.totalConsumido,2),0) saldo,
			cc.id
			FROM cajaChicaC cc
			WHERE cc.fecha_cierre IS NOT NULL
			AND  cc.caja_estado = 1
			AND  cc.asignado = idAsignado
			ORDER BY cc.id DESC,cc.fecha_cierre DESC
			LIMIT 1;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_cajachicaC_total(IN emp INT,IN numreg INT)
		BEGIN
			SELECT
			cc.id,
			cc.codigo,
			DATE_FORMAT(cc.fecha_apertura,'%d/%m/%Y') fecha_apertura,
			CASE WHEN cc.caja_estado = 0 THEN 'Abierta'
				 ELSE 'Cerrada'
				 END estado,
			CONCAT(u1.nombre,' ',u1.apellido) asignado,
			CONCAT(u2.nombre,' ',u2.apellido) creado,
			SUBSTRING(CONCAT(u1.nombre,' ',u1.apellido),1,30) asignado_card,
			ROUND(cc.montoTotal,2) montoTotal,
			ROUND(cc.montoCompra,2) montoCompra
			FROM cajaChicaC cc
			INNER JOIN usuario u1 ON cc.asignado = u1.id
			INNER JOIN usuario u2 ON cc.creado = u2.id
			WHERE cc.fecha_cierre IS NULL
			AND  cc.caja_estado = 0
			ORDER BY cc.caja_estado, cc.id DESC
			LIMIT emp,numreg;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_cajachicaC()
		BEGIN
			SELECT
			cc.id,
			cc.codigo,
			DATE_FORMAT(cc.fecha_apertura,'%d/%m/%Y') fecha_apertura,
			'Abierta' estado,
			CONCAT(u1.nombre,' ',u1.apellido) asignado,
			CONCAT(u2.nombre,' ',u2.apellido) creado,
			SUBSTRING(CONCAT(u1.nombre,' ',u1.apellido),1,30) asignado_card,
			ROUND(cc.montoTotal,2) montoTotal,
			ROUND(cc.montoCompra,2) montoCompra
			FROM cajaChicaC cc
			INNER JOIN usuario u1 ON cc.asignado = u1.id
			INNER JOIN usuario u2 ON cc.creado = u2.id
			WHERE cc.fecha_cierre IS NULL
			AND  cc.caja_estado = 0;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_cajachicaC_porID(IN idCaja INT)
		BEGIN
			SELECT
			cc.id,
			cc.codigo,
			DATE_FORMAT(cc.fecha_apertura,'%d/%m/%Y') fecha_apertura,
			DATE_FORMAT(cc.fecha_cierre,'%d/%m/%Y') fecha_cierre,
			CASE WHEN cc.caja_estado = 0 THEN 'Abierta'
				 ELSE 'Cerrada'
				 END estado,
			cc.caja_estado,
			CONCAT(u1.nombre,' ',u1.apellido) asignado,
			CONCAT(u2.nombre,' ',u2.apellido) creado,
			ROUND(cc.montoTotal,2) montoTotal,
			ROUND(cc.montoCompra,2) montoCompra,
			ROUND(cc.ultsaldo,2) ultsaldo,
			(SELECT cc2.codigo
			   FROM cajaChicaC cc2
			  WHERE	cc2.id = cc.cajaUltSaldo
			  LIMIT 1) cajaUltSaldo,
			cc.proyecto,
			pt.descripcion nombreProyecto
			FROM cajaChicaC cc
			INNER JOIN usuario u1 ON cc.asignado = u1.id
			INNER JOIN usuario u2 ON cc.creado = u2.id
			LEFT JOIN proyecto_temp pt ON cc.proyecto = pt.id
			WHERE cc.id = idCaja;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_cajachicaC_porUsuario(IN idUsuario INT,IN emp INT,IN numreg INT)
		BEGIN
			SELECT
			cc.id,
			cc.codigo,
			DATE_FORMAT(cc.fecha_apertura,'%d/%m/%Y') fecha_apertura,
			DATE_FORMAT(cc.fecha_cierre,'%d/%m/%Y') fecha_cierre,
			CASE WHEN cc.caja_estado = 0 THEN 'Abierta'
				 ELSE 'Cerrada'
				 END estado,
			cc.caja_estado,
			CONCAT(u1.nombre,' ',u1.apellido) asignado,
			CONCAT(u2.nombre,' ',u2.apellido) creado,
			SUBSTRING(CONCAT(u1.nombre,' ',u1.apellido),1,30) asignado_card,
			ROUND(cc.montoTotal,2) montoTotal,
			ROUND(cc.montoCompra,2) montoCompra
			FROM cajaChicaC cc
			INNER JOIN usuario u1 ON cc.asignado = u1.id
			INNER JOIN usuario u2 ON cc.creado = u2.id
			WHERE cc.asignado = idUsuario
			ORDER BY cc.id DESC
			LIMIT emp,numreg;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_cajachicaC_porUsuario_Activas(IN idUsuario INT)
		BEGIN
			SELECT
			cc.id,
			cc.codigo,
			DATE_FORMAT(cc.fecha_apertura,'%d/%m/%Y') fecha_apertura,
			DATE_FORMAT(cc.fecha_cierre,'%d/%m/%Y') fecha_cierre,
			CASE WHEN cc.caja_estado = 0 THEN 'Abierta'
				 ELSE 'Cerrada'
				 END estado,
			cc.caja_estado,
			CONCAT(u1.nombre,' ',u1.apellido) asignado,
			CONCAT(u2.nombre,' ',u2.apellido) creado,
			SUBSTRING(CONCAT(u1.nombre,' ',u1.apellido),1,30) asignado_card,
			ROUND(cc.montoTotal,2) montoTotal,
			ROUND(cc.montoCompra,2) montoCompra
			FROM cajaChicaC cc
			INNER JOIN usuario u1 ON cc.asignado = u1.id
			INNER JOIN usuario u2 ON cc.creado = u2.id
			WHERE cc.asignado = idUsuario
			  AND cc.fecha_cierre IS NULL 
			  AND cc.caja_estado = 0
			ORDER BY fecha_apertura DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_cajachicaC_porUsuario_conteo(IN idUsuario INT)
		BEGIN
			SELECT *
			FROM cajaChicaC cc
			WHERE cc.asignado = idUsuario;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_compras()
		BEGIN
			select 	c.id, 
					c.fecha, 
					p.razon_social as proveedor, 
					concat(u.nombre," ",u.apellido) as usuario, 
					concat(usu.nombre," ",usu.apellido) as veri, 
					pr.nombre as proyecto, 
					c.totalNeto, 
					c.transferencia,
					c.estado,
					c.factura 
			from compra c 
			LEFT JOIN proveedor p on c.proveedor = p.id 
			LEFT JOIN usuario u on c.usuario = u.id 
			LEFT JOIN usuario usu on c.verificador = usu.id 
			LEFT JOIN proyecto pr on c.proyecto=pr.id 
			LEFT JOIN transferencia t on c.transferencia=t.id  
			order by c.id desc;
		END;

      -------------------------------------------------------------------------

		 CREATE procedure listar_compras_porCaja(IN idCaja INT)
		BEGIN
			SELECT 	c.id, 
					c.fecha, 
					p.razon_social as proveedor, 
					concat(u.nombre,' ',u.apellido) as usuario, 
					concat(usu.nombre,' ',usu.apellido) as veri, 
					pr.nombre as proyecto, 
					c.totalNeto, 
					c.transferencia,
					c.estado,
					c.factura 
			FROM compra c 
			LEFT JOIN proveedor p on c.proveedor = p.id 
			LEFT JOIN usuario u on c.usuario = u.id 
			LEFT JOIN usuario usu on c.verificador = usu.id 
			LEFT JOIN proyecto pr on c.proyecto=pr.id 
			LEFT JOIN transferencia t on c.transferencia=t.id  
			WHERE c.caja = idCaja
			  AND c.estado = 'aprobada' 
			ORDER BY c.id DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_facturas_porCaja(IN idCaja INT)
		BEGIN
			SELECT 	f.id, 
					f.fecha, 
					UPPER(p.descripcion) as proveedor, 
					concat(u.nombre,' ',u.apellido) as usuario, 
					UPPER(pr.descripcion) as proyecto, 
					f.totalNeto,
					CASE 	WHEN f.tipoCmpb = 1 THEN 'Factura'
							WHEN f.tipoCmpb = 2 THEN 'Boleta de Venta'
							WHEN f.tipoCmpb = 3 THEN 'Recibo por Honorarios'
							ELSE 'Ticket'
					END as tipoCmpb,
					UPPER(f.factura) AS factura,
					cc.codigo,
					f.igv
			FROM factura f 
			LEFT JOIN proveedor_temp p on f.proveedor = p.id 
			LEFT JOIN usuario u on f.usuario = u.id 
			LEFT JOIN proyecto_temp pr on f.proyecto=pr.id 
			LEFT JOIN cajaChicaC cc on f.caja=cc.id  
			WHERE f.caja = idCaja
			AND f.facturaEdit IS NULL
			ORDER BY f.fecha DESC, f.id DESC ;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_movilidad_porCaja(IN idCaja INT)
		BEGIN
			SELECT 	m.id, 
					m.fecha, 
					UPPER(m.motivo) as motivo,
					UPPER(pr.descripcion) as proyecto,
					UPPER(m.origen) as origen,
					UPPER(m.destino) as destino,
					concat(u.nombre,' ',u.apellido) as usuario,
					ROUND(m.monto,2) monto,
					UPPER(f.factura) comprobante
			FROM movilidad m
			LEFT JOIN usuario u on m.creador = u.id
			LEFT JOIN proyecto_temp pr on m.proyecto=pr.id
			LEFT JOIN factura f on m.comprobante = f.id
			WHERE m.caja = idCaja
			AND m.movilidadEdit IS NULL
			ORDER BY m.fecha DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure listar_refrigerio_porCaja(IN idCaja INT)
		BEGIN
			SELECT 	m.id, 
					m.fecha, 
					UPPER(m.motivo) as motivo,
					UPPER(pr.descripcion) as proyecto,
					concat(u.nombre,' ',u.apellido) as usuario,
					ROUND(m.monto,2) monto,
					UPPER(f.factura) comprobante
			FROM refrigerio m
			LEFT JOIN usuario u on m.creador = u.id
			LEFT JOIN proyecto_temp pr on m.proyecto=pr.id
			LEFT JOIN factura f on m.comprobante = f.id
			WHERE m.caja = idCaja
			AND m.refrigerioEdit IS NULL
			ORDER BY m.fecha DESC;
		END;

      -------------------------------------------------------------------------		

		CREATE procedure existe_previoDetalleCompra(IN codigoP VARCHAR(200), IN usuarioP INT)
		BEGIN
			SELECT *
			FROM previoDetalleCompra
			WHERE codigo = codigoP
			 AND usuario = usuarioP;
		END;

      -------------------------------------------------------------------------

		CREATE procedure listar_usuariosActivos()
        BEGIN
				SELECT 	u.id, 
						u.nombre, 
						u.apellido, 
						u.celular, 
						u.correo, 
						tu.nombre as tipousuario,
						u.estado 
				  FROM 	usuario u 
			INNER JOIN 	tipoUsuario tu on tu.id = u.tipousuario
				 WHERE 	u.estado != 0;
        END;

	-------------------------------------------------------------------------

		CREATE procedure listar_usuarioCorreo(IN p_correo VARCHAR(200))
        BEGIN
				SELECT 	u.id, 
						u.nombre, 
						u.apellido, 
						u.celular, 
						u.correo,
						u.tipousuario as tipo, 
						tu.nombre as tipousuario,
						u.contrasena,
						u.estado 
				  FROM 	usuario u 
			INNER JOIN 	tipoUsuario tu on tu.id = u.tipousuario
				WHERE 	u.estado != 0;
				   AND  u.correo = p_correo;
        END;

    -------------------------------------------------------------------------

		CREATE procedure listar_usuariosFiltro()
        BEGIN
          SELECT DISTINCT u.* 
		    FROM cajaChicaC cc
      INNER JOIN usuario u ON cc.asignado = u.id
           WHERE u.estado != 0;
        END;

      -------------------------------------------------------------------------

		CREATE procedure listar_usuariosAsignar()
        BEGIN
          SELECT * 
		    FROM usuario
           WHERE tipousuario IN (1,8) 
		  	 AND estado != 0;
        END;

      -------------------------------------------------------------------------

		CREATE procedure listar_Aumentos_Caja(IN idCaja INT)
		BEGIN
			SELECT
			a.id,
			DATE_FORMAT(a.fecha,'%d/%m/%Y') fecha,
			CONCAT(
				(CASE WHEN a.origen = 1 THEN 'Transferencia'
					  WHEN a.origen = 2 THEN 'Efectivo'
					  ELSE 'Cheque'
					  END),
				' - '
				a.observacion
			) texto,
			ROUND(a.monto,2) monto
			FROM aumentoCaja a
			WHERE a.caja = idCaja
			ORDER BY a.fecha DESC,a.id DESC;
		END;

      -------------------------------------------------------------------------

	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (1, 'administrador', 'control total');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (2, 'Jefe de Proyecto', 'control Limitado');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (4, 'desactivado', 'desactivado');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (5, 'auditor', 'logistica');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (7, 'prevencionista', 'logistica');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (8, 'residente', 'proyecto');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (9, 'administrador Proyecto', 'proyecto');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (10, 'gerente', 'Gerencia General');
	INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (11, 'Administrado Caja Chica', 'Caja Chica');

      -------------------------------------------------------------------------


	INSERT INTO usuario (id, nombre, apellido, celular, correo, contrasena, tipousuario)
	VALUES (NULL, 'mario', 'lopez', '997958365', 'mlopez@gmail.com', '$2y$10$9AeMX15gBkAwXglycop.VuXvynxWoC1YLNNryhA6cpWuoqipIjdZa', '1');
	INSERT INTO tipoTransferencia (id,nombre) VALUES (NULL, "nueva transferencia");
	INSERT INTO tipoTransferencia (id,nombre) VALUES (NULL, "transferencia interna");
	INSERT INTO tipoTransferencia (id,nombre) VALUES (NULL, "devolución a almacén");
