<?php require 'header.php';?>
<?php require 'banner.php'; ?>
<div id = "detail">
	<div class="info1">
		<div class="avatar">
			<img src="public/avatar/<?php if(!empty($user['avatar'])) {echo $user['avatar'];}else{echo 'user_accounts.png';}?>" width = "100px" height = "100px">	
		</div>
		<div class="fullname">
			<?php echo $user['fullname']?>
		</div>
	</div>
	<hr>
	<?php if(isset($_SESSION['user']['is_logged'])):?>
	<?php if($_SESSION['user']['is_logged'] == true):?>
	<div>
		<div class="inline col-1">Ngày tham gia</div>
		<div class="inline col-2"><?php echo date("H:m:s d-m-Y", strtotime($user['create_at']))?></div>
	</div>
	<div>
		<div class="inline col-1">Tên đăng nhập</div>
		<div class="inline col-2"><?php echo $user['username']?></div>
	</div>
	<div>
		<div class="inline col-1">Email</div>
		<div class="inline col-2"><?php echo $user['email']?></div>
	</div>
	<div>
		<div class="inline col-1">Số điện thoại</div>
		<div class="inline col-2"><?php echo $user['phone']?></div>
	</div>
	<div>
		<div class="inline col-1">Giới tính</div>
		<div class="inline col-2">
			<?php 
				if($user['gender'] == 1){
					echo "Nữ";
				}elseif ($user['gender'] == 2) {
					echo "Nam";
				}else{
					echo "None";
				}
			?>
		</div>
	</div>
	<div>
		<div class="inline col-1">Ngày sinh</div>
		<div class="inline col-2"><?php echo date("d-m-Y", strtotime($user['birthday']))?></div>
	</div>
	<div>
		<div class="inline col-1">Mô tả bản thân</div>
		<div class="inline col-2"><?php echo $user['description']?></div>
	</div>
	<div>
		<div class="inline col-1">Đã giới thiệu  </div>
		<div class="inline col-2">
			<?php 
			foreach ($user_introduced as $value) {
				echo $value['username'].'  ';
			}
			?>
		</div>
	</div>
	<?php if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id']):?>
		<hr>
	<div style="margin-left: 500px;">
		<div class="inline"><a href="index.php?action=change&id=<?php echo $user['id']?>"><button class="button">Đổi mật khẩu</button></a></div>
		<div class="inline"><a href="index.php?action=edit&id=<?php echo $user['id']?>"><button class="button">Chỉnh sửa</button></a></div>
	</div>
<?php endif;?>
<?php endif;?>
<?php else:?>
	<div id="view">
		<div>Để xem chi tiết</div>
		<div>
			<a href="login.php"><button class="button">Đăng nhập</button></a>
		</div>
		
	</div>
<?php endif;?>
</div>
<?php require 'footer.php'; ?>