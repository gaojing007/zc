<header>
	<div id="header">
		<div id="head">
			<div class="head_top">
				<div class="t_logo">
					<a href="<?php echo Zc::url(RouteConst::productHomeIndex);?>" class="logo">Zc PetStore</a>
					<div class="head_right">
						<?php if ($isLogin) { ?>
							你好，<?php echo $userName; ?>
						<?php } else { ?>
							<a href="<?php echo Zc::url(RouteConst::userLoginIndex);?>">登录</a>
						<?php }?>
						<a href="<?php echo Zc::url(RouteConst::userLoginDoLogout);?>">退出</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>