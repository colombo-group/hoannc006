<?php require 'header.php';?>
<?php require 'banner.php'; ?>
<div class="changePass">
	<h1>Đổi mật khẩu </h1>
	  <div class="form">
	  <?php if($status == false):?>
		    <form method="post" action="">
		   <?php if(isset($error['common'])):?>
	  			<b style="color: red; text-align: center;"><?php echo $error['common']?></b>
	  		<?php endif;?>
		   
	  			<p style="text-align: left;"> Mật khẩu cũ</p>
			      <input type="password" name = "oldPass" value="<?php if(isset($oldPass)) echo $oldPass;?>"  placeholder="Mật khẩu cũ" class="input"/>
			       <?php if(isset($error['oldPass'])):?>
	  			<b style="color: red; text-align: center;"><?php echo $error['oldPass']?></b>
	  		<?php endif;?>
			      <p style="text-align: left;">Mật khẩu mới</p>
			      <input type="password" name = "newPass" value="<?php if(isset($newPass)) echo $newPass;?>"  placeholder="Mật khẩu mới" class="input"/>
			       <?php if(isset($error['newPass'])):?>
	  			<b style="color: red; text-align: center;"><?php echo $error['newPass']?></b>
	  		<?php endif;?>
			      <p style="text-align: left;">Xác nhận mật khẩu</p>
			      <input type="password" name = "rePass" value="<?php if(isset($rePass)) echo $rePass;?>"  placeholder="Xác nhận mật khẩu mới" class="input"/>
			      <button type="submit" name = "change" class="button">Thay đổi</button>
		    </form>
		   
		    	<?php else:?>
		    		<p style="color: green">Thay đổi mật khẩu thành công</p>
		    		<a href="index.php">
		    			<button class="button">Quay lại trang chủ</button>
		    		</a>
		    <?php endif;?>
		     <!-- <button type="submit" name = "login" form = "form-login">Đăng nhập</button> -->
	  </div>
</div>
<?php require 'footer.php'; ?>

</script>