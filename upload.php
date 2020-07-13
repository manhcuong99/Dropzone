<?php

//upload.php
 

date_default_timezone_set('Asia/Ho_Chi_Minh');
$today = date("Y-m-d H:i:s");

$folder_name = 'upload/';
// tạo folder ảnh 
if(!empty($_FILES))
// kiểm tra nếu tồn tại file thì nó sẽ 
{
 $temp_file = $_FILES['file']['tmp_name']; // tập tin tải lên 

 // cái này $_FILES kí hiệu php nó có tác dụng là cấu trúc file +  tạm thời 
 $location = $folder_name . $_FILES['file']['name']; // nơi chỉ định lưu file 
 // cái này để  tên đường dẫn và tên file luuw 
 move_uploaded_file($temp_file, $location); 

 //  move_uploaded_file  dùng để di chuyển tập tin được tải lên vào một nơi được chỉ định

}

if(isset($_POST["name"]))
{
      
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}



$result = array();

$files = scandir('upload');
//  scandir liệt kê các tệp bên trong folder upload 
// không thể echo biến $files được mà phải duyệt mảng mới hiện được nó kiểu dạng chưa phải mảng 

$output = '<div class="row">';

if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
      //$file tên của ảnh 
   $output .= '
   <div class="col-md-2">
    <img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
    <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
   </div>
   ';
  }
 }
}
$output .= '</div>';
echo $output;

  





?>