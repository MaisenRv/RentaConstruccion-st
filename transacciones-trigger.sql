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


-------------------------------------------------------------------------------------------
-- Filtra las categorias que tiene un proveedor con respecto a sus productos
CREATE PROC S_Categoria
	@CodigoUsuario INT
AS
BEGIN
	BEGIN TRY
		IF NOT EXISTS(SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario)
		BEGIN
			RAISERROR('El usuario no existe',10,1);
		END
		IF NOT EXISTS (SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario AND CodigoRol = 10) --10 ROL PROVEEDOR
		BEGIN
			RAISERROR('El usuario debe tener el rol de proveedor',10,1);
		END

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
		IF NOT EXISTS(SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario)
			BEGIN
				RAISERROR('El usuario no existe',10,1);
			END
		IF NOT EXISTS (SELECT * FROM Usuario WHERE CodigoUsuario = @CodigoUsuario AND CodigoRol = 10) --10 ROL PROVEEDOR
		BEGIN
			RAISERROR('El usuario debe tener el rol de proveedor',10,1);
		END
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
			DECLARE @CodigoNuevoProducto INT;
			IF NOT EXISTS (SELECT 1 FROM Marca WHERE CodigoMarca = @CodigoMarca)
			   OR NOT EXISTS(SELECT 1 FROM Categoria WHERE IdCategoria = @IdCategoria)
			BEGIN
				RAISERROR('La marca o la catagoria del producto no existen',16,1);
			END

			INSERT INTO Producto(NombreProducto,EstadoProducto,PrecioDeRenta,CodigoMarca,IdCategoria,urlImg)
			VALUES (@NombreProducto,@EstadoProducto,@PrecionRenta,@CodigoMarca,@IdCategoria,@urlImg);
			SET @CodigoNuevoProducto = SCOPE_IDENTITY();
			IF @@ROWCOUNT = 0
			BEGIN
				RAISERROR('Hubo un error al crear el producto',16,1);
			END

			
			IF NOT EXISTS (SELECT 1 FROM Usuario WHERE CodigoUsuario = @CodigoProveedor AND CodigoRol = 10) -- 10 Proveedor
			BEGIN
				RAISERROR('El usuario no existe o tiene que ser un proveedor para poder crear un producto',10,1);
			END

			INSERT INTO Stock(CodigoProveedor,CodigoProducto,Fecha,TipoMovimiento,CantidadMovimiento,CantidadAcumulada,Estado) 
			VALUES(@CodigoProveedor,@CodigoNuevoProducto,GETDATE(),'Entrada',@CantidadProducto,@CantidadProducto,@EstadoProducto);

			IF @@ROWCOUNT = 0
			BEGIN
				RAISERROR('Hubo un error al insertar el produco en el stock',16,1);
			END
			COMMIT;

	END TRY
	BEGIN CATCH
		ROLLBACK;
		PRINT ERROR_MESSAGE();
	END CATCH
END