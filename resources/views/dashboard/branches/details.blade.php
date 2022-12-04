<x-dashboard.layouts.master title="{{__('dashboard.show branch')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.show branch')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.branches.index')}}">{{__('dashboard.branches list')}}</a></li>
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
                                            <img src="{{$branch->image}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table class="mb-2">
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table name')}}</td>
                                                    <td>{{$branch->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.vendors')}}</td>
                                                    <td>{{$branch->vendor->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.services count')}}</td>
                                                    <td>{{$branch->services()->wherePivot('available',1)->count()}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table status')}}</td>
                                                    <td>{{ $branch->active == 1 ? 'Active' : 'Disabled'}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table create date')}}</td>
                                                    <td>{{$branch->created_at}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.orders count')}}</td>
                                                    <td>{{$branch->orders->count()}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        @can('edit branch')
                                            <div class="col-12">
                                                <a href="{{route('admin.branches.edit',$branch->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> {{__('dashboard.edit')}}</a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--////////////////////////////////////////////////// --}}


                        <div class="col-6">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>{{__('dashboard.service list')}}
                                    </h6>
                                </div>
                                <div class="card-body px-75">
                                    <div class="table-responsive users-view-permission overflow-auto text-center">
                                        <table class="table table-borderless overflow-auto">
                                            <thead>
                                            <tr>
                                                <th>{{__('dashboard.table name')}}</th>
                                                <th>{{__('dashboard.table image')}}</th>
                                                <th>{{__('dashboard.table status')}}</th>
                                                <th>{{__('dashboard.price')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($branch->services as $service)
                                                <tr>
                                                    <td>{{$service->name}}</td>
                                                    <td><img src="{{$service->image}}" width="100" height="80" class="thumbnail round"></td>
                                                    <td><span class="badge badge-{{$service->pivot->available==1?'success':'danger'}}"> {{$service->pivot->available==1?'Active':'Disabled'}}</span></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="dropdown">
                                                                <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1"
                                                                        type="button" id="dropdownMenuButton700"
                                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    {{__('dashboard.price')}}
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                                                    <table class="table table-hover-animation text-center">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>{{__('dashboard.size')}}</th>
                                                                            <th>{{__('dashboard.price')}}</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach($service->sizes as $size)
                                                                            <tr>
                                                                                <td>
                                                                                    <span >{{$size->name}}
                                                                                </td>
                                                                                <td>{{$size->pivot->price}}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- permissions end -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>{{__('dashboard.orders')}}
                                    </h6>
                                </div>
                                <div class="card-body px-75">
                                    <div class="table-responsive users-view-permission overflow-auto text-center">
                                        <table class="table table-borderless overflow-auto">
                                            <thead>
                                            <tr>
                                                <th>{{__('dashboard.order_number')}}</th>
                                                <th>{{__('dashboard.order user')}}</th>
                                                <th>{{__('dashboard.total price')}}</th>
                                                <th>{{__('dashboard.payment method')}}</th>
                                                <th>{{__('dashboard.order status')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($branch->orders as $order)
                                                    <tr>
                                                        <td>{{$order->order_number}}</td>
                                                        <td>{{$order->user->name}}</td>
                                                        <td>{{$order->total_after_discount_and_tax}}</td>
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
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
</x-dashboard.layouts.master>
