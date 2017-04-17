DROP TABLE IF EXISTS favorite;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS profile;



CREATE TABLE profile (profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileActivationToken CHAR(32),
	profileAtHandle VARCHAR(32)NOT NULL,
	profileEmail VARCHAR(128) UNIQUE NOT NULL,
profileHash CHAR(128) NOT NULL,
profileSalt CHAR(64) NOT NULL,
	profilePhone VARCHAR(32),
PRIMARY KEY(profileId)
);

CREATE TABLE product (
	productDate DATETIME NOT NULL,
	productDescription INT UNSIGNED NOT NULL,
	productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
productName VARCHAR(140) NOT NULL,
productPrice VARCHAR(4),
INDEX(productId),
FOREIGN KEY(productId) REFERENCES profile(profileId),
PRIMARY KEY(productId)
);


CREATE TABLE favorite (
	favoriteDate DATETIME(6) NOT NULL,
	favoriteProfileid INT UNSIGNED NOT NULL,
favoriteProductid INT UNSIGNED NOT NULL ,
INDEX(favoriteProfileid),
INDEX(favoriteProfileid),

FOREIGN KEY (favoriteProfileId) REFERENCES profile(profileId),
FOREIGN KEY (favoriteProductid) REFERENCES product(productId),

PRIMARY KEY (FavoriteProfileId, favoriteProductId )
);





