<?php require 'header.php';?>
<?php require 'banner.php'; ?>
<div class="register-page">
	<h1>Đăng ký tài khoản mới</h1>
	  <div class="">
	   		
			    <form class="register-form" method="post" action="" enctype="multipart/form-data">
			    		<table>
			    		<?php if(isset($error['common'])):?>
	  			<b style="color: red; text-align: center;"><?php echo $error['common']?></b>
	  		<?php endif;?>
			    			<tr>
			    				<td>Tên đăng nhập*</td>
			    				<td>
			    					<input type="text" value="<?php if(isset($username)) echo $username;?>" name="username" placeholder="Nhập tên đăng nhập" class="input" />
			    					<?php if(isset($error['username'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['username']?></p>
						  		<?php endif;?>
			    				</td>
			    				<td class="register-3">Họ và tên*</td>
			    				<td>
			    				<input type="text" name="fullname" value="<?php if(isset($fullname)) echo $fullname;?>" placeholder="Nhập họ và tên đầy đủ" class="input"/>
			    				<?php if(isset($error['fullname'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['fullname']?></p>
						  		<?php endif;?>
			    				</td>
			    			</tr>
			    			<tr>
			    				<td>Email*</td>
			    				<td>
			    				<input type="text" name="email" value="<?php if(isset($email)) echo $email;?>" placeholder="Nhập email" class="input" />
			    				<?php if(isset($error['email'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['email']?></p>
						  		<?php endif;?>
			    				</td>
			    				<td class="register-3">Số điện thoại*</td>
			    				<td>
			    				<input type="text" name="phone" value="<?php if(isset($phone)) echo $phone;?>" placeholder="Nhập số điện thoại" class="input" />
			    				<?php if(isset($error['phone'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['phone']?></p>
						  		<?php endif;?>
			    				</td>
			    			</tr>
			    			<tr>
			    				<td>Mật khẩu*</td>
			    				<td>
			    				<input type="password" name="password" value="<?php if(isset($password)) echo $password;?>" placeholder="Nhập mật khẩu" class="input"/>
			    				<?php if(isset($error['password'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['password']?></p>
						  		<?php endif;?>
			    				</td>
			    				<td class="register-3">Ảnh đại diện</td>
			    				<td>
			    					<input type="file" name="avatar" placeholder="name" class="input"/>
			    					<?php if(isset($error['file'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['file']?></p>
						  		<?php endif;?>
			    				</td>
			    			</tr>
			    			<tr>
			    				<td>Nhập lại mật khẩu*</td>
			    				<td>
			    				<input type="password" name="repassword" value="<?php if(isset($repassword)) echo $repassword;?>" placeholder="Nhập lại mật khẩu" class="input"/>
			    				<?php if(isset($error['repassword'])):?>
						  			<p style="color: red; text-align: center;"><?php echo $error['repassword']?></p>
						  		<?php endif;?>
			    				</td>
			    				<td rowspan="2" class="register-3">Người giới thiệu</td>
			    				<td><input type="text" name="presenter" value="<?php if(isset($presenter)) echo $presenter;?>" placeholder="username hoặc email" class="input"/></td>
			    			</tr>
			    		</table>
			    		<div style="width: 200px; margin: auto">
			    			<button type="submit" name = "register" class="button">Tạo tài khoản</button>
				      		<p class="message">Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>	
			    		</div>
				      
			    </form>
	  </div>
</div>
<?php require 'footer.php'; ?>