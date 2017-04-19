DROP TABLE IF EXISTS favorite;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS profile;



CREATE TABLE profile (
	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileActivationToken CHAR(32),
	profileAtHandle VARCHAR(32) NOT NULL,
	profileEmail VARCHAR(128) UNIQUE NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	profilePhone VARCHAR(32),
	PRIMARY KEY(profileId)
);

CREATE TABLE product (
	productId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	productDate DATETIME NOT NULL,
	productDescription VARCHAR(140) NOT NULL,
	productName VARCHAR(64) NOT NULL,
	INDEX (productName),
	PRIMARY KEY(productId)
);

CREATE TABLE favorite (
	favoriteDate DATETIME(6) NOT NULL,
	favoriteProfileId INT UNSIGNED NOT NULL,
	favoriteProductId INT UNSIGNED NOT NULL,
	INDEX(favoriteProfileId),
	INDEX(favoriteProfileId),

	FOREIGN KEY (favoriteProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (favoriteProductId) REFERENCES product(productId),

	PRIMARY KEY (favoriteProfileId, favoriteProductId)
);





