<x-dashboard.layouts.master title="{{__('dashboard.branches list')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.branches list')}}">
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.branches list')}}</h4>
                    </div>

                    @if(\Session::get('success'))
                        <x-dashboard.layouts.message />
                    @endif
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive overflow-auto">
                                <table class="table table-striped " id="branches-table">

                                    <thead>
                                    @can('add branch')
                                    <a href="{{route('admin.branches.create')}}"><button  class="mb-2 btn btn-primary"><i class="mr-1 feather icon-plus"></i>{{__('dashboard.add branch')}}</button></a>
                                    @endcan
                                    <tr class="text-center">
                                        <th>{{__('dashboard.table name')}}</th>
                                        <th>{{__('dashboard.table address')}}</th>
                                        <th>{{__('dashboard.table phone')}}</th>
                                        <th>{{__('dashboard.range of delivery price')}}</th>
                                        @if(auth()->user()->type != App\Models\User::VENDOR)
                                            <th>{{__('dashboard.vendors')}}</th>
                                        @endif
                                        <th>{{__('dashboard.branch manager')}}</th>
                                        <th>{{__('dashboard.table status')}}</th>
                                        <th>{{__('dashboard.orders count')}}</th>
                                        <th>{{__('dashboard.table create date')}}</th>
                                        <th>{{__('dashboard.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </dev>
            </div>
        </div>
        <!-- END: Content-->
        @section('script')
        <script>
            $(document).ready(function () {
                $('#branches-table').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"branches",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order:[[{{auth()->user()->type == 3?8:9}},'desc']],
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'address', name:'address'},
                        {data:'phone', name: 'phone'},
                        {data:'range_of_delivery_price', name: 'range_of_delivery_price'},
                        @if(auth()->user()->type == App\Models\User::ADMIN)
                            {data: 'vendor', render:function (data){
                                return data.name
                            }},
                        @endif
                        {data: 'user', render:function (data){
                            return data.name;
                            }},
                        {data: 'active', render:function(data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        {data: 'orders_count', name:'orders_count'},
                        {data: 'created_at', name:'created_at'},
                        {data: 'id',
                            render:function (data,two,three){
                                let edit ='branches/'+data+'/edit';
                                let changeStatus ='branches/'+data+'/changeStatus';
                                let show ='branches/'+data;
                                    @if(auth()->user()->can('show branch')||auth()->user()->can('edit branch'))
                                    return `<div class="btn-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{__('dashboard.actions')}}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                                    @can('edit branch')
                                                        <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                                        <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                                    @endcan
                                                    @can('show branch')
                                                        <a class="dropdown-item" href="${show}"><i class="fa fa-eye mr-1"></i>{{__('dashboard.show')}}</a>
                                                    @endcan
                                                    </div>
                                                </div>
                                            </div>`;
                                    @endif
                                return '';
                            }
                        },
                    ]
                });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
