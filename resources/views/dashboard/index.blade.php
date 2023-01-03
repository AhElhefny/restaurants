@php use Illuminate\Support\Facades\App; @endphp
<x-dashboard.layouts.master title="{{__('dashboard.dashboard')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row">
                        <x-dashboard.home.welcome />
                        <x-dashboard.home.usersGain :users="$users" />
                        <x-dashboard.home.orderRecived :orders="$orders"  />
                        @if(auth()->user()->type == \App\Models\User::ADMIN)
                        <x-dashboard.home.countable slug="{{__('dashboard.categories')}}" color="danger"  :count="\App\Models\Category::count()" />
                        <x-dashboard.home.countable slug="{{__('dashboard.vendors')}}" color="secondary" :count="\App\Models\Vendor::count()" />
                        <x-dashboard.home.countable slug="{{__('dashboard.branches')}}" color="success" :count="\App\Models\Branch::count()" />
                        <x-dashboard.home.countable slug="{{__('dashboard.deliveryMan')}}" color="black" :count="\App\Models\DeliveryMan::count()"  />
                        @endif
                    </div>

                    <div class="row match-height">
                        <x-dashboard.home.ordersRadialChart :orderDetail="$orderDetail"/>
                        <x-dashboard.home.offers />
                        <x-dashboard.home.activityTimeLine />

                    </div>

                    <x-dashboard.home.ordersList :orders="$orders"/>

                </section>
                <!-- Dashboard Analytics end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <x-dashboard.home.chartJs
        :usersCountLatestFourMonth="$usersCountLatestFourMonth"
        :ordersCountLatestSevenDays="$ordersCountLatestSevenDays"
        :orderDetail="$orderDetail"
    />
</x-dashboard.layouts.master>
