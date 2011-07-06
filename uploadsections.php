<?
$soundcloud_url = $_SESSION['soundcloud_url'];
?>

<div id="section_music">
	<h2>Music</h2>
	<a href="<?= $soundcloud_url ?>">Sign in</a> to SoundCloud to upload your tunes!
</div>

<div id="section_visualart">
	<h2>Visual Art</h2>
	<form id="Upload" action="upload.visualart.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="300000000000">
		</p>
		
		<p>
			<label for="file">File to upload:</label>
			<input id="file" type="file" name="file">
		</p>
		
		<p>
			<label for='title'>Title: </label>
			<input id='title' type='text' name='title' onmouseout='unlockSubmit();' />
		</p>
				
		<p>
			<label for="submit">Press to...</label>
			<input id="submit" type="submit" name="submit" disabled="disabled" value="Upload me!">
		</p>
	
	</form>
</div>

<div id="section_film">
	<h2>Film</h2>
	<form id="Upload" action='upload.film.processor.php' method='post'>
		
		<label for="title">Title:</label>
		<input type="text" name="title" />
		<br><br>
		<label for="link">Link (Youtube or Vimeo):</label>
		<input type="link" name="link" />
			
		<p>
			<input id="submit" type="submit" name="submit" value="Upload">
		</p>
	
	</form>	
</div>

<div id="section_writing">
	<h2>Writing</h2>
	<form id="Upload" action='upload.writing.processor.php' method='post'>
		<label for='title'>Title: </label>
		<input type='text' name='title'><br><br>
		Copy and paste here:<br><br>
		<textarea name='copyPaste' rows="15" cols="50" />
		</textarea>
				
		<p>
			<input id="submit" type="submit" name="submit" value="Upload">
		</p>
	
	</form>

</div>

<div id="section_photography">
	<h2>Photography</h2>
	<form id="Upload" action="upload.photography.processor.php" enctype="multipart/form-data" method="post">
		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="300000000000">
		</p>
		
		<p>
			<label for="file">File to upload:</label>
			<input id="file" type="file" name="file">
		</p>
		
		<p>
			<label for='title'>Title: </label>
			<input id='title' type='text' name='title' onmouseout='unlockSubmit();' />
		</p>
				
		<p>
			<label for="submit">Press to...</label>
			<input id="submit" type="submit" name="submit" disabled="disabled" value="Upload me!">
		</p>
	
	</form>
</div>
