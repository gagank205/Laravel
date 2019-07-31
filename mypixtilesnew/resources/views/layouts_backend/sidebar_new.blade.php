<?php
use App\common_model\User;
$menu=User::GetRoleDetail(Auth::user()->user_role_id,Auth::user()->is_admin);
$route_0=explode('.',Route::currentRouteName());
?>
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item {{Route::currentRouteName()=='dashboard'?'m-menu__item--active':''}}" aria-haspopup="true">
				<a href="{{ROUTE('dashboard')}}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-line-graph"></i>
					<span class="m-menu__link-title"> 
						<span class="m-menu__link-wrap"> 
							<span class="m-menu__link-text">Dashboard</span>
						</span>
					</span>
				</a>
			</li>
			@foreach($menu as $key=>$val)

				@if(($key=='' || is_numeric($key)) )
					@foreach($val as $kk=>$vv)
					@if(isset($vv['module_name']))
					<li class="m-menu__item {{Route::currentRouteName()==strtolower(str_replace(' ','-',$vv['module_name'])).'.index'?'m-menu__item--active':$route_0[0]==strtolower(str_replace(' ','-',$vv['module_name']))?'m-menu__item--active':''}}" aria-haspopup="true">
						<a href="{{url(strtolower(str_replace(' ','-',$vv['module_name'])).'/index')}}" class="m-menu__link ">
							<i class="m-menu__link-icon {{$vv['icon']}}"></i>
							<span class="m-menu__link-title"> 
								<span class="m-menu__link-wrap"> 
									@if($vv['module_name']=='Church' || $vv['module_name']=='User')
									<span class="m-menu__link-text">{{$vv['module_name'].' Management'}}</span>
									@else
									<span class="m-menu__link-text">{{$vv['menu_name']}}</span>
									@endif
									
								</span>
							</span>
						</a>
					</li>
					@endif
					@endforeach
				@else				
	<!-- 			<li class="m-menu__item m-menu__item--submenu {{$menu[$key]['selected']??''}}" aria-haspopup="true" m-menu-submenu-toggle="hover" id="id_{{str_replace(' ','_',$key)}}">
				<a href="javascript:;" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon {{$val[0]['icon']}}"></i>
					<span class="m-menu__link-text">{{$key}}</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						@foreach($val as $k=>$v)
						@if(isset($v['module_name']))						
						<li class="m-menu__item {{Route::currentRouteName()==strtolower($v['module_name']).'.index'?'m-menu__item--active':$route_0[0]==strtolower(str_replace(' ','-',$v['module_name']))?'m-menu__item--active':''}}" aria-haspopup="true" data-open="id_{{str_replace(' ','_',$key)}}">
							<a href="{{url(strtolower($v['module_name']).'/index')}}" class="m-menu__link ">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot"></i>
								@if($v['module_name']=='Userrole')
								<span class="m-menu__link-text">User Role</span>
								@else
								<span class="m-menu__link-text">{{$v['menu_name']}}</span>
								@endif
								<span class="m-menu__link-text"></span>
							</a>
						</li>			
						@endif			
						@endforeach
					</ul>
				</div>
				</li> -->
				@endif
				
			@endforeach
			</li>
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>
<script type="text/javascript">
$(function(){
	//$('#'+$('.m-menu__item--active').data('open')).addClass('m-menu__item--open m-menu__item--expanded');	
});
</script>