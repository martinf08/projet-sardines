#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id_user               Int  Auto_increment  NOT NULL ,
        nickname              Varchar (45) ,
        mail                  Varchar (100) NOT NULL ,
        avatar                Varchar (100) ,
        identifier            Varchar (4) NOT NULL ,
        account_creation_date TimeStamp NOT NULL ,
        last_login            TimeStamp ,
        password              Varchar (32) NOT NULL ,
        account_status        Varchar (1) NOT NULL ,
        balance               Int NOT NULL ,
        admin                 Boolean NOT NULL COMMENT "user est admin ou non"  ,
        staff                 Boolean NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type
#------------------------------------------------------------

CREATE TABLE type(
        id_type Int  Auto_increment  NOT NULL ,
        name    Varchar (15) NOT NULL
	,CONSTRAINT type_PK PRIMARY KEY (id_type)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: quality
#------------------------------------------------------------

CREATE TABLE quality(
        id_quality Int  Auto_increment  NOT NULL ,
        level      Int NOT NULL ,
        label      Varchar (15) NOT NULL
	,CONSTRAINT quality_PK PRIMARY KEY (id_quality)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: asset
#------------------------------------------------------------

CREATE TABLE asset(
        id_asset     Int  Auto_increment  NOT NULL ,
        value        Int NOT NULL ,
        description  Text ,
        entry_date   TimeStamp NOT NULL ,
        removal_date TimeStamp ,
        tag          Int NOT NULL COMMENT "identifiant alphanumérique"  ,
        id_user      Int ,
        id_type      Int NOT NULL ,
        id_quality   Int NOT NULL
	,CONSTRAINT asset_PK PRIMARY KEY (id_asset)

	,CONSTRAINT asset_user_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
	,CONSTRAINT asset_type0_FK FOREIGN KEY (id_type) REFERENCES type(id_type)
	,CONSTRAINT asset_quality1_FK FOREIGN KEY (id_quality) REFERENCES quality(id_quality)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: price_catalog
#------------------------------------------------------------

CREATE TABLE price_catalog(
        id_quality Int NOT NULL ,
        id_type    Int NOT NULL ,
        value      Int
	,CONSTRAINT price_catalog_PK PRIMARY KEY (id_quality,id_type)

	,CONSTRAINT price_catalog_quality_FK FOREIGN KEY (id_quality) REFERENCES quality(id_quality)
	,CONSTRAINT price_catalog_type0_FK FOREIGN KEY (id_type) REFERENCES type(id_type)
)ENGINE=InnoDB;

