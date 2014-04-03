<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:image.php</h1>');
	}
	
	class ImageDAO {
		// generate a preview image
		public static function generate_preview_image($home, $src) {
			$file = 'upload/temp';
			if (!file_exists($home.$file)) {
				mkdir($home.$file, 0777, true);
			}
			$file .= '/'. round(microtime(true)) . '.jpg';
			$img = imagecreatefromstring(file_get_contents($src));
			if ($img === false) {
				return '';
			}
			imagejpeg($img, $home.$file);
			return $file;
		}
		
		// clip, save image then return file address
		public static function clip_save_image($home, $pid, $src, $x, $y, $r, $need_full = false) {
			$img = imagecreatefromstring(file_get_contents($home.$src));
			if ($img === false) {
				return '';
			}
			$file = 'upload/'.$pid;
			if (!file_exists($home.$file)) {
				mkdir($home.$file, 0777, true);
			}
			$file .= '/'. round(microtime(true));
			
			if ($need_full) {
			  imagejpeg($img, $home.$file.'_full.jpg');
			}
			$s = 350;
			$dest = imagecreatetruecolor($s, $s);
			imagecopyresampled($dest, $img, 0, 0, $x, $y, $s, $s, $r, $r);
			imagejpeg($dest, $home.$file.'_large.jpg');
			$s = 50;
			$dest = imagecreatetruecolor($s, $s);
			imagecopyresampled($dest, $img, 0, 0, $x, $y, $s, $s, $r, $r);
			imagejpeg($dest, $home.$file.'_small.jpg');
			return $file;
		}
		
		// save full image then return file address
		public static function save_full_image($home, $pid, $src) {
			$img = imagecreatefromstring(file_get_contents($home.$src));
			if ($img === false) {
				return '';
			}
			$file = 'upload/'.$pid;
			if (!file_exists($home.$file)) {
				mkdir($home.$file, 0777, true);
			}
			$file .= '/'. round(microtime(true));
			
			imagejpeg($img, $home.$file.'_full.jpg');
		}
	}
	
	?>
