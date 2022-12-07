@php use App\Models\User; @endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('admin.home')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{Route::is('admin.home')? 'active':''}}"><a href="{{route('admin.home')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{__('dashboard.dashboard')}}</span></a>
            </li>
            @if(auth()->user()->can('categories') ||auth()->user()->can('roles'))
            <li class=" navigation-header"><span>{{__('dashboard.main settings')}}</span></li>
            @endif
            @can('admins')
                <li class=" nav-item"><a href="#"><i class="fa fa-male fa-2x"></i>  <span class="menu-title" data-i18n="User">{{__('dashboard.admins')}}</span></a>
                    <ul class="menu-content">
                        <li class=""><a href="{{route('admin.admins.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">{{__('dashboard.admins list')}}</span></a>
                        @can('add admin')
                        <li class=""><a href="{{route('admin.admins.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">{{__('dashboard.add admin')}}</span></a>
                            @endcan
                        </li>
                    </ul>
                </li>
            @endcan
            @can('categories')
            <li class=" nav-item"><a href="#"><i class="feather icon-grid"></i><span class="menu-title" data-i18n="User">{{__('dashboard.categories')}}</span></a>
                <ul class="menu-content">
                    @can('categories')
                    <li class="{{Route::is('admin.category.index')? 'active':''}}"><a href="{{route('admin.category.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">{{__('dashboard.category list')}}</span></a>
                    </li>
                    @endcan
                    @can('add category')
                    <li class="{{Route::is('admin.category.create')? 'active':''}}"><a href="{{route('admin.category.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">{{__('dashboard.add category')}}</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('roles')
                <li class=" nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Data List">{{__('dashboard.roles')}}</span></a>
                    <ul class="menu-content">
                        @can('roles')
                        <li class="{{Route::is('admin.roles.index')? 'active':''}}"><a href="{{route('admin.roles.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List View">{{__('dashboard.roles list')}}</span></a>
                        </li>
                        @endcan
                        @can('add role')
                        <li class="{{Route::is('admin.roles.create')? 'active':''}}"><a href="{{route('admin.roles.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Thumb View">{{__('dashboard.add roles')}}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('delivery-types')
                <li class=" nav-item"><a href="#"><i class="feather icon-truck"></i><span class="menu-title" data-i18n="Data List">{{__('dashboard.delivery type')}}</span></a>
                    <ul class="menu-content">
                        @can('delivery-types')
                            <li class="{{Route::is('admin.deliveryTypes.index')? 'active':''}}"><a href="{{route('admin.deliveryTypes.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List View">{{__('dashboard.delivery list')}}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('payment-methods')
                <li class=" nav-item"><a href="#"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Data List">{{__('dashboard.payment_methods')}}</span></a>
                    <ul class="menu-content">
                        @can('payment-methods')
                            <li class="{{Route::is('admin.payment_methods.index')? 'active':''}}"><a href="{{route('admin.payment_methods.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List View">{{__('dashboard.payment_methods')}}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            <li class=" navigation-header"><span></span>
            </li>
            @can('users')
                <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">{{__('dashboard.users')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{Route::is('admin.customers.index')? 'active':''}}"><a href="{{route('admin.customers.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">{{__('dashboard.users list')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('delivery-man')
                <li class=" nav-item"><a href="#"><i class="feather icon-user-check"></i><span class="menu-title" data-i18n="User">{{__('dashboard.deliveryMan')}}</span></a>
                    <ul class="menu-content">
                        <li class=""><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">{{__('dashboard.deliveryMan list')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('vendors')
                <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.vendors')}}</span></a>
                    <ul class="menu-content">
                        @can('vendors')
                            <li class="{{Route::is('admin.vendors.index')? 'active':''}}"><a href="{{route('admin.vendors.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">{{__('dashboard.vendor list')}}</span></a>
                            </li>
                        @endcan
                        @can('add vendor')
                            <li class="{{Route::is('admin.vendors.create')? 'active':''}}"><a href="{{route('admin.vendors.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Details">{{__('dashboard.add vendor')}}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('branches')
                <li class=" nav-item"><a href="#"><i class="feather icon-layout"></i><span class="menu-title" data-i18n="Content">{{__('dashboard.branches')}}</span></a>
                    <ul class="menu-content">
                        @can('branches')
                            <li class="{{Route::is('admin.branches.index')? 'active':''}}"><a href="{{route('admin.branches.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">{{__('dashboard.branches list')}}</span></a>
                            </li>
                        @endcan
                        @can('add branch')
                            <li class="{{Route::is('admin.branches.create')? 'active':''}}"> <a href="{{route('admin.branches.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">{{__('dashboard.add branch')}}</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class=" nav-item"><a href="#"><i class="feather icon-command"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.sub category')}}</span></a>
                <ul class="menu-content">
                    @can('sub-categories')
                        <li class="{{Route::is('admin.subCategories.index')? 'active':''}}"><a href="{{route('admin.subCategories.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">{{__('dashboard.sub category list')}}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-alert-circle"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.sizes')}}</span></a>

                <ul class="menu-content">
                @can('sizes')
                        <li class="{{Route::is('admin.sizes.index')? 'active':''}}"><a href="{{route('admin.sizes.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">{{__('dashboard.sizes list')}}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-briefcase"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.services')}}</span></a>

                <ul class="menu-content">
                @can('services')
                        <li class="{{Route::is('admin.services.index')? 'active':''}}"><a href="{{route('admin.services.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">{{__('dashboard.service list')}}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-clock"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.works time')}}</span></a>
                <ul class="menu-content">
                    @can('works-time')
                        <li class="{{Route::is('admin.worksTime.index')? 'active':''}}"><a href="{{route('admin.worksTime.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">{{__('dashboard.worksTime list')}}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-award"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard.offers')}}</span></a>
                <ul class="menu-content">
                    @can('works-time')
                        <li class="{{Route::is('admin.worksTime.index')? '':''}}"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Wish List">{{__('dashboard.offers list')}}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class=" navigation-header"><span></span>
            </li>
            @can('orders')
                <li class=" nav-item"><a href="#"><i class="feather icon-shopping-bag"></i><span class="menu-title" data-i18n="Content">{{__('dashboard.orders')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{Route::is('admin.orders.index')? 'active':''}}"><a href="{{route('admin.orders.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">{{__('dashboard.orders list')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('bank-accounts')
                <li class=" nav-item"><a href="#"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Content">   {{__('dashboard.bank accounts')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{Route::is('admin.bank.index')? 'active':''}}"><a href="{{route('admin.bank.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">{{__('dashboard.bank accounts')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            @if(auth()->user()->type == User::ADMIN)
                <li class=" nav-item"><a href="#"><i class="feather icon-phone"></i><span class="menu-title" data-i18n="Content">   {{__('dashboard.contact-us')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{Route::is('admin.contact.index')? 'active':''}}"><a href="{{route('admin.contact.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Grid">{{__('dashboard.contact-us list')}}</span></a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
