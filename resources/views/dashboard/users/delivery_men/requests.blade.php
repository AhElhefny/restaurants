@php use App\Models\DeliveryMan; @endphp
<x-dashboard.layouts.master title="{{__('dashboard.requests')}}">
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
                    <x-dashboard.layouts.breadcrumb now="{{__('dashboard.requests')}}">
                    </x-dashboard.layouts.breadcrumb>
                    <!-- Column selectors with Export Options and print table -->
                    <section id="column-selectors">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{__('dashboard.requests')}}</h4>
                                    </div>
                                    @if(\Session::get('success'))
                                        <x-dashboard.layouts.message />
                                    @endif
                                    <div class="card-content">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive overflow-auto">
                                                <table class="table table-striped " id="delivery-men-table">
                                                    <thead >
                                                    <tr class="text text-center">
                                                        <th>{{__('dashboard.table name')}}</th>
                                                        <th>{{__('dashboard.table phone')}}</th>
                                                        <th>{{__('dashboard.identity')}}</th>
                                                        <th>{{__('dashboard.license')}}</th>
                                                        <th>{{__('dashboard.type')}}</th>
                                                        <th>{{__('dashboard.company')}}</th>
                                                        <th>{{__('dashboard.table status')}}</th>
                                                        <th>{{__('dashboard.table create date')}}</th>
                                                        <th>{{__('dashboard.actions')}}</th>
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
                $('#delivery-men-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"{{route('admin.deliveryMen.requests')}}",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order: [[7,'desc']],
                    columns: [
                        {data: 'name', name:'name'},
                        {data: 'user', render:function (data){
                            return data.phone
                            }},
                        {data: 'identity', name:'identity'},
                        {data: 'driving_license', name: 'driving_license'},
                        {data: 'type', name: 'type'},
                        {data: 'company', render:function (data){
                            if (data){
                                return data.name
                            }else{
                                return '-';
                            }
                            }},
                        {data: 'account_status', render:function (data) {
                                return `<span class="badge badge-warning">PENDING</span>`
                            }},
                        {data: 'created_at', name:'created_at'},
                        {data: 'id',
                            render:function (data,two,three){
                                @if(auth()->user()->can('edit delivery-man'))
                                let edit ='/{{app()->getLocale()}}/admin/deliveryMen/'+data+'/edit/{{DeliveryMan::ACTIVE}}';
                                let edit1 ='/{{app()->getLocale()}}/admin/deliveryMen/'+data+'/edit/{{DeliveryMan::REJECTED}}';
                                    return `<div class="btn-group">
                                    <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                <a class="dropdown-item" href="${edit}"><i class="fa fa-check-circle mr-1"></i>{{__('dashboard.accept')}}</a>
                                <a class="dropdown-item" href="${edit1}"><i class="fa fa-times-circle mr-1"></i>{{__('dashboard.decline')}}</a>
                                </div>
                                </div>
                            </div>`;
                                @else
                                    return '';
                                @endif
                            }

                        },
                    ]
                });
            });


        </script>
    @endsection
</x-dashboard.layouts.master>
