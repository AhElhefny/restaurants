@php use App\Models\User; @endphp
<x-dashboard.layouts.master title="{{__('dashboard.orders list')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.orders list')}}">
            </x-dashboard.layouts.breadcrumb>
            <div class="content-body">
                <section id="column-selectors">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('dashboard.orders list')}}</h4>
                                </div>
                                @if(\Session::get('success'))
                                    <x-dashboard.layouts.message/>
                                @endif
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive overflow-auto">
                                            <table class="table table-striped" id="orders-table">
                                                <thead>
                                                <tr>
                                                    <th>{{__('dashboard.order_number')}}</th>
                                                    <th>{{__('dashboard.order user')}}</th>
                                                    <th>{{__('dashboard.total price')}}</th>
                                                    @if(auth()->user()->type != User::BRANCH_MANAGER)
                                                        <th>{{__('dashboard.branch')}}</th>
                                                    @endif
                                                    @if(auth()->user()->type == User::ADMIN)
                                                        <th>{{__('dashboard.vendors')}}</th>
                                                    @endif
                                                    <th>{{__('dashboard.payment method')}}</th>
                                                    <th>{{__('dashboard.payment status')}}</th>
                                                    <th>{{__('dashboard.order status')}}</th>
                                                    <th>{{__('dashboard.table create date')}}</th>
                                                    <th>{{__('dashboard.actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody class="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <x-dashboard.orders.status_modal />
    <x-dashboard.orders.paySettings_modal />
    <!-- END: Content-->
    @section('script')
        <script>
            $(document).ready(function () {
                $('#orders-table').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "orders",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order: [[2, 'desc']],
                    columns: [
                        {data: 'order_number', name: 'order_number'},
                        {
                            data: 'user', render: function (data) {
                                return data.name
                            }
                        },
                        {data: 'total_after_discount_and_tax', name: 'total_after_discount_and_tax'},
                            @if(auth()->user()->type != User::BRANCH_MANAGER)
                        {
                            data: 'branch', render: function (data) {
                                return data.name
                            }
                        },
                            @endif
                            @if(auth()->user()->type == User::ADMIN)
                        {
                            data: 'branch', render: function (data) {
                                return data.vendor.name
                            }
                        },
                            @endif
                        {
                            data: 'payment_method', render: function (data) {
                                return data.method
                            }
                        },
                        {
                            data: 'payment_status', render: function (data) {
                                if (data == 0)
                                    return '<span class="badge badge-danger">{{__('dashboard.un-paid')}}</span>';
                                if (data == 1)
                                    return '<span class="badge badge-success">{{__('dashboard.paid')}}</span>';
                            }
                        },
                        {
                            data: 'order_status', render: function (data) {
                                return data.name
                            }
                        },
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'id',
                            render: function (data, two, three) {
                                let show = 'order/' + data;
                                @if(auth()->user()->can('show-order'))
                                    return `<div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('show-order')
                                    <a class="dropdown-item" href="${show}"><i class="fa fa-eye mr-1"></i>{{__('dashboard.show')}}</a>
                                @endcan
                                @can('edit-order')
                                    <a class="dropdown-item change-order" data-id="${data}" data-toggle="modal" data-target="#changeOrderStatus"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                    <a class="dropdown-item edit-order" data-id="${data}" data-toggle="modal" data-target="#changePaySettings"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
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

                $(document).on('click','.change-order',function(){
                   let id = $(this).data('id');
                   $('#modal-change-state-form').attr('action','order/'+id+'/changeStatus');
                });

                $(document).on('click','.edit-order',function(){
                   let id = $(this).data('id');
                   $('#modal-pay-settings-form').attr('action','order/'+id+'/editPaySetting');
                });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
