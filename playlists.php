<?php

include 'connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete_id'])){
  $delete_id = $_POST['delete_id'];
  $delete_id = filter_var($delete_id,'FILTER_SANITIZE_STRING');
  $verify_playlist = $conn->prepare("SELECT* FROM 'playlist' WHERE id =? ");
  $verify_playlist->execute([$delete_id]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlists</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlists">

   <h1 class="heading">all playlists</h1>


<div class="box-container">
<?php
$select_playlist = $conn->prepare("SELECT*FROM 'playlist'WHERE tutor_id=?" );
$select_playlist->execute([$tutor_id]);
if($select_playlist->rowCount() > 0){
while ($fetch_playlist= $select_playlist-> fetch (PDO::FETCH_ASSOC)) {

   $playlist_id=$fetch_playlist['id'];

   $count_content = $conn->prepare("SELECT * FROM 'content' WHERE playlist_id = ?");
   $count_content->execute([$playlist_id]);
   $total_contents = $count_content->rowCount();

?>
<div class="box" style="text-align: center;" >

   <h3 class="title"style="margin-bottom: .5rem;">create new playlist</h3>
  <a href="admin/add_playlist.php" class="btn">add playlist</a>

<div class="flex">
<div><i class="fas fa-dots" style="color:<?php if ($fetch_playlist['status']=='active') {
echo 'green';}else{echo 'red';};?>"></i><span style="color:<?php if ($fetch_playlist['status']=='active') {echo 'green';}else{echo 'red';};?>"><?= $fetch_playlist['status'];?></span></div>
<div><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date'];?></span></div>
</div>
<div class="thumb">
<span><?= $total_contents;?></span>
<img src=".../uploaded_files/<?= $fetch_playlist['thumb'];?>" alt="">
</div>
<h3 class="title"><?= $fetch_playlist['title'];?></h3>
<p class="description"><?= $fetch_playlist['description'];?></p>
<form action="" method="post"class="flex-btn">
<input type="hidden" name="delete_id" value="<?= $playlist_id;?>">

<a href="admin/add_playlist.php?get_id=" class="option-btn">update</a>
<input type="submit" value="delete" name="delete_playlist"class="delete-btn">
</form>
<a href="admin/view_playlist.php" class="btn">view playlist</a>




</div>


<?php


  }
}else{

   echo'<p class="empty">playlist not existed yet!</p>';
}

?>

</div>
  



<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
 let description = document.querySelectorAll('.description');
description.forEach(content=>{
if(content.innerHTML.length >100) content.innerHTML = content.innerHTML.slice(0,100);

})

</script>

</body>
</html>