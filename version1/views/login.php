<?php require 'header.php';?>
<?php require 'banner.php'; ?>
<div class="login-page">
	<h1>Đăng nhập để sử dụng </h1>
	  <div class="form">
		    <form id = "form-login" method="post" action="">
		    <?php if($status_login):?>
		    <?php if(isset($error)):?>
	  			<b style="color: red; text-align: center;"><?php echo $error?></b>
	  		<?php endif;?>
			      <input type="text" name = "email-username" value="<?php if(isset($email_username)) echo $email_username;?>"  placeholder="Email" class="input"/>
			      <input type="password" name = "password" value="<?php if(isset($password)) echo $password;?>"  placeholder="password" class="input"/>
			      <button type="submit" name = "login" class="button">Đăng nhập</button>
			      <p class="message">Bạn chưa có tài khoản ? <a href="register.php">Tạo tài khoản</a></p>
			      <?php else:?>
			      	<b style="color: red; text-align: center;">
			      	Bạn đã đăng nhập sai quá 3 lần<br> 
			      	Đăng nhập bị khóa <br> 
			      	Vui lòng đăng nhập lại sau 2 tiếng nữa !
			      	</b>
			      <?php endif;?>
		    </form>
		    
		     <!-- <button type="submit" name = "login" form = "form-login">Đăng nhập</button> -->
	  </div>
</div>
<?php require 'footer.php'; ?>

</script>