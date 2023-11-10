#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Roles
#------------------------------------------------------------

CREATE TABLE Roles(
        id_R   Int  Auto_increment  NOT NULL ,
        name_R Varchar (50) NOT NULL
	,CONSTRAINT Roles_PK PRIMARY KEY (id_R)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        id_U                Int  Auto_increment  NOT NULL ,
        userName_U          Varchar (60) NOT NULL ,
        lastName_U          Varchar (50) ,
        firstName_U         Varchar (50) ,
        password_U          Varchar (60) NOT NULL ,
        email_U             Varchar (50) NOT NULL ,
        birthDate_U         Date ,
        phone_U             Varchar (10) ,
        streetNumber_U      Varchar (10) ,
        address_U           Varchar (50) ,
        additionalAddress_U Varchar (100) ,
        zipCode_U           Varchar (10) ,
        city_U              Varchar (50) ,
        creationDate_U      Date NOT NULL ,
        status_U            Int NOT NULL ,
        activationKey_U     Varchar (32) NOT NULL ,
        recuperationKey_U   Varchar (32) ,
        id_R                Int
	,CONSTRAINT Users_PK PRIMARY KEY (id_U)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Articles
#------------------------------------------------------------

CREATE TABLE Articles(
        id_A           Int  Auto_increment  NOT NULL ,
        title_A        Varchar (50) NOT NULL ,
        image_A        Varchar (50) NOT NULL ,
        shortContent_A Text NOT NULL ,
        longContent_A  Text ,
        creationDate_A Datetime NOT NULL ,
        modifDate_A    Datetime ,
        id_U           Int
	,CONSTRAINT Articles_PK PRIMARY KEY (id_A)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Category
#------------------------------------------------------------

CREATE TABLE Category(
        id_Cat   Int  Auto_increment  NOT NULL ,
        name_Cat Varchar (50) NOT NULL
	,CONSTRAINT Category_PK PRIMARY KEY (id_Cat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Events
#------------------------------------------------------------

CREATE TABLE Events(
        id_E           Int  Auto_increment  NOT NULL ,
        title_E        Varchar (50) NOT NULL ,
        image_E        Varchar (50) NOT NULL ,
        shortContent_E Text NOT NULL ,
        longContent_E  Text ,
        dateEvent_E    Datetime NOT NULL ,
        creationDate_E Datetime NOT NULL ,
        modifDate_E    Datetime ,
        id_U           Int ,
        id_Cat         Int
	,CONSTRAINT Events_PK PRIMARY KEY (id_E)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Comments
#------------------------------------------------------------

CREATE TABLE Comments(
        id_C           Int  Auto_increment  NOT NULL ,
        title_C        Varchar (50) NOT NULL ,
        content_C      Text NOT NULL ,
        creationDate_C Datetime NOT NULL ,
        modifDate_C    Datetime ,
        id_A           Int ,
        id_U           Int ,
        id_E           Int
	,CONSTRAINT Comments_PK PRIMARY KEY (id_C)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Registered
#------------------------------------------------------------

CREATE TABLE Registered(
        id_R   Int  Auto_increment  NOT NULL ,
        date_R Datetime NOT NULL ,
        id_U   Int ,
        id_E   Int
	,CONSTRAINT Registered_PK PRIMARY KEY (id_R)
)ENGINE=InnoDB;



ALTER TABLE Users ADD CONSTRAINT FK_Users_Roles FOREIGN KEY (id_R) REFERENCES Roles(id_R) ON DELETE SET NULL;

ALTER TABLE Articles ADD CONSTRAINT FK_Articles_Users FOREIGN KEY (id_U) REFERENCES Users(id_U) ON DELETE SET NULL;

ALTER TABLE Events ADD CONSTRAINT FK_Events_Users FOREIGN KEY (id_U) REFERENCES Users(id_U) ON DELETE SET NULL;
ALTER TABLE Events ADD CONSTRAINT FK_Events_Category FOREIGN KEY (id_Cat) REFERENCES Category(id_Cat) ON DELETE SET NULL;

ALTER TABLE Comments ADD CONSTRAINT FK_Comments_Articles FOREIGN KEY (id_A) REFERENCES Articles(id_A) ON DELETE SET NULL;
ALTER TABLE Comments ADD CONSTRAINT FK_Comments_Users0 FOREIGN KEY (id_U) REFERENCES Users(id_U) ON DELETE SET NULL;
ALTER TABLE Comments ADD CONSTRAINT FK_Comments_Events1 FOREIGN KEY (id_E) REFERENCES Events(id_E) ON DELETE SET NULL;

ALTER TABLE Registered ADD CONSTRAINT FK_Registered_Users FOREIGN KEY (id_U) REFERENCES Users(id_U) ON DELETE SET NULL;
ALTER TABLE Registered ADD CONSTRAINT FK_Registered_Events FOREIGN KEY (id_E) REFERENCES Events(id_E) ON DELETE SET NULL;


INSERT INTO Roles (`name_R`)
 VALUES
 ('Inscrit'),
 ('Membre'),
 ('Modérateur'),
 ('Administrateur');

INSERT INTO Category (`name_Cat`)
 VALUES
 ('Magic - Commander'),
 ('Magic - Modern'),
 ('Magic - Standard'),
 ('Yu-gi-oh'),
 ('Sortie cinéma'),
 ('Jeu de rôle'),
 ('Jeu de société'),
 ('Autre');
