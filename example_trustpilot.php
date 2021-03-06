<?php include_once 'kiyoh.php'; $ScoreAndReviews = get_kiyoh_score_and_reviews('[HASH]', 3); ?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Trustpilot</title>
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
		<a href="https://nl.trustpilot.com/">
			<img src="https://images-static.trustpilot.com/community/shared/logo_retina.png" alt="Trustpilot" />
			<div itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
				<span itemprop="itemreviewed"><?=$ScoreAndReviews['name'];?></span><br />
				Rating: <span itemprop="average"><?=$ScoreAndReviews['score'];?></span>/<span itemprop="best">10</span><br />
				<span itemprop="count"><?=$ScoreAndReviews['reviews'];?></span> ratings</p>
			</div>
		</a>
	</body>
</html>