<?php require 'header.php';?>
<?php require 'slide.php'; ?>
<div id = "list-user">
	<div class="heading">
		<div class="inline col-2"></div>
		<div class="inline col-3">
			Họ và tên
			<a href="index.php?page=<?php echo $page_current?>&sort=1"><img src="public/images/icon/len.png" width="20px" height="20px"><a>
			<a href="index.php?page=<?php echo $page_current?>&sort=2"><img src="public/images/icon/xuong.png" width="20px" height="20px"><a>
			</div>
		<div class="inline col-4">
			Mô tả bản thân
		</div>
		<div class="inline col-5">
			Tham gia
			<a href="index.php?page=<?php echo $page_current?>&sort=3"><img src="public/images/icon/len.png" width="20px" height="20px"><a>
			<a href="index.php?page=<?php echo $page_current?>&sort=4"><img src="public/images/icon/xuong.png" width="20px" height="20px"><a>
		</div>
	</div>
	<?php foreach ($users as $user) :?>
	<div class="list-row">
		<div class="inline col-2">
			<img src="public/avatar/<?php if(!empty($user['avatar'])) {echo $user['avatar'];}else{echo 'user_accounts.png';}?>" width = "50px" height = "50px">
		</div>
		<div class="inline col-3">
			<a href="index.php?action=detail&id=<?php if(isset($user['id'])) echo $user['id']?>">
				<?php if(isset($user['username'])) echo $user['fullname']?>
			</a>
		</div>
		<div class="inline col-4 description">
			<?php if(isset($user['description'])) echo $user['description']?>
		</div>
		<div class="inline col-5"><?php echo date("H:m:s d-m-Y", strtotime($user['create_at']))?></div>
		<?php if(isset($_SESSION['user'])):?>
		<?php if($_SESSION['user']['level'] > $user['level'] || $_SESSION['user']['id'] == $user['id'] && $_SESSION['user']['level'] > 1):?>
		<div class="inline col-6">
			<a href="index.php?action=edit&id=<?php echo $user['id']?>">
			<img src="public/images/icon/edit.png" width="20px" height="20px"></a>
		</div>
		<?php if($_SESSION['user']['level'] > $user['level']): ?>
		<div class="inline col-7">
			<a href="index.php?action=delete&id=<?php echo $user['id']?>" onclick="return confirm('Bạn có chắc chắn xóa?')">
			<img src="public/images/icon/delete1.png" width="20px" height="20px"></a>
		</div>
		<?php endif;?>
		<?php endif;?>
		<?php endif;?>
	</div>
	<?php endforeach;?>
	<div class="list-footer">
		<div class="inline">
			<form action="" method="post">
				<select name="limit" class="select" style="width: 60px; height: 50px; background: #7fffd4;">
					<option value="10" <?php if($_SESSION['limit'] == 10) echo 'selected'?>>10</option>
					<option value="20" <?php if($_SESSION['limit'] == 20) echo 'selected'?>>20</option>
					<option value="50" <?php if($_SESSION['limit'] == 50) echo 'selected'?>>50</option>
					<option value="100" <?php if($_SESSION['limit'] == 100) echo 'selected'?>>100</option>
				</select>
				<button type="submit" class="button" style="width: 70px; height: 50px; background: #889959;" name="select">Chọn</button>
			</form>
		</div>
		<div class="inline"><?php echo $pagination['html'];?></div>
	</div>
	
</div>
<?php require 'footer.php'; ?>