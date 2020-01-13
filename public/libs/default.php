<?php
class DB {
	static public $mysqli = array();
	static public $connect = array();
	
	static public function _($key = 0) {
		if(!isset(self::$mysqli[$key])) {
			if(!isset(self::$connect['server']))
				self::$connect['server'] = Core::$DB_LOCAL;
			if(!isset(self::$connect['user']))
				self::$connect['user'] = Core::$DB_LOGIN;
			if(!isset(self::$connect['pass']))
				self::$connect['pass'] = Core::$DB_PASS;
			if(!isset(self::$connect['db']))
				self::$connect['db'] = Core::$DB_NAME;

			self::$mysqli[$key] = @new mysqli(self::$connect['server'],self::$connect['user'],self::$connect['pass'],self::$connect['db']); // WARNING
			q("SET time_zone = '+06:00'");
			if (mysqli_connect_errno()) {
				echo 'Не удалось подключиться к Базе Данных';
				exit;
			}
			if(!self::$mysqli[$key]->set_charset("utf8")) {
				echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
				exit;
			}
		}
		return self::$mysqli[$key];
	}
	static public function close($key = 0) {
		self::$mysqli[$key]->close();
		unset(self::$mysqli[$key]);
	}
}

function q($query,$key = 0) {
	$res = DB::_($key)->query($query);
	if($res === false) {
		$info = debug_backtrace();
		$error = "QUERY: ".$query."<br>\n".DB::_($key)->error."<br>\n".
		         "file: ".$info[0]['file']."<br>\n".				 
				 "line: ".$info[0]['line']."<br>\n".
				 "date: ".date("Y-m-d H:i:s")."<br>\n".
				 "===================================";		
		
		file_put_contents('./logs/mysql.log',strip_tags($error)."\n\n",FILE_APPEND);
		echo $error;
		exit();
	}
	return $res;
}	

function es($el,$key = 0) {
	return DB::_($key)->real_escape_string($el);
}

function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}
	
function trimAll($el) {
	if(!is_array($el)) {
		$el = trim($el);
	} else {
		$el = array_map('trimAll',$el);
	}
	return $el;	
}

function intAll($el) {
	if(!is_array($el)) {
		$el = (int)($el);
	} else {
		$el = array_map('intAll',$el);
	}
	return $el;	
}

function floatAll($el) {
	if(!is_array($el)) {
		$el = (float)($el);
	} else {
		$el = array_map('floatAll',$el);
	}
	return $el;	
}

function hc($el) {
	if(!is_array($el)) {
		$el = htmlspecialchars($el);
	} else {
		$el = array_map('htmlspecialcharsAll',$el);
	}
	return $el;	
}



function __autoload($class) {
	include './libs/class_'.$class.'.php';
}

function myHash($var) {
	$salt = 'ABC';
	$salt2 = 'CBA';
	$var = crypt(md5($var.$salt),$salt2);
	return $var;
}

function small($file, $way, $ways, $width, $height, $name, $width1, $height1, $tiny, $width2, $height2, $b610) {
	$array = array('image/gif','image/jpeg','image/png');
	$array2 = array('jpeg','jpg','gif','png');
	if($file['error'] == 0) {
		if($file['size'] < 5000 || $file['size'] > 5000000) {
			return 'Размер изображения не подходит';	
		} else {
			preg_match('#\.([a-z]+)$#iu',$file['name'], $matches);	
			if(isset($matches[1])) {
				$matches[1] = mb_strtolower($matches[1]);
				$temp = getimagesize($file['tmp_name']);
				if(!in_array($matches[1],$array2)) {
					return 'Не подходит расширение изображения';	
				} elseif(!in_array($temp['mime'],$array)) {
					return 'Не подходит тип файла, можно загружать только изображения';	
				} elseif(!move_uploaded_file($file['tmp_name'],'.'.$name)) {
					return 'Изображение не загружено, ошибка!';
				} else {
					$infoi = getimagesize('.'.$name);
					if($infoi[0] < $width2 || $infoi[1] < $height2) {
						return 'Фото должно быть размером не меньше чем '.$width2.' на '.$height2.' пикселей';	
					}
					if($infoi[1] > $height2) {  
						
						//610 на x
						// получение новых размеров
						$new_width = $width2;
						$new_height = ($infoi[1]*$width2)/$infoi[0];
							
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$name);
						$imagesq = imagecreatetruecolor($width2, $height2);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoi[0], $infoi[1]);
						
						$y = ($new_height-$height2)/2;
							  
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, 0, $y, $width2, $height2);
						imagejpeg($imagesq, '.'.$b610, 100);
						
						//200 на 150
						// получение новых размеров
						$new_width = ($infoi[0]*$height)/$infoi[1];
						$new_height = $height;
							
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$name);
						$imagesq = imagecreatetruecolor($width, $height);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoi[0], $infoi[1]);
						
						$x = ($new_width-$width)/2;
							  
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width, $height);
						imagejpeg($imagesq, '.'.$way, 100);
						
						
						
						//50 на 50
						
						$infoii = getimagesize('.'.$way);
						if($infoii[0] < $width1 || $infoii[1] < $height1) {
							return 'Фото должно быть размером не меньше чем '.$width1.' на '.$height1.' пикселей';	
						}
						 
						// получение новых размеров
						$new_width = ($infoii[0]*$height1)/$infoii[1];
						$new_height = $height1;
						
						
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$way);
						$imagesq = imagecreatetruecolor($width1, $height1);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoii[0], $infoii[1]);
							
						$x = ($new_width-$width1)/2;
								  
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width1, $height1);
						imagejpeg($imagesq, '.'.$tiny, 100);
						return true;
					}
				}
				
				} else {
					return 'Данный файл не является картинкой, принимаемые типы файлов: gif, png, jpg';
				}
			}
		} else {
			return 'Файл не был загружен';	
		}
}

function ava($file, $small, $ways, $width, $height, $width1, $height1, $width2, $height2, $big, $ava, $tiny) {
	$array = array('image/gif','image/jpeg','image/png');
	$array2 = array('jpeg','jpg','gif','png');
	if($file['error'] == 0) {
		if($file['size'] < 5000 || $file['size'] > 5000000) {
			return 'Размер изображения не подходит';	
		} else {
			preg_match('#\.([a-z]+)$#iu',$file['name'], $matches);	
			if(isset($matches[1])) {
				$matches[1] = mb_strtolower($matches[1]);
				$temp = getimagesize($file['tmp_name']);
				if(!in_array($matches[1],$array2)) {
					return 'Не подходит расширение изображения';	
				} elseif(!in_array($temp['mime'],$array)) {
					return 'Не подходит тип файла, можно загружать только изображения';	
				} elseif(!move_uploaded_file($file['tmp_name'],'.'.$big)) {
					return 'Изображение не загружено, ошибка!';
				} else {
					$infoi = getimagesize('.'.$big);
					if($infoi[0] < $width || $infoi[1] < $height) {
						return 'Фото должно быть размером не меньше чем '.$width.' на '.$height.' пикселей';	
					}
					if($infoi[1] >= $height) {  
						// получение новых размеров
						$new_width = ($infoi[0]*$height)/$infoi[1];
						$new_height = $height;
							
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$big);
						$imagesq = imagecreatetruecolor($width, $height);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoi[0], $infoi[1]);
						
						$x = ($new_width-$width)/2;
						 
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width, $height);
						imagejpeg($imagesq, '.'.$small, 100);
						
						//100 на 100
						
						$infoii = getimagesize('.'.$small);
						if($infoii[0] < $width1 || $infoii[1] < $height1) {
							return 'Фото должно быть размером не меньше чем '.$width1.' на '.$height1.' пикселей';	
						}
						if($width1 > $height1) {  
							// получение новых размеров
							$new_width = ($infoii[0]*$height1)/$infoii[1];
							$new_height = $height1;
						} else {
							// получение новых размеров
							$new_width = $width1;
							$new_height = ($infoii[1]*$width1)/$infoii[0];
						}
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$small);
						$imagesq = imagecreatetruecolor($width1, $height1);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoii[0], $infoii[1]);
							
						$x = ($new_width-$width1)/2;
								  
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width1, $height1);
						imagejpeg($imagesq, '.'.$ava, 100);
						
						if($width2 != 0 && $height2 != 0) {
							//50 на 50
							
							$infoii = getimagesize('.'.$ava);
							if($infoii[0] < $width2 || $infoii[1] < $height2) {
								return 'Фото должно быть размером не меньше чем '.$width2.' на '.$height2.' пикселей';	
							}
							if($width2 > $height2) {  
								// получение новых размеров
								$new_width = ($infoii[0]*$height2)/$infoii[1];
								$new_height = $height2;
							} else {
								// получение новых размеров
								$new_width = $width2;
								$new_height = ($infoii[1]*$width2)/$infoii[0];
							}
							// ресэмплирование
							$image_p = imagecreatetruecolor($new_width, $new_height);
							$image = imagecreatefromjpeg('.'.$ava);
							$imagesq = imagecreatetruecolor($width2, $height2);
							imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoii[0], $infoii[1]);
								
							$x = ($new_width-$width2)/2;
									  
							// вывод
							imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width2, $height2);
							imagejpeg($imagesq, '.'.$tiny, 100);
							return true;
						} else {
							return true;	
						}
					}
				}
				
				} else {
					return 'Данный файл не является картинкой, принимаемые типы файлов: gif, png, jpg';
				}
			}
		} else {
			return 'Файл не был загружен';	
		}
}



function iconmake($file, $small, $ways, $width, $height, $big) {
	$array = array('image/gif','image/jpeg','image/png');
	$array2 = array('jpeg','jpg','gif','png');
	if($file['error'] == 0) {
		if($file['size'] < 5000 || $file['size'] > 5000000) {
			return 'Размер изображения не подходит';	
		} else {
			preg_match('#\.([a-z]+)$#iu',$file['name'], $matches);	
			if(isset($matches[1])) {
				$matches[1] = mb_strtolower($matches[1]);
				$temp = getimagesize($file['tmp_name']);
				if(!in_array($matches[1],$array2)) {
					return 'Не подходит расширение изображения';	
				} elseif(!in_array($temp['mime'],$array)) {
					return 'Не подходит тип файла, можно загружать только изображения';	
				} elseif(!move_uploaded_file($file['tmp_name'],'.'.$big)) {
					return 'Изображение не загружено, ошибка!';
				} else {
					$infoi = getimagesize('.'.$big);
					if($infoi[0] < $width || $infoi[1] < $height) {
						return 'Фото должно быть размером не меньше чем '.$width.' на '.$height.' пикселей';	
					}
					if($infoi[1] >= $height) {  
						// получение новых размеров
						$new_width = ($infoi[0]*$height)/$infoi[1];
						$new_height = $height;
							
						// ресэмплирование
						$image_p = imagecreatetruecolor($new_width, $new_height);
						$image = imagecreatefromjpeg('.'.$big);
						$imagesq = imagecreatetruecolor($width, $height);
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $infoi[0], $infoi[1]);
						
						$x = ($new_width-$width)/2;
						 
						// вывод
						imagecopy($imagesq, $image_p, 0, 0, $x, 0, $width, $height);
						imagejpeg($imagesq, '.'.$small, 100);
											
						return true;	
					}
				}
				
				} else {
					return 'Данный файл не является картинкой, принимаемые типы файлов: gif, png, jpg';
				}
			}
		} else {
			return 'Файл не был загружен';	
		}
}




function trans($string) {
        $arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
        $arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");        
        $arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");
                   
			$replace = array(
				"А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
				"Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
				"Й"=>"Y","й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n",
				"О"=>"O","о"=>"o","П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t",
				"У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch",
				"Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"",
				"Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu","Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye"," "=>"-");
					
			$string = str_replace($arStrES, $arStrRS, $string);
			$string = str_replace($arStrOS, $arStrRS, $string);
    return iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
}

function paginator($get, $numpages, $link) {
	if(ceil($numpages) != 0) {
		if(!isset($get) || $get == 1) {
			echo '<span class="paginator">1</span> ';
		} else {
		    if(!isset($_GET['sort'])) {
                echo '<a href="'.$link.'?p=1" class="paginator_link">1</a> ';
            } else echo '<a href="'.$link.'&p=1" class="paginator_link">1</a> ';
		}
	}
	for($i = 2; $i < ceil($numpages); $i++) {
		 if($get-3 == $i) {
			echo '...';
		 } 
		 if($i <= $get+2 && $i >= $get-2) {
			 if($_GET['p'] == $i) {
				echo '<span class="paginator">'.$i.'</span> ';
			 } else {
                 if(!isset($_GET['sort'])) {
                     echo '<a href="' . $link . '?p=' . $i . '" class="paginator_link">' . $i . '</a> ';
                 } else echo '<a href="' . $link . '&p=' . $i . '" class="paginator_link">' . $i . '</a> ';
			 }
		 }
		 if(!($i != $get+2 || $get+3 == ceil($numpages))) {
			echo '...';
		 } 
		 if($i <= $get-7 || $i >= $get+7) {
			 if($get == $i) {
				echo '<span class="paginator">'.$i.'</span> ';
			 } else {
                 if(!isset($_GET['sort'])) {
                     echo '<a href="' . $link . '?p=' . $i . '" class="paginator_link">1' . $i . '</a> ';
                 } else echo '<a href="' . $link . '&p=' . $i . '" class="paginator_link">1' . $i . '</a> ';
			 }
		 }
	}
	if(ceil($numpages) > 1) {
		if(isset($get) && $get == ceil($numpages)) {
			echo '<span class="paginator">'.ceil($numpages).'</span> ';
		} else {
            if(!isset($_GET['sort'])) {
                echo '<a href="' . $link . '?p=' . ceil($numpages) . '" class="paginator_link">' . ceil($numpages) . '</a> ';
            } else echo '<a href="' . $link . '&p=' . ceil($numpages) . '" class="paginator_link">' . ceil($numpages) . '</a> ';
		}
	}	
}

function age($m,$d,$y) {
	$r = mktime(0, 0, 0, $m, $d, $y); 
    $age = (time()-$r)/31536000;
    list($a) = explode(".",$age);  
    return  $a; 
}

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100)
{
    if (!file_exists($src))
        return false;

    $size = getimagesize($src);

    if ($size === false)
        return false;

    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom'.$format;

    if (!function_exists($icfunc))
        return false;

    $x_ratio = $width  / $size[0];
    $y_ratio = $height / $size[1];

    if ($height == 0)
    {
        $y_ratio = $x_ratio;
        $height  = $y_ratio * $size[1];
    }
    elseif ($width == 0)
    {
        $x_ratio = $y_ratio;
        $width   = $x_ratio * $size[0];
    }

    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

    // если не нужно увеличивать маленькую картинку до указанного размера
    if ($size[0]<$new_width && $size[1]<$new_height)
    {
        $width = $new_width = $size[0];
        $height = $new_height = $size[1];
    }

    $isrc  = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);

    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

    $i = strrpos($dest,'.');
    if (!$i) return '';
    $l = strlen($dest) - $i;
    $ext = substr($dest,$i+1,$l);
    $ext = strtolower($ext);
    switch ($ext)
    {
        case 'jpeg':
        case 'jpg':
            imagejpeg($idest,$dest,$quality);
            break;
        case 'gif':
            imagegif($idest,$dest);
            break;
        case 'png':
            imagepng($idest,$dest);
            break;
    }

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}

function getWord1($number, $suffix) {
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $number % 100;
    $suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[min($mod % 10, 5)];
    return $suffix[$suffix_key];
}

function uploadHandle($max_file_size = 1024, $valid_extensions = array(), $upload_dir = '.', $i = 0)
{

    $error = null;
    $info  = null;
    $max_file_size *= 1048576;  // размер файла в Mb
    if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK)
    {
        // проверяем расширение файла
        $file_extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_extension), $valid_extensions))
        {
            // проверяем размер файла
            if ($_FILES['file']['size'][$i] < $max_file_size)
            {
                $file_name = date("dmY-Hi") . $_FILES['file']['name'][$i];  // к имени файла добавляем метку времени, чтобы исключить одинаковые имена
                $destination = $upload_dir .'/' . $file_name;

                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $destination))
                    $info = $destination;
                else
                    $error = 'Не удалось загрузить файл';
            }
            else
                $error = 'Размер файла больше допустимого';
        }
        else
            $error = 'У файла недопустимое расширение';
    }
    else
    {
        // массив ошибок
        $error_values = array(

            UPLOAD_ERR_INI_SIZE   => 'Размер файла больше разрешенного директивой upload_max_filesize в php.ini',
            UPLOAD_ERR_FORM_SIZE  => 'Размер файла превышает указанное значение в MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL    => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE    => 'Не был выбран файл для загрузки',
            UPLOAD_ERR_NO_TMP_DIR => 'Не найдена папка для временных файлов',
            UPLOAD_ERR_CANT_WRITE => 'Ошибка записи файла на диск'

        );

        $error_code = $_FILES['file']['error'][$i];

        if (!empty($error_values[$error_code]))
            $error = $error_values[$error_code];
        else
            $error = 'Случилось что-то непонятное';
    }

    return array('info' => $info, 'error' => $error);
}