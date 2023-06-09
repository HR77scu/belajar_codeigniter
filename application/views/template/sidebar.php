		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider ">

			<!-- query -->
			<?php 
				$role_id = $this->session->userdata('role_id');
				$query = "SELECT user_menu.id, menu 
							FROM user_menu JOIN user_access_menu 
							ON user_menu.id = user_access_menu.menu_id 
							WHERE user_access_menu.role_id = $role_id 
							ORDER BY user_access_menu.menu_id ASC";
				$menu = $this->db->query($query)->result_array();
			?>
			<?php foreach($menu as $item) : ?> 
				<div class="sidebar-heading">
					<?= $item['menu']; ?>
				</div>
				<?php 
					$menuId = $item['id'];
					$querySub = "SELECT * FROM user_sub_menu 
					WHERE menu_id = $menuId AND is_active = 1 ORDER BY user_sub_menu.id ASC";
					$subMenu = $this->db->query($querySub)->result_array(); 
				?>
				<?php foreach($subMenu as $subItem): ?>
					<?php if($title == $subItem['title']): ?>
					<li class="nav-item active">
					<?php else: ?>
					<li class="nav-item">
					<?php endif; ?>
						<a href="<?= base_url($subItem['url']); ?>" class="nav-link pb-0">
							<i class="<?= $subItem['icon']; ?>"></i>
							<span><?= $subItem['title'] ?></span>
						</a>
					</li>
				<?php endforeach; ?>
				<hr class="sidebar-divider mt-3	"> 
			<?php endforeach; ?>
			<!-- ./query -->

			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('auth/logout'); ?>">
					<i class="fas fa-fw fa-sign-out-alt"></i>
					<span>Logout</span>
				</a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->