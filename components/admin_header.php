<?php
if(isset($message)){
foreach($message as $message){
echo 'div class="message">
<span>'.$message.'</span>
<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
</div>';
}

}


?>
<
<header class="header">
<section class="header-flex">
<a href="dashboard.php" class="logo">educate_more</a>

<form action="search.php" method="post" class="search">
 <input type="text" placeholder="search here...." required name="search_box" >
<button type="submit" class="fa-sharp fa-solid fa-magnifying-glass" name="search_btn">


</button>
</form>
<div class="icon">
<div id="menu-btn" class="fas fa-bar"></div>
<div id="search-btn" class="fas fa-search"></div>
<div id="user-btn" class="fas fa-user"></div>
<div id="toggle-btn" class="fas fa-sun"></div>
</div>

<div class="profile">

<?php
$select_profile = $conn->prepare("SELECT * from'tutors' WHERE id = ?");
$select_profile-> execute([$user_id]);
if($select_profile->rowCount() > 0){
$fetch_profile= $select_profile-> fetch (PDO::FETCH_ASSOC);



?>
<img src="../uploaded_files/<?= $fetch_profile ['image'];?>" alt="" >
<h3><?= $fetch_profile['name']; ?></h3>
<span><?= $fetch_profile['profeesion']; ?></span>
<a href="profile.php" class="btn">show profile</a>
<div class="flex-btn">
<a href="login.php" class="option-btn">login</a>
<a href="register.php" class="option-btn">register</a>
</div>

<a href="../components/admin_logout.php" onclick="return confirm ('logout from this website');" class="delete-btn">logout</a>

 <?php
}else{
?>
<h3>please login or register</h3>
<div class="flex-btn">
<a href="login.php" class="option-btn">login</a>
<a href="register.php" class="option-btn">register</a>
</div>
<?php
}
?>
</div>



</section>




</header>

<!---side bar begins here--->
<div class="sidebar">

<div id="close">
    <i class="fas fa-times"></i>
</div>
<div class="profile">
<?php
$select_profile = $conn->prepare("SELECT * from'tutors' WHERE id = ?");
$select_profile-> execute([$user_id]);
if($select_profile->rowCount() > 0){
$fetch_profile= $select_profile-> fetch (PDO::FETCH_ASSOC);



?>
<img src="../uploaded_files/<?= $fetch_profile ['image'];?>" alt="" >
<h3><?= $fetch_profile['name']; ?></h3>
<span><?= $fetch_profile['profeesion']; ?></span>
<a href="profile.php" class="btn">show profile</a>
<div class="flex-btn">
<a href="login.php" class="option-btn">login</a>
<a href="register.php" class="option-btn">register</a>
</div>

<a href="../components/admin_logout.php" onclick="return confirm ('logout from this website');" class="delete-btn">logout</a>

 <?php
}else{
?>
<h3>please login or register</h3>
<div class="flex-btn">
<a href="login.php" class="option-btn">login</a>
<a href="register.php" class="option-btn">register</a>
</div>

<?php
}
?>
</div>
<nav class="navbar">
<a href="dashboard.php"><i class="fas fa-home"></i><span>home</span></a>
<a href="playlists.php"><i class="fas fa-bars"></i><span>playlists</span></a>
<a href="contents.php"><i class="fas fa-graduation-cap"></i><span>contents</span></a>
<a href="comments.php"><i class="fas fa-comment"></i><span>comments</span></a>
<a href="../components/admin_logout.php" onclick="return confirm ('logout from this website');" class="delete-btn">
<i class="fas fa-right-from-bracket"></i><span>logout</span></a>


</nav>












</div>









<!---side bar ends here--->

























