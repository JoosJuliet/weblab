<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>

		<!-- Ex 1: Number of Songs (Variables) -->
		<?php
			$song_count =5678;
			$song_hour = (int)($song_count/10);
		?>
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= $song_hour ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>

			<ol>
				<?php
					$page_num = $_GET["newspages"];
					if(isset($page_num) == 0 ) $page_num = 5;
					for ($newspages=1; $newspages <= $page_num; $newspages++) {
				?>
				<li><a href="http://music.yahoo.com/news/archive/?page=<?= $newspages ?>">Page <?= $newspages ?></a></li>

				<?php
					}
				?>

			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>

			<ol>
				<?php
					$favorite_artists = file("./favorite.txt");
					// $favorite_artists = ["Guns N' Roses","Green Day","Blink18«2"];
					foreach ($favorite_artists as $favorite_artist) {
				?>
				<li><a href="http://en.wikipedia.org/wiki/<?= $favorite_artist ?>"><?= $favorite_artist ?></a></li>
				<?
					}
				?>
			</ol>
		</div>

		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>

			<ul id="musiclist">
				<?php
					function cmp_sized($a, $b)
					{
						if( (int)(filesize($a)/1024) < (int)(filesize($b)/1024) )
							return 1;
						return 0;
					}
					$array_mp3_list = glob("lab5/musicPHP/songs/*.mp3");

					usort($array_mp3_list, "cmp_sized");
					foreach ($array_mp3_list as $mp3) {
				?>
				<li class="mp3item">
					<a href=<?= $mp3 ?>><?= basename($mp3) ?></a>(<?=  (int)(filesize($mp3)/1024) ?> KB)
				</li>
				<?
					}
				?>
				<!-- Exercise 8: Playlists (Files) shuffle-->
				<?php
					$array_m3us = glob("lab5/musicPHP/songs/*.m3u");
					// print_r ($array_m3us);
					foreach ($array_m3us as $array_m3u) {
					?>
				<li class="playlistitem"><?=basename($array_m3u)?>:
					<ul>
						<?php
							$playlist_mp3s = file($array_m3u);
							// print_r($playlist_mp3);
							shuffle($playlist_mp3s);
							foreach ($playlist_mp3s as $playlist_mp3) {
								if(strpos($playlist_mp3,'#') !== 0){
						?>
						<li><?= $playlist_mp3 ?></li>
						<?
								}
							}
						?>


					</ul>
					<?
						}
					?>
					<!-- Exercise 9: Ordering/Sorting (Files) reverse order-->
					<?php
						$array_m3u = glob("lab5/musicPHP/songs/*.m3u");

						foreach ($array_m3us as $m3u_list)
						{
							$array_m3u_list = file($m3u_list);
									rsort($array_m3u_list);
					?>
					<li class="playlistitem"> <?= basename($m3u_list) ?> :
						<ul>
							<?php
								// print_r($array_m3u_list);
								foreach ($array_m3u_list as $m3u_file){
									if(strpos($m3u_file, '#') !== 0){
							?>
							<li><?= $m3u_file ?></li>
							<?php
									}
								}
							?>
					 	</ul>
					</li>
					<?php
						}
					?>

					<!-- Exercise 9: Ordering/Sorting (Files) Sort by Size-->



			</ul>
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
