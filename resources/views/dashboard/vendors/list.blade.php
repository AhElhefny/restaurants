<x-dashboard.layouts.master title="{{__('dashboard.vendor list')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <x-dashboard.layouts.breadcrumb now="{{__('dashboard.vendor list')}}">
                    </x-dashboard.layouts.breadcrumb>
                    <!-- Column selectors with Export Options and print table -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{__('dashboard.vendor list')}}</h4>
                                    </div>
                                    @if(\Session::get('success'))
                                        <x-dashboard.layouts.message />
                                    @endif
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive overflow-auto">
                                                @can('add vendor')
                                                    <a href="{{route('admin.vendors.create')}}"><button  class="mb-2 btn btn-primary"><i class="mr-1 feather icon-plus"></i>{{__('dashboard.add vendor')}}</button></a>
                                                @endcan
                                                <table class="table table-striped " id="vendors-table">

                                                    <thead >


                                                    <tr class="text text-center">
                                                        <th>{{__('dashboard.table name')}}</th>
                                                        <th>{{__('dashboard.table phone')}}</th>
                                                        <th>{{__('dashboard.branches count')}}</th>
                                                        <th>{{__('dashboard.orders count')}}</th>
                                                        <th>{{__('dashboard.table email')}}</th>
                                                        <th>{{__('dashboard.table image')}}</th>
                                                        <th>{{__('dashboard.table status')}}</th>
                                                        <th>{{__('dashboard.category')}}</th>
                                                        <th>{{__('dashboard.table create date')}}</th>
                                                        @if(auth()->user()->can('show vendor') || auth()->user()->can('edit vendor'))
                                                        <th>{{__('dashboard.actions')}}</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text text-center ">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Column selectors with Export Options and print table -->
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @section('script')
        <script>
            $(document).ready(function () {
                $('#vendors-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"vendors",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order: [[9,'desc']],
                    columns: [
                        {data: 'name', name:'name'},
                        {data: 'user', render:function (data){
                            return `<p class="text-justify">${data.phone}</p>`;
                            }},
                        {data: 'branches_count', name:'branches_count'},
                        {data: 'id', render:function () {
                                return 0 ;
                            }},
                        {data: 'email', name:'email'},
                        {data:'user',render:function(data){
                                return  `<img width="100" height="80" src="${data.image}">`
                            }},
                        {data: 'active', render:function(data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        {data: 'category', render:function (data){
                                return data.name;
                            }},
                        {data: 'created_at', name:'created_at'},
                        {data: 'id',
                            render:function (data,two,three){
                                let edit ='vendors/'+data+'/edit';
                                let changeStatus ='vendors/'+data+'/changeStatus';
                                let show ='vendors/'+data;
                                // let deleting ='vendors/'+data;

                                @if(auth()->user()->can('edit vendor') || auth()->user()->can('show vendor'))
                                return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit vendor')
                                    <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                    <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                @endcan
                                @can('show vendor')
                                    <a class="dropdown-item" href="${show}"><i class="fa fa-eye mr-1"></i>{{__('dashboard.show')}}</a>
                                @endcan
                                </div>
                                </div>
                            </div>`;
                            @endif
                                return ''
                            }
                        },
                    ]
                });
            });


        </script>
    @endsection
</x-dashboard.layouts.master>
