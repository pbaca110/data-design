DROP TABLE IF EXISTS 'favorite';
DROP TABLE IF EXISTS 'product';
DROP TABLE IF EXISTS 'profile';



CREATE TABLE profile (profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
profileDescription VARCHAR(128) UNIQUE NOT NULL,
profileHash CHAR(128) NOT NULL,
profileSalt CHAR(64) NOT NULL,
profileEmail VARCHAR(128) UNIQUE NOT NULL,
PRIMARY KEY(profileId)
);

CREATE TABLE product (
productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
productDescription INT UNSIGNED NOT NULL,
productName VARCHAR(140) NOT NULL,
productPrice CHAR NULL ,
INDEX(productId),
FOREIGN KEY(productId) REFERENCES profile(profileId),
PRIMARY KEY(productId)
);


CREATE TABLE 'favorite' (
favoriteProfileid INT UNSIGNED NOT NULL,
favoriteProductid INT UNSIGNED NOT NULL ,
favoriteDate DATETIME(6) NOT NULL,
INDEX(favoriteProfileid),
INDEX(favoriteProfileid),

FOREIGN KEY (favoriteProfileId) REFERENCES profile(profileId),
FOREIGN KEY (favoriteProductid) REFERENCES product(productId),

PRIMARY KEY (FavoriteProfileId, favoriteProductId )
);

