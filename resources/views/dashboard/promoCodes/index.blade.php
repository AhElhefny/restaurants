<x-dashboard.layouts.master title="{{__('dashboard.promo-code')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.promo-code')}}">
            </x-dashboard.layouts.breadcrumb>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add promo-code')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-promoCode" class="form form-vertical">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.code')}}</label>
                                                <input type="text" id="promo_code" class="form-control" name="promo_code"
                                                       placeholder="{{__('dashboard.code')}}"
                                                       value="{{old('promo_code')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="promo_code_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.available until')}}</label>
                                                <input type="date" id="available_until" class="form-control" name="available_until"
                                                       placeholder="{{__('dashboard.available until').'  .......  '.__('dashboard.in days')}}"
                                                       value="{{old('available_until')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="available_until_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.discount_amount')}}</label>
                                                <input type="number" id="discount_amount" class="form-control"
                                                       name="discount_amount"
                                                       placeholder="{{__('dashboard.discount_amount')}}"
                                                       value="{{old('discount_amount')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="discount_amount_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.number_of_use')}}</label>
                                                <input type="number" id="number_of_use" class="form-control"
                                                       name="number_of_use"
                                                       placeholder="{{__('dashboard.number_of_use')}}"
                                                       value="{{old('number_of_use')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="number_of_use_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.min_amount')}}</label>
                                                <input type="number" id="min_amount" class="form-control"
                                                       name="min_amount"
                                                       placeholder="{{__('dashboard.min_amount')}}"
                                                       value="{{old('min_amount')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="min_amount_error"></span>
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
            @if(\Session::get('success'))
                <x-dashboard.layouts.message/>
            @endif
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.promo-code list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="promo-table">
                                        <thead>
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.code')}}</th>
                                            <th>{{__('dashboard.available until')}}</th>
                                            <th>{{__('dashboard.discount_amount')}}</th>
                                            <th>{{__('dashboard.number_of_use')}}</th>
                                            <th>{{__('dashboard.min_amount')}}</th>
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
    </div>
    @section('script')
        <script>
            $(document).ready(function () {
                let promo_table = $('#promo-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "promoCodes",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[7, 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'promo_code', name: 'promo_code'},
                        {data: 'available_until', name: 'available_until'},
                        {data: 'discount_amount', name: 'discount_amount'},
                        {data: 'number_of_use', name: 'number_of_use'},
                        {data: 'min_amount', name: 'min_amount'},
                        {data: 'active', render:function (data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Not-Active':'Active'}</span>`
                            }},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',
                            render: function (data, two, three) {
                                let edit = 'promoCodes/' + data + '/edit';
                                let changeStatus = 'promoCodes/' + data + '/changeStatus';
                                let deleting = 'promoCodes/' + data;
                                    return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                <form action='${deleting}' method='POST' class="role-${data}">
                                    @csrf
                                @method('DELETE')
                                </form>
                                <button class="dropdown-item" onClick="remove(${data},'role')"><i class="fa fa-trash mr-1"></i>{{__('dashboard.delete')}}</button>
                                </div>
                                </div>
                            </div>`;
                            }
                        },
                    ]
                });

                $('#Form-promoCode').submit(function (e) {
                    e.preventDefault();
                    let promo_code = $('#promo_code').val();
                    let available_until = $('#available_until').val();
                    let discount_amount = $('#discount_amount').val();
                    let number_of_use = $('#number_of_use').val();
                    let min_amount = $('#min_amount').val();
                    let active = $('#active').is(":checked")==true?1:0;
                    $.ajax({
                        url: '{{route('admin.promoCodes.store')}}',
                        type: "POST",
                        data: {
                            promo_code: promo_code,
                            available_until: available_until,
                            discount_amount: discount_amount,
                            number_of_use: number_of_use,
                            min_amount: min_amount,
                            active: active,
                            _token: "{{csrf_token()}}"
                        },
                        success: function (response) {
                            if (response) {
                                $('#promo_code_error').html('');
                                $('#available_until_error').html('');
                                $('#discount_amount_error').html('');
                                $('#number_of_use_error').html('');
                                $('#min_amount_error').html('');
                                $('#Form-promoCode')[0].reset();
                                promo_table.ajax.reload();
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            if (xhr.responseJSON.errors['promo_code']) {
                                $('#promo_code_error').html(xhr.responseJSON.errors['promo_code']);
                            }
                            if (xhr.responseJSON.errors['available_until']) {
                                $('#available_until_error').html(xhr.responseJSON.errors['available_until']);
                            }
                            if (xhr.responseJSON.errors['discount_amount']) {
                                $('#discount_amount_error').html(xhr.responseJSON.errors['discount_amount']);
                            }
                            if (xhr.responseJSON.errors['number_of_use']) {
                                $('#number_of_use_error').html(xhr.responseJSON.errors['number_of_use']);
                            }
                            if (xhr.responseJSON.errors['min_amount']) {
                                $('#min_amount_error').html(xhr.responseJSON.errors['min_amount']);
                            }

                        }
                    });
                });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
