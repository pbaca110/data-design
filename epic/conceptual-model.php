<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>conceptual model</title>
	</head>
	<body>
		<h1>Conceptual Model</h1>
	</body>
	<main>

		<h1>product:</h1>

		<ul>
			<li>productid(primary)</li>
			<li>productDescription</li>
			<li>productName</li>
		<li>productPrice</li>
		</ul>


			<h1>Profile:</h1>
			<ul>
				<li> profileId(primary key)</li>
				<li>profileHash (for account password)</li>
				<li>profileSalt (for account password)</li>
				<li>profileEmail</li>
				<li>profileAtHandle</li>
				<li>profileAcitvationToken</li>
				<li>profilePhone</li>


			</ul>
			<h1>Favorite</h1>
		<ul>
			<li>favoriteProfileid(foreign key)</li>

				<li>favoriteProductid(foreign key)</li>
				<li>favoriteDate</li>

			</ul>








	</main>











</
