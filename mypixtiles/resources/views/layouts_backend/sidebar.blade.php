<?php
use App\common_model\User;
// dd(User::GetRoleDetail(Auth::user()->user_role_id));
?>
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
				<a href="{{ROUTE('dashboard')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-line-graph"></i>
					<span class="m-menu__link-title"> 
						<span class="m-menu__link-wrap"> 
							<span class="m-menu__link-text">Dashboard</span>
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">Components</h4>
				<i class="m-menu__section-icon"></i>
			</li>

			<li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-location"></i>
					<span class="m-menu__link-text">Location Managment</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu "><span class="m-menu__arrow"></span> 
					<ul class="m-menu__subnav">
						<li class="m-menu__item  {{Route::currentRouteName()=='country.index'?'m-menu__item--active':''}}" aria-haspopup="true">
							<a href="{{url('country/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								<span class="m-menu__link-text">Country</span>
							</a>
						</li>
						<li class="m-menu__item  {{Route::currentRouteName()=='state.index'?'m-menu__item--active':''}}" aria-haspopup="true">
							<a href="{{url('state/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								<span class="m-menu__link-text">State</span>
							</a>
						</li>
						<li class="m-menu__item  {{Route::currentRouteName()=='city.index'?'m-menu__item--active':''}}" aria-haspopup="true">
							<a href="{{url('city/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								<span class="m-menu__link-text">City</span>
							</a>
						</li>
					</ul>									
				</div>
			</li>
			<li class="m-menu__item m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true" m-menu-submenu-toggle="hover">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-network"></i>
					<span class="m-menu__link-text">Role Managment</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span> 
					<ul class="m-menu__subnav">
						<li class="m-menu__item  {{Route::currentRouteName()=='module.index'?'m-menu__item--active':''}}" aria-haspopup="true">
							<a href="{{url('module/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								<span class="m-menu__link-text">Module</span>
							</a>
						</li>
						<li class="m-menu__item {{Route::currentRouteName()=='role.index'?'m-menu__item--active':''}}" aria-haspopup="true">
							<a href="{{url('userrole/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								<span class="m-menu__link-text">User Role</span>
							</a>
						</li>
					</ul>
				</div>
			</li>			
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>