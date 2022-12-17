<x-dashboard.layouts.master title="{{__('dashboard.delivery list')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.delivery list')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add delivery-types')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add delivery-type')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-delivery" class="form form-vertical">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="type_ar" class="form-control" name="type_ar"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}"
                                                       value="{{old('type_ar')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="type_ar_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="type_en" class="form-control" name="type_en"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in english')}}"
                                                       value="{{old('type_en')}}">
                                                <span style="font-size: 14px;" class="text-danger" id="type_en_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="active" id="active">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                        <span class="">{{__('dashboard.table status')}}</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @if(\Session::get('success'))
                <x-dashboard.layouts.message/>
            @endif
            @can('delivery-types')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.delivery list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="delivery-table">
                                        <thead>
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.table name')}}</th>
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
            @endcan
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function () {
                let delivery_table = $('#delivery-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "deliveryTypes",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[3, 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'type', name: 'type'},
                        {data: 'active', name: 'active',render:function (data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',
                            render: function (data, two, three) {
                                let edit = 'deliveryTypes/' + data + '/edit';
                                let changeStatus = 'deliveryTypes/' + data + '/changeStatus';
                                let deleting = 'deliveryTypes/' + data;
                                @if(auth()->user()->can('edit delivery-types')||auth()->user()->can('delete delivery-types'))
                                    return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit delivery-types')
                                <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                @endcan
                                @can('delete delivery-types')
                                <form action='${deleting}' method='POST' class="role-${data}">
                                    @csrf
                                @method('DELETE')
                                </form>
                                <button class="dropdown-item" onClick="remove(${data},'role')"><i class="fa fa-trash mr-1"></i>{{__('dashboard.delete')}}</button>
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

                $('#Form-delivery').submit(function (e) {
                    e.preventDefault();
                    $('#type_ar_error').html('');
                    $('#type_en_error').html('');
                    let type_ar = $('#type_ar').val();
                    let type_en = $('#type_en').val();
                    let status = $('#active').val();
                    let active = status == 'on' ? 1 : 0 ;
                    console.log(status,active);
                    $.ajax({
                        url: '{{route('admin.deliveryTypes.store')}}',
                        type: "POST",
                        data: {
                            type_ar: type_ar,
                            type_en: type_en,
                            active:active,
                            _token: "{{csrf_token()}}"
                        },
                        success: function (response) {
                            if (response) {
                                $('#Form-delivery')[0].reset();
                                delivery_table.ajax.reload();
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            if (xhr.responseJSON['type_ar']) {

                                $('#type_ar_error').html(xhr.responseJSON['type_ar'][0]);
                            }
                            if (xhr.responseJSON['type_en']) {
                                $('#type_en_error').html(xhr.responseJSON['type_en'][0]);
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
