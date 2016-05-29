<?php require 'header.php';?>
<?php require 'banner.php'; ?>
<div id ="edit-user">
	<h1>Chỉnh sửa thông tin cá nhân</h1>
	  <div class="">
	   		
			    <form class="register-form" method="post" action="" enctype="multipart/form-data">
			    <?php if(isset($error['common'])):?>
	  			<b style="color: red; text-align: center;"><?php echo $error['common']?></b>
	  			<?php endif;?>
					    <div class="info1">
							<div class="avatar">
								<img src="public/avatar/<?php if(!empty($user['avatar'])) {echo $user['avatar'];}else{echo 'user_accounts.png';}?>" width = "100px" height = "100px">	
							</div>

							<div class="fullname" style="padding-top: 30px; padding-bottom: 30px;">
								<input type="file" name="avatar"></input>
							</div>
						</div>
						<hr>
			    			<div>
			    				<div class = "inline col-1">Tên đăng nhập*</div>
			    				<div class = "inline col-2">
			    					<input type="text" name="username" value="<?php if(isset($user['username'])){echo $user['username'];} ?>" placeholder="Nhập tên đăng nhập" class="input" />
			    					<?php if(isset($error['username'])):?>
						  			<b style="color: red; text-align: center;"><?php echo $error['username']?></b>
						  		<?php endif;?>
			    				</div>
			    				<div class="inline col-3">Họ và tên*</div>
			    				<div class = "inline col-4">
			    				<input type="text" name="fullname" value="<?php if(isset($user['fullname'])){echo $user['fullname'];} ?>" placeholder="Nhập họ và tên đầy đủ" class="input"/>
			    				<?php if(isset($error['fullname'])):?>
						  			<b style="color: red; text-align: center;"><?php echo $error['fullname']?></b>
						  		<?php endif;?>
			    				</div>
			    			</div>
			    			<div>
			    				<div class = "inline col-1">Email*</div>
			    				<div class = "inline col-2">
			    				<input type="text" name="email" value="<?php if(isset($user['email'])){echo $user['email'];} ?>" placeholder="Nhập email" class="input" />
			    				<?php if(isset($error['email'])):?>
						  			<b style="color: red; text-align: center;"><?php echo $error['email']?></b>
						  		<?php endif;?>
			    				</div>
			    				<div class = "inline col-3">Ngày sinh*</div>
			    				<div class = "inline col-4">
			    					<select class="date" name="day">
			    						<option>Ngày</option>
			    						<?php 
			    							$day = date("d", strtotime($user['birthday']));
			    							for($i = 1; $i<32; $i++){
			    								if($i == $day){
			    									echo '<option value = "'.$i.'" selected>'.$i.'</option>';	
			    								}
			    								echo '<option value = "'.$i.'">'.$i.'</option>';
			    							}
			    						?>
			    					</select>
			    					<select class="date" name="month">
			    						<option>Tháng</option>
			    						<?php 
			    							$month = date("m", strtotime($user['birthday']));
			    							for($i = 1; $i<13; $i++){
			    								if($i == $month){
			    									echo '<option value = "'.$i.'" selected>'.$i.'</option>';	
			    								}
			    								echo '<option value = "'.$i.'">'.$i.'</option>';
			    							}
			    						?>
			    					</select>
			    					<select class="date" name="year">
			    						<option>Năm</option>
			    						<?php 
			    							$year = date("Y", strtotime($user['birthday']));

			    							for($i = 1950; $i<2017; $i++){
			    								if($i == $year){
			    									echo '<option value = "'.$i.'" selected>'.$i.'</option>';	
			    								}
			    								echo '<option value = "'.$i.'">'.$i.'</option>';
			    							}
			    						?>
			    					</select>
			    					<?php if(isset($error['birthday'])):?>
						  			<b style="color: red; text-align: center;"><?php echo $error['birthday']?></b>
						  		<?php endif;?>
			    					</div>
			    			</div>
			    			<div>
			    				<div class="inline col-1">Số điện thoại*</div>
			    				<div class = "inline col-2">
			    					<input type="text" name="phone" value="<?php if(isset($user['phone'])){echo $user['phone'];} ?>" placeholder="Nhập số điện thoại" class="input" />
			    					<?php if(isset($error['phone'])):?>
						  			<b style="color: red; text-align: center;"><?php echo $error['phone']?></b>
						  		<?php endif;?>
			    				</div>
			    				<div class = "inline col-3">Giới tính*</div>
			    				<div class = "inline col-4">
			    					<select name="gender" class="select">
			    						<option value="0" <?php if(empty($user['gender'])) echo 'selected';?>>None</option>
			    						<option value="1" <?php if($user['gender'] == 1) echo 'selected';?>>Nữ</option>
			    						<option value="2" <?php if($user['gender'] == 2) echo 'selected';?>>Nam</option>
			    					</select>
			    				</div>
			    			</div>
			    			<div>
			    				
			    				<div class = "inline col-1 description">Mô tả*</div>
			    				<div class = "inline">
				    				<textarea type="text" name="description" placeholder="Giới thiệu về bản thân" rows="6" class="input">
				    					<?php if(isset($user['description'])){echo $user['description'];} ?>
				    				</textarea>
			    				</div>
			    			</div>
			    			<?php if(isset($_SESSION['user'])):?>
			    			<?php if($_SESSION['user']['level'] == 3 && $user['id'] != $_SESSION['user']['id']):?>
			    			<div>
			    				<div class = "inline col-1">Phân quyền</div>
			    				<div class = "inline">
			    					<select name="level" class="select">
			    						<option value="1" <?php if($user['level'] == 1) echo 'selected';?>>user</option>
			    						<option value="2" <?php if($user['level'] == 2) echo 'selected';?>>admod</option>
			    					</select>
			    				</div>
			    			</div>
			    		<?php endif;?>
			    		<?php endif;?>
			    		<hr>
			    		<br>
				      <button type="submit" name = "edit" class="button" style="width: 200px; margin-left: 400px;">Chỉnh sửa</button>
			    </form>
	  </div>
</div>
<?php require 'footer.php'; ?>