@php use App\Models\DeliveryMan; @endphp
<x-dashboard.layouts.master title="{{__('dashboard.delivery man details')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.delivery man details')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.deliveryMen.index')}}">{{__('dashboard.deliveryMan list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{__('dashboard.account')}}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="{{$man->image}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table name')}}</td>
                                                    <td>{{$man->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table phone')}}</td>
                                                    <td>{{$man->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.identity')}}</td>
                                                    <td>{{$man->deliveryMan->identity}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table status')}}</td>
                                                    <td>{{DeliveryMan::getStatus($man->deliveryMan->account_status)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.type')}}</td>
                                                    <td>{{$man->deliveryMan->type}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.company')}}</td>
                                                    <td>{{$man->deliveryMan->type == 'personal'?'-':$man->deliveryMan->company->name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--////////////////////////////////////////////////// --}}

                        {{-- <!-- static data -->--}}
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">{{__('dashboard.bank accounts')}}</div>
                                </div>
                                <div class="card-body">
                                    <table class="overflow-auto table table-hover-animation text-center">
                                        <thead>
                                        <tr>
                                            <th>{{__('dashboard.name on card')}}</th>
                                            <th>{{__('dashboard.IBAN')}}</th>
                                            <th>{{__('dashboard.bank account')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($man->bank_accounts as $account)
                                            <tr>
                                                <td>{{$account->name_on_card}}</td>
                                                <td>{{$account->IBAN}}</td>
                                                <td>{{$account->account_number}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <!-- information start -->--}}

                        {{-- <!-- permissions start -->--}}

                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>{{__('dashboard.orders')}}
                                    </h6>
                                </div>
                                <div class="card-body px-75">
                                    <div class="table-responsive users-view-permission overflow-auto text-center">
                                        <table class="table table-borderless">
                                            <thead>
                                            <tr>
                                                <th>{{__('dashboard.order_number')}}</th>
                                                <th>{{__('dashboard.branch')}}</th>
                                                <th>{{__('dashboard.payment method')}}</th>
                                                <th>{{__('dashboard.order status')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($man->orders as $order)
                                                    <tr>
                                                        <td>{{$order->order_number}}</td>
                                                        <td>{{$order->branch->name}}</td>
                                                        <td>{{$order->paymentMethod->method_en}}</td>
                                                        <td>{{$order->orderStatus->name_en}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- permissions end -->
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
</x-dashboard.layouts.master>
