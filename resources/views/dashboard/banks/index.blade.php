<x-dashboard.layouts.master title="{{__('dashboard.bank accounts')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.bank accounts')}}">
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.bank accounts')}}</h4>
                    </div>

                    @if(\Session::get('success'))
                        <x-dashboard.layouts.message />
                    @endif
                    <div class="card-content">
                        <div class="nav nav-tabs justify-content-center mb-4">
                            <a class="nav-item nav-link active" data-toggle="tab" id="vendor" href="#tab-pane-1">{{__('dashboard.vendors')}}</a>
                            <a class="nav-item nav-link" data-toggle="tab" id="user" href="#tab-pane-2">{{__('dashboard.users')}}</a>
                            <a class="nav-item nav-link" data-toggle="tab" id="delivery man" href="#tab-pane-3">{{__('dashboard.deliveryMan')}}</a>
                            <input type="hidden" id="tab-id" value="">
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="table-responsive overflow-auto">
                                <table class="table table-striped " id="bank-accounts-table">

                                    <thead>
                                    <tr>
                                        <th>{{__('dashboard.bank-name')}}</th>
                                        <th>{{__('dashboard.bank account')}}</th>
                                        <th>{{__('dashboard.name on card')}}</th>
                                        <th>{{__('dashboard.IBAN')}}</th>
                                        <th>{{__('dashboard.users')}}</th>
                                        <th>{{__('dashboard.table status')}}</th>
                                        <th>{{__('dashboard.table create date')}}</th>
                                        <th>{{__('dashboard.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class=" ">

                                    </tbody>
                                </table>
                            </div>
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
                   let bankAccount= $('#bank-accounts-table').DataTable({
                        processing: true,
                        serverSide: true,
                        lengthMenu: [10, 20, 40, 60, 80, 100],
                        pageLength: 10,
                        ajax: {
                            url :"bankAccounts",
                            headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                            data: function (d) {
                                d.page = 1,
                                d.filter = $('#tab-id').val()
                            }
                        },
                        "paging": true,
                        order : [[2,'desc']],
                        columns: [
                            {data: 'bank_name', name: 'bank_name'},
                            {data: 'account_number', name:'account_number'},
                            {data:'name_on_card',name: 'name_on_card'},
                            {data:'IBAN',name: 'IBAN'},
                            {data:'user',render:function (data) {
                                    return data.name;
                                }},
                            {data: 'active', render:function(data){
                                    return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                                }},
                            {data: 'created_at', name:'created_at'},
                            {data: 'id',
                                render:function (data,two,three){
                                    let changeStatus ='bank/'+data+'/changeStatus';
                                        return `<div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('dashboard.actions')}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                            <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                        </div>
                                    </div>
                                </div>`;
                                }
                            },
                        ]
                    });

                    $(document).on('click','.nav-item',function(){
                        let value = $(this).attr("id");
                        $('#tab-id').val(value);
                        bankAccount.ajax.reload();
                   });
                });
            </script>
    @endsection
</x-dashboard.layouts.master>
