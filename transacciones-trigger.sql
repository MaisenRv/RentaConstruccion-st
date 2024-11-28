-- crea un nuevo usuario
CREATE PROC I_usuario
	@contraseña VARCHAR(100),
	@RazonSocial VARCHAR(100),
    @CodigoLocalidad INT,
    @Direccion VARCHAR(255),
    @Correo VARCHAR(100),
    @Telefono VARCHAR(15),
    @CodigoRol INT
AS
BEGIN
BEGIN TRY
	BEGIN TRANSACTION
		DECLARE @isLocalidad BIT;
		DECLARE @isRol BIT;
		SET @isLocalidad = CASE
					WHEN EXISTS(SELECT 1 FROM Localidad WHERE CodigoLocalidad = @CodigoLocalidad)
					THEN 1 -- Verdadero
					ELSE 0 -- Falso
				END;

		IF(@isLocalidad = 0)
		BEGIN
			RAISERROR('La localidad no existe' ,2,1);
		END

		SET @isRol = CASE
					WHEN EXISTS(SELECT 1 FROM Rol WHERE CodigoRol = @CodigoRol)
					THEN 1
					ELSE 0
				END;
		
		IF(@isRol = 0)
		BEGIN
			RAISERROR('El rol no existe' ,2,1);
		END


		IF NOT EXISTS(SELECT * FROM Usuario WHERE Correo = @Correo)
		BEGIN
			INSERT INTO Usuario(Contraseña,RazonSocial,CodigoLocalidad,Direccion,Correo,Telefono,CodigoRol)
			VALUES (@contraseña,@RazonSocial,@CodigoLocalidad,@Direccion,@Correo,@Telefono,@CodigoRol);

			IF @@ROWCOUNT = 1
			BEGIN
				COMMIT
			END
			ELSE
			BEGIN
				RAISERROR('Error al crear nuevo usuario',2,1);
			END
		END
		ELSE
		BEGIN
			RAISERROR('Correo ya existe',2,1);
		END
END TRY
BEGIN CATCH
	ROLLBACK;
	PRINT ERROR_MESSAGE();
END CATCH
END

--Se ejecuta depues de crear un usuario
CREATE TRIGGER TR_usuario
ON Usuario
AFTER INSERT
AS
BEGIN
	DECLARE @RazonSocial VARCHAR(100);
	SELECT @RazonSocial = RazonSocial FROM inserted;
	PRINT 'El usuario ' + @RazonSocial + 'se ha creado exitosamente';
END



------------------------- FUNCIONES AUXILIARES -------------------------

--Verfica si el usuario existe
CREATE PROC sp_verificar_usuario
	@CodigoUsuario INT
AS
BEGIN
	IF NOT EXISTS(SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario)
	BEGIN
		RAISERROR('El usuario no existe',10,1);
	END
END

--Verfica si el usuario es del tipo Proveedor
CREATE PROC sp_verificar_proveedor
	@CodigoUsuario INT
AS
BEGIN
	IF NOT EXISTS (SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario AND CodigoRol = 10) --10 ROL PROVEEDOR
	BEGIN
		RAISERROR('El usuario debe tener el rol de proveedor',10,1);
	END
END



-------------------------------------------------------------------------------------------
-- Filtra las categorias que tiene un proveedor con respecto a sus productos
CREATE PROC S_Categoria
	@CodigoUsuario INT
AS
BEGIN
	BEGIN TRY
		EXEC sp_verificar_usuario @CodigoUsuario;
		EXEC sp_verificar_proveedor @CodigoUsuario;

		SELECT c.IdCategoria,c.Categoria FROM Categoria c
		INNER JOIN Producto p ON p.IdCategoria = c.IdCategoria
		INNER JOIN Stock s ON s.CodigoProducto = p.CodigoProducto
		INNER JOIN Usuario u ON u.CodigoUsuario = s.CodigoProveedor
		WHERE CodigoUsuario = @CodigoUsuario 
		GROUP BY c.IdCategoria, c.Categoria;

	END TRY
	BEGIN CATCH
		PRINT ERROR_MESSAGE();
	END CATCH
	
END

-- Filtra los los productos dependiendo si es un proveedor o un usuario normal

CREATE PROC S_Productos
	@CodigoUsuario INT
AS
BEGIN
	BEGIN TRY
		EXEC sp_verificar_usuario @CodigoUsuario;
		EXEC sp_verificar_proveedor @CodigoUsuario;

		SELECT DISTINCT p.CodigoProducto, p.NombreProducto, p.EstadoProducto,p.PrecioDeRenta,p.CodigoMarca,p.IdCategoria,p.urlImg,m.NombreMarca
		FROM Producto p
		INNER JOIN Stock s ON s.CodigoProducto = p.CodigoProducto
		INNER JOIN Usuario u ON u.CodigoUsuario = s.CodigoProveedor
		INNER JOIN Marca m ON m.CodigoMarca = p.CodigoMarca
		WHERE u.CodigoUsuario = @CodigoUsuario;
	END TRY
	BEGIN CATCH
		PRINT ERROR_MESSAGE();
	END CATCH
END

---------------------------------------------------------------
-- Crea un producto incluyendo el producto en el stock

CREATE PROC I_Producto
	@CodigoProveedor INT,
	@NombreProducto VARCHAR(100),
	@EstadoProducto VARCHAR(50),
	@PrecionRenta DECIMAL(10,2),
	@CodigoMarca INT,
	@IdCategoria INT,
	@urlImg VARCHAR(2000),
	@CantidadProducto INT
AS
BEGIN
	BEGIN TRY
		BEGIN TRANSACTION
			EXEC sp_verificar_usuario @CodigoProveedor;
			EXEC sp_verificar_proveedor @CodigoProveedor; 

			DECLARE @CodigoNuevoProducto INT;
			IF NOT EXISTS (SELECT 1 FROM Marca WHERE CodigoMarca = @CodigoMarca)
			   OR NOT EXISTS(SELECT 1 FROM Categoria WHERE IdCategoria = @IdCategoria)
			BEGIN
				RAISERROR('La marca o la catagoria del producto no existen',2,1);
			END
			INSERT INTO Producto(NombreProducto,EstadoProducto,PrecioDeRenta,CodigoMarca,IdCategoria,urlImg)
			VALUES (@NombreProducto,@EstadoProducto,@PrecionRenta,@CodigoMarca,@IdCategoria,@urlImg);
			SET @CodigoNuevoProducto = SCOPE_IDENTITY();

			IF @@ROWCOUNT = 0
			BEGIN
				RAISERROR('Hubo un error al crear el producto',2,1);
			END

			INSERT INTO Stock(CodigoProveedor,CodigoProducto,Fecha,TipoMovimiento,CantidadMovimiento,CantidadAcumulada,Estado) 
			VALUES(@CodigoProveedor,@CodigoNuevoProducto,GETDATE(),'Entrada',@CantidadProducto,@CantidadProducto,@EstadoProducto);

			IF @@ROWCOUNT = 0
			BEGIN
				RAISERROR('Hubo un error al insertar el produco en el stock',2,1);
			END
			COMMIT;

	END TRY
	BEGIN CATCH
		ROLLBACK;
		PRINT ERROR_MESSAGE();
	END CATCH
END

--------------------------------------------------------------
-- cconsulta el stock de un proveedor
CREATE PROC S_Stock
	@CodigoProveedor INT
AS
BEGIN
	BEGIN TRY
		EXEC sp_verificar_usuario @CodigoProveedor;
		EXEC sp_verificar_proveedor @CodigoProveedor;

		SELECT p.NombreProducto,s.Fecha,s.TipoMovimiento,s.CantidadMovimiento,s.CantidadAcumulada,s.Estado 
		FROM Stock s
		INNER JOIN Producto p 
		ON p.CodigoProducto = s.CodigoProducto
		WHERE CodigoProveedor = @CodigoProveedor
		ORDER BY Fecha DESC;
	END TRY
	BEGIN CATCH
		PRINT ERROR_MESSAGE();
	END CATCH
END


--//////////////////////////////////////////////////////////////////////////////////////////////
-----------------------------------EJEMPLO DE USO--------------------------------------------------
DECLARE @Productos listaProductos;
INSERT INTO @Productos (CodigoProducto, Cantidad)
VALUES (42,1),(45, 1), (46, 1);

DECLARE @CodigoCLiente INT = 31;

EXEC I_Pedido @Productos,@CodigoCLiente;
----------------------------------------

-- TIPO DE DATO COMO TABLA PARA LISTAS DE PRODUCTOS ----
CREATE TYPE listaProductos AS TABLE(
	CodigoProducto INT,
	Cantidad INT
)
-- Liasta de ids
CREATE TYPE listaIDs AS TABLE(
	id INT
)

-- ACTUALIZAR EL STOCK DEPENDIDO SI EXISTE PRODUCTOS SIFICIENTES
CREATE PROC sp_insertar_movimiento_producto_stock
	@CodigoProveedor INT,
	@CodigoProducto INT,
	@Cantidad INT
AS
BEGIN
	IF NOT EXISTS (SELECT * FROM Stock WHERE CodigoProducto = @CodigoProducto)
	BEGIN
		RAISERROR('EL producto no existe',16,1);
	END

	IF ((SELECT TOP 1 CantidadAcumulada FROM Stock WHERE CodigoProducto = @CodigoProducto ORDER BY Fecha DESC) < @Cantidad)
	BEGIN
		RAISERROR('Nos existe la cantidad suficiente en stock',16,1);
	END

	DECLARE @CantidadAcumulada INT = (SELECT TOP 1 CantidadAcumulada FROM Stock WHERE CodigoProducto = @CodigoProducto ORDER BY Fecha DESC) - @Cantidad;
	DECLARE @NuesvoEstado VARCHAR(50) =
		CASE
			WHEN @CantidadAcumulada = 0 THEN 'AGOTADO'
			ELSE 'Disponible'
		END


	INSERT INTO Stock(CodigoProveedor,CodigoProducto,Fecha,TipoMovimiento,CantidadMovimiento,CantidadAcumulada,Estado) 
	VALUES(
		@CodigoProveedor,
		@CodigoProducto,
		GETDATE(),
		'Salida',
		@Cantidad,
		@CantidadAcumulada,
		@NuesvoEstado
	)
END



-- CREA EL PEDIDO
CREATE PROC I_Pedido
	@Productos listaProductos READONLY,
	@CodigoCliente INT
AS
BEGIN
	BEGIN TRY
		BEGIN TRANSACTION
		EXEC sp_verificar_usuario @CodigoCliente;

		DECLARE @listaProveedores listaIDs;

		INSERT INTO @listaProveedores 
		SELECT CodigoProveedor FROM Stock s 
		INNER JOIN @Productos p ON p.CodigoProducto = s.CodigoProducto 
		GROUP BY CodigoProveedor;

		---- iterando lista de proveedores
		DECLARE @id INT;

		DECLARE listaProvee CURSOR FOR 
		SELECT id FROM @listaProveedores;

		OPEN listaProvee;
		FETCH NEXT FROM listaProvee INTO @id;

		WHILE @@FETCH_STATUS = 0
		BEGIN
			EXEC sp_verificar_proveedor @id;

			---CREANDO LOS PEDIDOS PARA CADA PROVEEDOR
			INSERT INTO Pedido(CodigoCliente,CodigoProveedor) VALUES(@CodigoCliente,@id);
			DECLARE @CodigoNuevoPedido INT = SCOPE_IDENTITY();

			DECLARE @listaIdProducto listaIDs;
			INSERT INTO @listaIdProducto
			SELECT p.CodigoProducto FROM @Productos p
			INNER JOIN Stock s ON s.CodigoProducto = p.CodigoProducto
			WHERE CodigoProveedor = @id GROUP BY  p.CodigoProducto;

			--ITERANDO LOS PRODUCTOS DE CADA PORVEEDOR
			DECLARE @idProducto INT;

			DECLARE CursosProductos CURSOR FOR
			SELECT id FROM @listaIdProducto;

			OPEN CursosProductos;
			FETCH NEXT FROM CursosProductos INTO @idProducto;

			WHILE @@FETCH_STATUS = 0 
			BEGIN
				---  CREAR LOS DETALLES DE CADA PEDIDO
				DECLARE @cantidaDeProductos INT = (SELECT Cantidad FROM @Productos WHERE CodigoProducto = @idProducto);
				EXEC sp_insertar_movimiento_producto_stock @id,@idProducto,@cantidaDeProductos;

				INSERT INTO DetallePedido(CodigoPedido,CodigoProducto,Cantidad)
				VALUES(@CodigoNuevoPedido,@idProducto,@cantidaDeProductos);

				
				FETCH NEXT FROM CursosProductos INTO @idProducto;
			END

			DELETE @listaIdProducto;

			CLOSE CursosProductos;
			DEALLOCATE CursosProductos;

			FETCH NEXT FROM listaProvee INTO @id;	

		END
		CLOSE listaProvee;
		DEALLOCATE listaProvee;
		COMMIT;
	END TRY
	BEGIN CATCH
		ROLLBACK;
		PRINT ERROR_MESSAGE();
	END CATCH
END


-- Trigger de historial pedido
CREATE TRIGGER TR_pedio_historial
ON Pedido
AFTER INSERT
AS
BEGIN
	DECLARE @CodigoPedido INT;

	SELECT @CodigoPedido = CodigoPedido FROM inserted;

	INSERT INTO HistorialPedido(CodigoPedido,FechaInicio,FechaFin,Estado,Observaciones)
	VALUES(@CodigoPedido,GETDATE(),GETDATE(),'En proceso','Sin observacion');

END
