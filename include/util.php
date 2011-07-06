<?php
Class util
{
		public static function executeQuery($sql, $label) {
	      	$database = "creatives";
	      	$host = "localhost";
	      	$username = "testuser";
	      	$password = "testpass";

	      	$link = mysql_connect($host,$username,$password);
	      	@mysql_select_db($database) or die( "Unable to select database");
	   		$result = mysql_query($sql);
	   		$record = "";
	   		if (strstr($sql, "select") === FALSE) {
	   		} else {
	   			$count = mysql_num_rows($result);
	   			if ($count > 0) {
	  				for ($i = 0; $i < mysql_num_fields($result); $i++) {
	  						$meta = mysql_fetch_field($result, $i);
					    $record[$i] = $meta->name;
					}
					$records[0] = $record;
					$counter = 1;
		    		while ( $row = mysql_fetch_array($result) ) {
		    			$record = "";
						for ($i = 0; $i < count($records[0]); $i++) {
		    				$record[$i] = $row[$records[0][$i]];
						}
		    			$records[$counter] = $record;
		    			$counter++;
		    		}
		    	}
		    }
	      	mysql_close();

			return $records;
		}
	
		public static function getParameter($parameterName) {
			if($parameterName=="base_path")
				return "/commons";
    		$value = $_REQUEST[$parameterName];
    		return $value;
   	}

		public static function timeStamp($accountId)
		{
			$time = time();
			$sql = "update accounts set last_login=$time where account_id=$accountId";
			util::executeQuery($sql, "timeStamp");
		}
		
		public static function getUserPics($accountId, $type)
		{
			switch($type){
				case "photo":
					$sql = "select file_path, photo_id from photos where account_id=$accountId order by views limit 9";
					break;
				case "visualart":
					$sql = "select file_path, visualart_id from visualart where account_id=$accountId order by views limit 9";
			}
			
			$rec = util::executeQuery($sql, "");
			for($i=1;$i<count($rec);$i++)
			{
				$paths[$i-1][0]=$rec[$i][0];
				$paths[$i-1][1]=$rec[$i][1];
			}
			
			shuffle($paths);
			return $paths;
		}
		
		public static function increaseViews($id, $type)
		{
			switch($type){
				case "photo":
					$sql = "select views from photos where photo_id=$id";
					break;
				case "visualart":
					$sql = "select views from visualart where visualart_id=$id";
					break;
				case "writing":
					$sql = "select views from writing where writing_id=$id";
					break;
				case "film":
					$sql = "select views from video where video_id=$id";
					break;
			}
			
			$rec = util::executeQuery($sql, "");
			$oldViews = $rec[1][0];
			$newViews = $oldViews + 1;
			
			switch($type){
				case "photo":
					$sql = "update photos set views=$newViews where photo_id=$id";
					break;
				case "visualart":
					$sql = "update visualart set views=$newViews where visualart_id=$id";
					break;
				case "writing":
					$sql = "update writing set views=$newViews where writing_id=$id";
					break;
				case "film":
					$sql = "update video set views=$newViews where video_id=$id";
					break;
			}
			util::executeQuery($sql, "");
		}
		
		public static function getTopTen($accountId)
		{
			$sql = "select views, photo_id, file_path, title from photos where account_id=$accountId order by views desc limit 9";
			$photos = util::executeQuery($sql, "");
			
			$sql = "select views, visualart_id, file_path, title from visualart where account_id=$accountId order by views desc limit 9";
			$visualart = util::executeQuery($sql, "");
			
			$sql = "select views, writing_id, text, title from writing where account_id=$accountId order by views desc limit 9";
			$writing  = util::executeQuery($sql, "");
			
			$sql = "select views, video_id, host_id from video where account_id=$accountId order by views desc limit 9";
			$video = util::executeQuery($sql, "");
			
			$inPho=1; $inVis=1; $inWri=1; $inVid=1;
			for($i=1; $i<10 && ($i<count($photos) || $i<count(visualart) || $i<count($writing) || $i<count($video));$i++) //9 items, or total number of uploaded items
			{
				$maxViews = max($photos[$inPho][0], $visualart[$inVis][0], $writing[$inWri][0], $video[$inVid][0]);
				switch($maxViews)
				{
					case($photos[$inPho][0]):
						$finalItems[$i-1]["type"]="picture";
						$finalItems[$i-1]["link"]="photo.php?id=".$photos[$inPho][1];
						$finalItems[$i-1]["src"]=$photos[$inPho][2];
						$finalItems[$i-1]["title"]=$photos[$inPho++][3];
						break;
					case($visualart[$inVis][0]):
						$finalItems[$i-1]["type"]="picture";
						$finalItems[$i-1]["link"]="visualart.php?id=".$visualart[$inVis][1];
						$finalItems[$i-1]["src"]=$visualart[$inVis][2];
						$finalItems[$i-1]["title"]=$visualart[$inVis++][3];
						break;
					case($writing[$inWri][0]):
						$finalItems[$i-1]["type"]="text";
						$finalItems[$i-1]["link"]="writing.php?id=".$writing[$inWri][1];
						$finalItems[$i-1]["src"]=$writing[$inWri][2];
						$finalItems[$i-1]["title"]=$writing[$inWri++][3];
						break;
					case($video[$inVid][0]):
						$finalItems[$i-1]["type"]="video";
						$finalItems[$i-1]["link"]="film.php?id=".$video[$inVid][1];
						$finalItems[$i-1]["src"]=$video[$inVid][2];
						$finalItems[$i-1]["title"]=$video[$inVid++][3];
						break;
				}
			}
			return $finalItems;
		}
		
		public static function profileResize($src)
		{
			$size = getimagesize($src);
			if($size[0] > 200) //Scale width
			{
				$width = "200";
				$height = (200/$size[0]) * $size[1];
			}
			if($height>133) //Scale height
			{
				$width = (133/$height) * $width;
				$height = 133;
			}
			$dimensions["width"] = $width;
			$dimensions["height"] = $height;
			return $dimensions;
		}
		
		public static function profileShorten($text)
		{
			
		}
		
		public static function showVideo($type, $host_id, $width, $height)
		{
			if($type=="vimeo")
			{
				echo "<iframe src='http://player.vimeo.com/video/".$host_id."?title=0&amp;byline=0&amp;portrait=0' width='".$width."' height='".$height."' frameborder='0'></iframe>";
			}
			else
			{
				echo "<iframe width=$width height=$height src='http://www.youtube.com/embed/".$host_id."' frameborder='0' allowfullscreen></iframe>";
			}
		}
}

?>