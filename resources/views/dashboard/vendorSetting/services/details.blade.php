<x-dashboard.layouts.master title="{{__('dashboard.show service')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.show service')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.services.index')}}">{{__('dashboard.service list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{__('dashboard.Details')}}</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="{{$service->image}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table class="mb-2 h-100" >
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table name')}}</td>
                                                    <td>{{$service->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table description')}}</td>
                                                    <td>{{$service->description}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.vendors')}}</td>
                                                    <td>{{$service->vendor->name}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0 h-100">
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.sub category')}}</td>
                                                    <td>{{$service->vendorCategory->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table status')}}</td>
                                                    <td>{{ $service->active == 1 ? 'Active' : 'Disabled'}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">{{__('dashboard.table create date')}}</td>
                                                    <td>{{$service->created_at}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        @can('edit service')
                                            <div class="col-12">
                                                <a href="{{route('admin.services.edit',$service->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> {{__('dashboard.edit')}}</a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--////////////////////////////////////////////////// --}}


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>{{__('dashboard.additions list')}}
                                    </h6>
                                </div>
                                <div class="card-body px-75">

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
