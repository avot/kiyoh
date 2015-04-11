<?php include_once 'kiyoh.php'; $ScoreAndReviews = get_kiyoh_score_and_reviews('[HASH]'); ?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>KiyOh</title>
		<style type="text/css">
			body {
				margin: 0;
				background-color: #ffffff;
				font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size: 14px;
				line-height: 20px;
				color: #333333;
			}
			
			a,
			a:hover {
				text-decoration: none;
				color: #000000;
			}
		</style>
	</head>
	
	<body>
		<a href="https://www.kiyoh.nl/">
			<img src="https://www.kiyoh.nl/img/logo/228x112.png" alt="KiyOh" />
			<div itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
				<span itemprop="itemreviewed"><?=$ScoreAndReviews['name'];?></span><br />
				Rating: <span itemprop="average"><?=$ScoreAndReviews['score'];?></span>/<span itemprop="best">10</span><br />
				<span itemprop="count"><?=$ScoreAndReviews['reviews'];?></span> ratings</p>
			</div>
		</a>
	</body>
</html>