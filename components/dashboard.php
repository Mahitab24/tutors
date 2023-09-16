<?php

include 'connect.php';

if(isset($_COOKIE['tutor_id'])){
$tutor_id =$_COOKIE['tutor_id'];

}else{
$tutor_id = '';

}
$count_content = $conn->prepare("SELECT * FROM 'content' WHERE tutor_id = ?");
$count_content->execute([$tutor_id]);
$total_contents = $count_content->rowCount();

$count_playlist = $conn->prepare("SELECT * FROM 'playlist' WHERE tutor_id = ?");
$count_playlist->execute([$tutor_id]);
$total_playlists = $count_playlist->rowCount();

$count_likes = $conn->prepare("SELECT * FROM 'likes' WHERE tutor_id = ?");
$count_likes->execute([$tutor_id]);
$total_likes = $count_playlist->rowCount();

$count_comment = $conn->prepare("SELECT * FROM 'comment' WHERE tutor_id = ?");
$count_comment->execute([$tutor_id]);
$total_comments = $count_comment->rowCount();

?>





<!DOCTYPE html>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>Dashboard</title>
</head>
<body>
<section class="dashboard-sec">
<h1 class="headline">dashboard</h1>
<div class="container">
<div class="box">
<h3>Hello</h3>
<p><?= $fetch_profile['name'];?></p>
<a href="admin/profile.php" class="btn">view profile</a>
</div>
<div class="box">
<h3><?= $total_contents;?></h3>
<p>contents uploaded</p>
<a href="admin/add_content.php" class="btn">add new content</a>
</div>
<div class="box">
<h3><?= $total_playlists;?></h3>
<p>playlists uploaded</p>
<a href="admin/add_playlist.php" class="btn">add new playlist</a>
</div>
<div class="box">
<h3><?= $total_likes;?></h3>
<p>total likes</p>
<a href="admin/contents.php" class="btn">view contents</a>
</div>
<div class="box">
<h3><?= $total_comments;?></h3>
<p>total comment</p>
<a href="admin/comments.php" class="btn">view comment</a>
</div>
</div>




</section>




<?php include('../components/admin_header.php');?>


<?php include('../components/footer.php');?>
<script src="../js/admin_script.js"></script>
</body>
</html>