<?php

if (! function_exists('active_route')) {
    /**
     * Return the "active" class if current route is matched.
     *
     * @param  string|array $route
     * @param  string $output
     * @return string|null
     */
    function active_route($route)
    {
        $output = 'active';
        if ($route == 1) {
            $route = [
//                'backend.district.index','backend.district.show',
//                'backend.district.create','backend.district.edit',
//                'backend.cinema.index','backend.cinema.show',
//                'backend.cinema.create','backend.cinema.edit',
            ];
        }

        if ($route == 2) {
            $route = [
                'backend.page.index','backend.page.show',
                'backend.page.create','backend.page.edit',
            ];
        }

        if ($route == 3) {
            $route = [
                'backend.linhvuc.index','backend.linhvuc.show',
                'backend.linhvuc.create','backend.linhvuc.edit',

                'backend.hoatdong.index','backend.hoatdong.show',
                'backend.hoatdong.create','backend.hoatdong.edit',
            ];
        }

        if ($route == 4) {
            $route = [
                'backend.room.index','backend.room.show',
                'backend.room.create','backend.room.edit',

                'backend.category.index','backend.category.show',
                'backend.category.create','backend.category.edit',

                'backend.product.index','backend.product.show',
                'backend.product.create','backend.product.edit',

                'backend.dashboard'
            ];
        }

        if ($route == 5) {
            $route = [
                'backend.user.index','backend.user.show',
                'backend.user.create','backend.user.edit',

                'backend.slide.index','backend.slide.show',
                'backend.slide.create','backend.slide.edit',

                'backend.lienhe.index','backend.lienhe.show',
                'backend.lienhe.create','backend.lienhe.edit',

            ];
        }

        if (is_array($route)) {
            if (call_user_func_array('Route::is', $route)) {
                return $output;
            }
        } else {
            if (\Route::is($route)) {
                return $output;
            }
        }
        return '';
    }
}

?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset("/images/spicemart-icon.png")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Auth::guard('web')->user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

        <!-- User management data -->
        <li class="treeview {{ active_route(4) }}">
            <a href="#">
                <i class="glyphicon glyphicon-briefcase"></i>
                <span>Quản lý sản phẩm</span>
                <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.room.*') }}"><a href="{{ route('backend.room.index') }}">»  Phòng</a></li>
                <li class="{{ active_route('backend.category.*') }}"><a href="{{ route('backend.category.index') }}">» Loại sản phẩm </a></li>
                <li class="{{ active_route('backend.product.*') }} {{ active_route('backend.dashboard') }}"><a href="{{ route('backend.product.index') }}">» Sản phẩm </a></li>
            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(3) }}">
            <a href="#">
                <i class="glyphicon glyphicon-calendar"></i>
                <span>QL lĩnh vực hoạt động</span>
                <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.linhvuc.*') }}"><a href="{{ route('backend.linhvuc.index') }}">» Lĩnh vực hđ</a></li>
                <li class="{{ active_route('backend.hoatdong.*') }}"><a href="{{ route('backend.hoatdong.index') }}">» Hoạt động </a></li>
            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(2) }}">
            <a href="#">
                <i class="glyphicon glyphicon-list"></i>
                <span>Quản lý các trang</span>
                <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
</span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.page.*') }}"><a href="{{ route('backend.page.index') }}">» Pages</a></li>
            </ul>
        </li>
        <!-- End User management data -->

        <!-- User management data -->
        <li class="treeview {{ active_route(5) }}">
            <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>Quản lý chung</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_route('backend.slide.*') }}"><a href="{{ route('backend.slide.index') }}">» Slide trang chủ</a></li>
                <li class="{{ active_route('backend.user.*') }}"><a href="{{ route('backend.user.index') }}">» Admins </a></li>
                <li class="{{ active_route('backend.lienhe.*') }}"><a href="{{ route('backend.lienhe.index') }}">» Liên hệ </a></li>
            </ul>
        </li>
        <!-- End User management data -->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
