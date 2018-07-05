
DROP TABLE IF EXISTS users ; 
CREATE TABLE users (id_users_users INT AUTO_INCREMENT NOT NULL, email_users VARCHAR(100), avatar_users VARCHAR(100), password_users VARCHAR(255), nickname_users VARCHAR(50), status_users VARCHAR(45), identifier_users VARCHAR(45), account_users DOUBLE(100), firstname_users VARCHAR(45), lastname_users VARCHAR(45), PRIMARY KEY (id_users_users)) ENGINE=InnoDB; 

DROP TABLE IF EXISTS prices ; 
CREATE TABLE prices (id_pricing_prices INT AUTO_INCREMENT NOT NULL, price_prices DOUBLE(45), PRIMARY KEY (id_pricing_prices)) ENGINE=InnoDB;  

DROP TABLE IF EXISTS types ; 
CREATE TABLE types (id_type_types INT AUTO_INCREMENT NOT NULL, asset_type_types VARCHAR, PRIMARY KEY (id_type_types)) ENGINE=InnoDB;  

DROP TABLE IF EXISTS quantity ;
CREATE TABLE quantity (id_quality_quantity INT AUTO_INCREMENT NOT NULL, quality_quantity VARCHAR(45), PRIMARY KEY (id_quality_quantity)) ENGINE=InnoDB;  

DROP TABLE IF EXISTS assets ; 
CREATE TABLE assets (id_assets_assets INT AUTO_INCREMENT NOT NULL, description_assets VARCHAR(255), entering_date_assets DATETIME, release_date_assets DATETIME, status_assets BIT, id_users_users **NOT FOUND**, id_type_types **NOT FOUND**, id_pricing_prices **NOT FOUND**, id_quality_quantity VARCHAR(45), PRIMARY KEY (id_assets_assets)) ENGINE=InnoDB;  

ALTER TABLE assets ADD CONSTRAINT FK_assets_id_users_users FOREIGN KEY (id_users_users) REFERENCES users (id_users_users); 
ALTER TABLE assets ADD CONSTRAINT FK_assets_id_type_types FOREIGN KEY (id_type_types) REFERENCES types (id_type_types); 
ALTER TABLE assets ADD CONSTRAINT FK_assets_id_pricing_prices FOREIGN KEY (id_pricing_prices) REFERENCES prices (id_pricing_prices); 
ALTER TABLE assets ADD CONSTRAINT FK_assets_id_quality_quantity FOREIGN KEY (id_quality_quantity) REFERENCES quantity (id_quality_quantity); 