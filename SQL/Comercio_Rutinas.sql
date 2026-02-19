DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `CalcularValorStock`(id_prod INT) RETURNS float
    DETERMINISTIC
BEGIN
    DECLARE valor_total FLOAT;
    SELECT (PRECIO * STOCK) INTO valor_total 
    FROM producto 
    WHERE idPRODUCTO = id_prod;
    RETURN valor_total;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `TOTALALMACEN`() RETURNS int(11)
BEGIN
DECLARE total INT;
select sum(VALOR) into total from
valoralmacen;
RETURN total;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `cuantos`(procedencia varchar(45)) RETURNS int(11)
BEGIN
	DECLARE n, numero INT;
    SELECT count(*) INTO numero FROM producto WHERE PAIS=procedencia;
    RETURN numero;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `nacionalidad`(procedencia varchar(45)) RETURNS int(11)
BEGIN
	DECLARE n, numero INT;
    SELECT count(*) INTO numero FROM proveedor WHERE NACIONALIDAD=procedencia;
    RETURN numero;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `valorproductospais`(`PROCEDENCIA` VARCHAR(30)) RETURNS int(11)
BEGIN
	DECLARE numero INT;
    SELECT SUM(precio*stock) INTO numero FROM producto GROUP BY pais HAVING pais = procedencia;
    RETURN numero;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPrecioProveedor`(IN prov_id INT, IN porcentaje FLOAT)
BEGIN
    UPDATE producto 
    SET PRECIO = PRECIO + (PRECIO * porcentaje / 100)
    WHERE idPROVEEDOR = prov_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Servidospor`(proveedor int(11))
BEGIN
	SELECT NOMBRE_PRODUCTO, DESCRIPCION, idPROVEEDOR FROM producto WHERE idPROVEEDOR=proveedor;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ofertaxpais`(IN `procedencia` VARCHAR(45), IN `dto` INT)
BEGIN
	SELECT NOMBRE_PRODUCTO AS PRODUCTO, PRECIO AS PRECIO, precio-(precio*dto/100) AS OFERTA, PAIS FROM producto WHERE PAIS=procedencia;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stockmenorque`(IN `cantidad` INT(11))
BEGIN
	SELECT NOMBRE_PRODUCTO,STOCK, PAIS FROM producto WHERE STOCK < cantidad;
END$$
DELIMITER ;