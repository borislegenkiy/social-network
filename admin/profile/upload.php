<?php
	require('../../config.php');
	//resize image
	function obr_img($n_up,$w_new,$h_new,$w_up,$h_up,$n_new,$b_or_m,$obrez_w,$obrez_h) {
		//$n_up - Загружаемый файл
		//$w_new - Ширина нового файла
		//$h_new - Высота нового файла
		//$w_up - Ширина загружаемого файла
		//$h_up - Высота загружаемого файла
		//$n_new - Имя нового файла
		//$b_or_m - Предпросмотор (0) или основной файл (1)
		//$obrez_h - Координаты для обрезания исходного изображение (по дефолту 0)
		//$obrez_w - Координаты для обрезания исходного изображение (по дефолту 0)
		
		$instant = imagecreatefromjpeg($n_up);
		$new_img = imagecreatetruecolor($w_new, $h_new);
		if($b_or_m == 0) {
			$h_up -= $obrez_h;
			$obrez_h = 0;
			$w_up -= $obrez_w;
			$obrez_w /= 2;
		}
		imagecopyresampled($new_img,$instant,0,0,$obrez_w,$obrez_h,$w_new,$h_new,$w_up,$h_up);
		$size = imagesx($new_img);
		$size1 = imagesy($new_img);
		
		if($b_or_m == 0)
			imagejpeg($new_img, "../../images/avatars/mini/".$n_new.".jpg", 100);
		if($b_or_m == 1)
			imagejpeg($new_img, "../../images/avatars/big/".$n_new.".jpg", 100);
		imagedestroy($new_img);
		imagedestroy($instant);
	}
	
	function resize_image($picture) {
		$Wnewimg = 270;				//Ширина нового изображение
		$Hnewimg = 400;				//Высота нового изображение
		$Wnewminiimg = 100;			//Ширина нового мини изображение
		$Hnewminiimg = 100;			//Высота нового мини изображение
						
		//Имя картинки
		$name_img = date("His");
		$indifikator = mt_rand(1, 10000);
		$name_img = $name_img.$indifikator;
		$name_small = "small_".$name_img;
		$name_big = "big_".$name_img;
	  
		//Размер картинки
		$size = getimagesize($picture);

		if($size[0] <= $Wnewimg AND $size[1] <= $Hnewimg) {
			//Если фото не надо уменьшать
			obr_img($picture,$size[0],$size[1],$size[0],$size[1],$name_big,1,0,0);
		}
		else { //Если надо уменьшать фото
			$h_rb = $size[1]/$Hnewimg;
			$w_rb = $size[0]/$Wnewimg;
			if($h_rb > $w_rb) {
				$koef = $h_rb;
			} else {
				$koef = $w_rb;
			}
			$wb = $size[0]/$koef;
			$hb = $size[1]/$koef;
			obr_img($picture,$wb,$hb,$size[0],$size[1],$name_big,1,0,0);
		}
		
		//Создание мини изображения
		if($size[0] > $size[1]) {//Горизонтальное изображение
			$obrez_w = $size[0] - $size[1];
			$obrez_h = 0;
		}
		else {//Вертикальное изображение
			$obrez_h = $size[1] - $size[0];
			$obrez_w = 0;
		}
		if($size[0] == $size[1]) {//Кавадратное
			$obrez_h = 0;
			$obrez_w = 0;
		}
		obr_img($picture,$Wnewminiimg,$Hnewminiimg,$size[0],$size[1],$name_small,0,$obrez_w,$obrez_h);
		return $name_img;
	}
	
	//file_check
	function check_file() {
		global $messages;
		$expansion = strtolower(pathinfo($_FILES['photoimg']['name'], PATHINFO_EXTENSION));
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['photoimg']['tmp_name']);

		$allow_expansion = array (
		  "jpeg" => "image/jpeg",
		  "jpg" => "image/jpeg",
		);
		
		if ($mime !== $_FILES['photoimg']['type']) {
		  $messages[] = 'Ваш файл не прошел проверку. Используйте jpeg, jpg тип файла.';
		  return false;
		} else {
		  foreach ($allow_expansion as $key => $value) {
			if($value == $mime) {
			  if ($key == $expansion) {
				return true;
			  }
			}
		  }
		  $messages[] = 'Ваш файл не прошел проверку. Используйте jpeg, jpg тип файла.';
		}
	}

	//connect to database
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
	if ($db->connect_error) {
		printf("CONNECT ERROR : %d\n", $db->errno);
		exit();
	}
    $db->set_charset("utf8");
	
	//------------------
	$path = "../images/avatars/";
	
	$valid_formats = array(
			"jpeg",
			"jpg"
	);
	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		
		if(strlen($name)) {
			list($txt, $ext) = explode(".", $name);
			//if(check_file()) {
					$id = $_POST['user_id'];
					$tmp = $_FILES['photoimg']['tmp_name'];
					$image_file = resize_image($tmp).".jpg";
					$actual_image_name = "big_".$image_file;
					$image_with_path = "../../images/avatars/big/".$actual_image_name;
					$indent_y = 0;
					$indent_x = 0;
					$size = getimagesize($image_with_path);
					if($size[1] < 400) {
						//Фото подвигаем вниз
						$indent_y = (400 - $size[1])/2;
						$indent_x = 0;
					}
					if($size[0] < 270) {
						//Фото подвигаем влево
						$indent_x = (270 - $size[0])/2;
						$indent_y = 0;
					}
					if($size[1] < 400 && $size[0] < 270) {
						//Фото подвигаем вниз и влево
						$indent_y = (400 - $size[1])/2;
						$indent_x = (270 - $size[0])/2;
					}
					echo "<img src='$image_with_path' name='avatars' id='avatars' alt='image' style='margin-top:$indent_y; margin-left:$indent_x;'/>";
					$sql1 = $db->query("UPDATE `users` SET `picture`='$image_file' WHERE `id`=$id");
			//}
			//else {
			//	echo "Invalid file format..".$_FILES['photoimg']['name'];
			//}
		}
		else {
			echo "Please select image..!";
		}
		exit;
	}
?>