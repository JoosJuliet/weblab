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
			$song_count = 5678;
			$song_hour = (int) ($song_count/10);
		?>
		<p>
			I love music.
			I have  <?= $song_count ?> total songs,
			which is over <?= $song_hour ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>

			<ol>
				<?php
					$news_pages = $_GET["newspages"];
					if(isset($news_pages) == 0) $news_pages = 5;
					for($current = 1; $current != $news_pages+1; $current++)
					{
				?>

				<li><a href="http://music.yahoo.com/news/archive/?page=<?= $current ?>">Page <?= $current?> </a></li>
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
					$favorite_artists_names = file("favorite.txt");
					for($i = 0; $i < count($favorite_artists_names); $i++)
					{
				?>


				<li><a href="http://en.wikipedia.org/wiki/<?= $favorite_artists_names[$i] ?>"><?= $favorite_artists_names[$i] ?></a></li>
				<?php
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
					function cmp_size($a, $b)
					{
						if( (int)(filesize($a)/1024) < (int)(filesize($b)/1024) )
							return 1;
						return 0;
					}
					$array_mp3_list = glob("lab5/musicPHP/songs/*.mp3");

					$reverse_array = array_reverse($array_mp3_list);
					usort($reverse_array, "cmp_size");
					foreach ($reverse_array as $mp3_list)
					{
				?>

				<li class"mp3item">
					<a href=<?= $mp3_list?>><?= basename($mp3_list) ?> </a>(<?=  (int)(filesize($mp3_list)/1024) ?>.KB)
				</li>

				<?php
					}
				?>

				<!-- Exercise 8: Playlists (Files) -->

				<?php
					$array_m3u = glob("lab5/musicPHP/songs/*.m3u");

					rsort($array_m3u);
					foreach ($array_m3u as $m3u_list)
					{

						// print $m3u_list;
						// lab5/musicPHP/songs/playlist.m3u
						// m3u는 mp3의 list를 담은 파일

						$array_m3u_list = file($m3u_list);
						// 그 파일들을 array로 뽑음
						// print_r($array_m3u_list) ;
						// ( [0] => #EXTM3U [1] => #EXTINF:168,Blink 182 - All the Small Things [2] => all-the-small-things.mp3이딴식으로 뽑음
						// shuffle($array_m3u_list);
				?>
				<li class="playlistitem"> <?= basename($m3u_list) ?> :
					<ul>
						<?php
							print_r($array_m3u_list);
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
				<?php
					$array_m3u = glob("lab5/musicPHP/songs/*.m3u");
					foreach ($array_m3u as $m3u_list)
					{
						$array_m3u_list = file($m3u_list);
						usort($reverse_array, "cmp_size");

				?>
				<li class="playlistitem"> <?= basename($m3u_list) ?> :
					<ul>
						<?php
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



				<?php
					$array_m3u = glob("lab5/musicPHP/songs/*.m3u");

					rsort($array_m3u);
					foreach ($array_m3u as $m3u_list)
					{
						$array_m3u_list = file($m3u_list);

						$rever = array_reverse($array_mp3_list);

				?>
				<li class="playlistitem"> <?= basename($m3u_list) ?> :
					<ul>
						<?php
							foreach ($rever as $m3u_file){
								if(strpos($m3u_file, '#') !== 0){
									// print_r ( basename($m3u_file));
						?>
						<li><?= basename($m3u_file) ?></li>
						<?php
								}
							}
						?>
				 	</ul>
				</li>
				<?php
					}
				?>
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
