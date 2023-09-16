<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){
$select_tutor = $conn->prepare("SELECT*FROM user WHERE id=? LIMIT=1");
$select_tutor->execute([$tutor_id]);
$fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

   $name = $_POST['name'];
   $name = filter_var($name, 'FILTER_SANITIZE_STRING');
   $email = $_POST['email'];
   $email = filter_var($email, 'FILTER_SANITIZE_STRING');

if(!empty($name)){

   $update_name = $conn->prepare("UPDATE 'tutors' SET name = ? WHERE id = ?");
   $update_name->execute([$name, $tutor_id]);
   $message[] = 'name updated successfully';
}
if(!empty($profession)){

   $update_profession = $conn->prepare("UPDATE 'tutors' SET profession = ? WHERE id = ?");
   $update_profession->execute([$profession, $tutor_id]);
   $message[] = 'profession updated successfully';
}
if(!empty($email)){
    $select_tutor_email=$conn->prepare("SELECT*FROM 'tutors' WHERE email=? ");
    $select_tutor_email->execute(['email']);
    if($select_tutor_email->rowCount()>0){
    $message[] ='email already existed';

    }else{

   $update_email = $conn->prepare("UPDATE 'tutors' SET name = ? WHERE id = ?");
   $update_email->execute([$email, $tutor_id]);
   $message[] = 'email updated successfully';

    }
    
   $prev_image =$_FILES['image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, 'FILTER_SANITIZE_STRING');
   $ext = pathinfo($image, 'PATHINFO_EXTENSION');
   $rename = create_unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   
    if(!empty($image)){
    if($image_size >20000){
    $message[] = 'image is too large';


    }else{
      $update_image = $conn->prepare("UPDATE 'tutors' SET image = ? WHERE id = ?");
      $update_image->execute([$image, $tutor_id]);
     
      move_uploaded_file($image_tmp_name,$image_folder);
      if($prev_image !='' AND $prev_image != $rename){
         unlink('../uploaded_files/'.$prev_image);
      } 
      $message[] = 'image updated successfully';

    }
      
   }

}
   $empty_pass ='';
   $prev_pass = $fetch_tutor['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var( $old_pass, 'FILTER_SANITIZE_STRING');
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, 'FILTER_SANITIZE_STRING');

   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, 'FILTER_SANITIZE_STRING');
   if($old_pass != $empty_pass){
      if($old_pass =! $prev_pass){
      $message[] ='old password not matched!';
      }elseif($new_pass =! $c_pass){
      $message[] ='comfirm password not matched';
      }else{
      if($new_pass =! $empty_pass){
         $update_pass = $conn->prepare("UPDATE 'tutors' SET password = ? WHERE id=?");
         $update_pass->execute([$c_pass, $tutor_id]);
         $message[] = 'password updated successfully';
      }else{
         $message[] = 'please your new one';
      }
   }
}


}
   






?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form class="register" action="" method="post" enctype="multipart/form-data">
      <h3>update account</h3>
      <div class="flex">
         <div class="col">
            <p>your name</p>
            <input type="text" name="name" placeholder="<? $fetch_profile['name'] ;?>" maxlength="50" required class="box">
            
            <select name="profession" class="box">
            <option value="<? $fetch_profile['rofession'] ;?>"selected><? $fetch_profile['profession'] ;?></option>
            <option value="journalist"></option>
            <option value="developer">developer</option>
            <option value="designer">designer</option>
            <option value="doctor">doctor</option>
            <option value="biologist">biologist</option>
           </select>
           <p>your email</p>
            <input type="email" placeholder="<? $fetch_profile['email'] ;?>" maxlength="20" required class="box">

         </div>
         <div class="col">
         <p>old password</p>
            <input type="password" name="old_pass" placeholder="enter your old one" maxlength="20" required class="box">
            <p>new password</p>
            <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20" required class="box">
            <p>confirm password</p>
            <input type="password" name="c_pass" placeholder="comfirm password " maxlength="20" required class="box">

         </div>
      </div>
     
      </div>
       <p>select pic <span>*</span></p> 
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" name="submit" value="update new" class="btn">
   </form>

</section>









<!-- update profile section ends -->


<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>






















